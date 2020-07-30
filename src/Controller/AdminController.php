<?php

namespace App\Controller;

use App\Entity\Website;
use App\Form\WebsiteType;
use App\Repository\WebsiteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */

    public function index(WebsiteRepository $repository)
    {
        $websites = $repository->findAll();
        return $this->render('admin/index.html.twig', [
            'websites' => $websites
        ]);
    }
    
    /**
     * @Route("/admin/new", name="admin_new")
     */
    
    public function new()
    {
        $website = new Website();
        $form = $this->createForm(WebsiteType::class, $website);
        return $this->render('admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
