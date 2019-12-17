<?php

namespace App\Controller;

use App\Repository\RegistreRepository;
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
    public function index(Request $request, RegistreRepository $repository)
    {
        dump(sizeof($repository->findAllIncoming()));
        dump(sizeof($repository->findAllIncomingOpened()));
        dump(sizeof($repository->findAllIncomingClosed()));
        dump(sizeof($repository->findAllIncomingArchived()));
        dump(sizeof($repository->findAllIncomingDelected()));
        dump(sizeof($repository->findAllIncomingTrashed()));

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            //'incoming' => $repository->findAllIncoming(),
            'locale' => $request->getLocale(),
        ]);
    }
}
