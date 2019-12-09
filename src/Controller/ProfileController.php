<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request)
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'locale' => $request->getLocale(),
            'route' => $request->attributes->get("_route"),
        ]);
    }
}
