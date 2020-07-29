<?php

namespace App\Controller;

use App\Repository\WebsiteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(WebsiteRepository $repository)
    {
        $websites = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'websites' => $websites
        ]);
    }
}
