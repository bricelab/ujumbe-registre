<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

 /**
 * @Route("", name="")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        /**
         * @var FormInterface
         */
        $form = $this->createFormBuilder()
            ->add("locale", ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    'Français' => 'fr',
                    'English' => 'en',
                ],
                'label' => 'layout.locale.changelocal',
            ])
            ->add("submit", SubmitType::class, [
                'label' => 'form.field.locale.submit'
            ])
            ->getForm()
        ;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //$form->get;
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
        ]);
    }
}
