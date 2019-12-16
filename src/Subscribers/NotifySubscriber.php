<?php

namespace App\Subscribers;

use App\Entity\User;
use App\Events\UserEvent;
use App\Services\Mailer;
use Scheb\TwoFactorBundle\Security\TwoFactor\Event\TwoFactorAuthenticationEvent;
use Scheb\TwoFactorBundle\Security\TwoFactor\Event\TwoFactorAuthenticationEvents;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class NotifySubscriber implements EventSubscriberInterface
{

    private $mailer;

    private $dispatcher;

    public function __construct(Mailer $mailer, EventDispatcherInterface $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public static function getSubscribedEvents()
    {
        return [            
            UserEvent::SIGNED_UP => [
                ['onUserSignup', 10],
            ],
            /* TwoFactorAuthenticationEvents::COMPLETE => [
                ['onUser2faLogin', 105],
            ],    
            SecurityEvents::INTERACTIVE_LOGIN => [
                ['onUserLogin', 15],
            ],     */    
            UserEvent::PASSWORD_RESET_REQUESTED => [
                ['onPasswordResetRequested', 10],
            ],           
            UserEvent::PASSWORD_RESETED => [
                ['onPasswordReseted', 10],
            ],           
            UserEvent::PASSWORD_NOT_RESETED_IN_TIME => [
                ['onPasswordNotResetedInTime', 10],
            ],
        ];
    }

    public function onUserSignup(UserEvent $event)
    {
        //dd($event);
        /**
         * @var User
         */
        $user = $event->getUser();
        $subject = "Inscription";
        $body = "emails/signup.html.twig";
        $context = [
            'user' => $user,
            'expiration_date' => new \DateTime(),
            'locale' => $event->getRequest()->getLocale(),
        ];
        $this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        //$event->stopPropagation();
    }

    public function onUserLogin(InteractiveLoginEvent $event)
    {

        $user = $event->getAuthenticationToken()->getUser();
        //dd($event);
        $subject = "Connexion";
        $body = "emails/signup.html.twig";
        $context = [
            'user' => $user,
            'expiration_date' => new \DateTime(),
            'locale' => $event->getRequest()->getLocale(),
        ];
        try {
            //$this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        } catch (\Exception $e) {
            //throw $th;
        }
        $this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        //$this->mailer->sendEmail('no-reply@ujumbe.com', $user->getEmail(), $subject, $body, Email::PRIORITY_HIGH);
        //$event->stopPropagation();
    }

    public function onPasswordResetRequested(UserEvent $event)
    {
        //dd($event);
        /**
         * @var User
         */
        $user = $event->getUser();
        $subject = "Inscription";
        $body = "emails/signup.html.twig";
        $context = [
            'user' => $user,
            'expiration_date' => new \DateTime(),
            'locale' => $event->getRequest()->getLocale(),
        ];
        $this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        //$event->stopPropagation();
    }

    public function onPasswordReseted(UserEvent $event)
    {
        //dd($event);
        /**
         * @var User
         */
        $user = $event->getUser();
        $subject = "Inscription";
        $body = "emails/signup.html.twig";
        $context = [
            'user' => $user,
            'expiration_date' => new \DateTime(),
            'locale' => $event->getRequest()->getLocale(),
        ];
        $this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        //$event->stopPropagation();
    }

    public function onPasswordNotResetedInTime(UserEvent $event)
    {
        //dd($event);
        /**
         * @var User
         */
        $user = $event->getUser();
        $subject = "Inscription";
        $body = "emails/signup.html.twig";
        $context = [
            'user' => $user,
            'expiration_date' => new \DateTime(),
            'locale' => $event->getRequest()->getLocale(),
        ];
        $this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        //$event->stopPropagation();
    }

    public function onUser2faLogin(TwoFactorAuthenticationEvent $event)
    {
        //dd($this->dispatcher);
        $this->dispatcher->removeListener(SecurityEvents::INTERACTIVE_LOGIN, 'onUserLogin');
        /**
         * @var User
         */
        $user = $event->getToken()->getUser();
        $subject = "2FA Connexion";
        $body = "emails/signup.html.twig";
        $context = [
            'user' => $user,
            'expiration_date' => new \DateTime(),
            'locale' => $event->getRequest()->getLocale(),
        ];
        $this->mailer->sendNotification($user->getEmail(), $subject, $body, $context);
        //$event->stopPropagation();
    }
}