<?php
/**
 * @author bricelab <bricehessou@gmail.com>
 * @version 0.1
 */

namespace App\Controller;

use App\Entity\User;
use App\Events\UserEvent;
use App\Repository\UserRepository;
use App\Services\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if ($this->getUser()) {
             return $this->redirectToRoute('app_profile');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'locale' => $request->getLocale(),
            'route' => $request->attributes->get("_route"),
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/password-reset-request", name="password_reset_request")
     */
    public function passwordResetRequestforgotten(Request $request, EventDispatcherInterface $dispatcher, TokenGeneratorInterface $tokenGenerator)
    {
        // création d'un formulaire "à la volée", afin que l'internaute puisse renseigner son mail
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank()
                ]
            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            /**
             * @var UserRepository
             */
            $repository = $entityManager->getRepository(User::class);
            $user = $repository->findOneByEmail($form->getData()['email']);

            if($user){
                // création du token
                $user->setToken($tokenGenerator->generateToken());
                // enregistrement de la date de création du token
                $user->setPasswordRequestedAt(new \Datetime());
                $entityManager->flush();

                $event = new UserEvent($user, $request);
                $dispatcher->dispatch($event, UserEvent::PASSWORD_RESET_REQUESTED);
            }
            

            // on utilise le service Mailer créé précédemment
            /* $bodyMail = $mailer->createBodyMail('security/mail-resetting.html.twig', [
                'user' => $user
            ]);
            $mailer->sendMessage('no-reply@ujumbe.com', $user->getEmail(), 'Mot de passe oublié !', $bodyMail); */
            
            
            $request->getSession()->getFlashBag()->add('success', "Si votre adresse correspond à un compte, un mail va vous être envoyé afin que vous puissiez renouveller votre mot de passe. Veuillez consultez votre boîte aux lettres.");

            //return $this->redirectToRoute("security_login");
            return $this->render('security/password-request.html.twig', [
                'success' => true
            ]);
        }

        return $this->render('security/password-request.html.twig', [
            'form' => $form->createView(),
            'success' => false
        ]);
    }

    /**
     * @Route("/password-ressetting-{id}-{token}", name="resetting_password")
     */
    public function passwordResetting(User $user, $token, Request $request, EventDispatcherInterface $dispatcher, UserPasswordEncoderInterface $passwordEncoder)
    {
        // interdit l'accès à la page si:
        //      - le token associé au membre est null
        //      - le token enregistré en base et le token présent dans l'url ne sont pas égaux
        //      - le token date de plus de 10 minutes
        //dd($user);
        if ($user->getToken() === null || $token !== $user->getToken())
        {
            $request->getSession()->getFlashBag()->add('error', "Token invalide. Veuillez réessayer svp.");

            return $this->render('security/password-reset.html.twig', [
                'success' => false
            ]);

            //throw new AccessDeniedHttpException();
        }

        if (!$this->isRequestInTime($user->getPasswordRequestedAt()))
        {
            // réinitialisation du token à null pour qu'il ne soit plus réutilisable
            $user->setToken(null);
            $user->setPasswordRequestedAt(null);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $event = new UserEvent($user, $request);
            $dispatcher->dispatch($event, UserEvent::PASSWORD_NOT_RESETED_IN_TIME);

            $request->getSession()->getFlashBag()->add('error', "Le lien de rénitialisation a expiré. Veuillez réessayer svp.");

            return $this->render('security/password-reset.html.twig', [
                'success' => false
            ]);

            //throw new AccessDeniedHttpException();
        }

        //$form = $this->createForm(ResettingType::class, $user);

        $form = $this->createFormBuilder()
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Nouveau mot de passe'),
                'second_options' => array('label' => 'Confirmer le mot de passe'),
                'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->getForm();
        $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid())
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // réinitialisation du token à null pour qu'il ne soit plus réutilisable
            $user->setToken(null);
            $user->setPasswordRequestedAt(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $event = new UserEvent($user, $request);
            $dispatcher->dispatch($event, UserEvent::PASSWORD_RESETED);

            // on utilise le service Mailer créé précédemment
            /* $bodyMail = $mailer->createBodyMail('security/mail-resetting-confirmation.html.twig', [
                'user' => $user
            ]);
            $mailer->sendMessage('no-reply@ujumbe.com', $user->getEmail(), 'Mot de passe changé !', $bodyMail); */

            $request->getSession()->getFlashBag()->add('success', "Votre mot de passe a été renouvelé.");

            //return $this->redirectToRoute('security_login');

            return $this->render('security/password-reset.html.twig', [
                'success' => true
            ]);

        }
 
        return $this->render('security/password-resetting.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    // si supérieur à 10min, retourne false
    // sinon retourne false
    private function isRequestInTime(\Datetime $passwordRequestedAt = null)
    {
        if ($passwordRequestedAt === null)
        {
            return false;        
        }
        
        $now = new \DateTime();
        $interval = $now->getTimestamp() - $passwordRequestedAt->getTimestamp();

        $daySeconds = 60 * 15;
        $response = $interval > $daySeconds ? false : true;
        return $response;
    }
}
