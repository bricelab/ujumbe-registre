<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChangeLocaleController extends AbstractController
{
    /**
     * @Route("/change/locale/{locale}/{path}", name="change_locale")
     */
    public function index(string $locale = "fr", string $path = "app_home")
    {
        return $this->redirectToRoute($path, [
            '_locale' => $locale,
        ]);
      
    }
}
