<?php

namespace App\Controller;

use App\Entity\Website;
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
    
    /**
     * @Route("/websites/{id}", name="website_show")
     */
    public function show(Website $website) {
        return $this->render('home/show.html.twig', [
            'website' => $website
        ]);
    }
}
