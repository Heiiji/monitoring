<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Website;
use App\Repository\StatusRepository;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(WebsiteRepository $repository, StatusRepository $statusRepo)
    {
        $websites = $repository->findAll();
        $count = count($websites);
        $status = $statusRepo->getLastStatus($count);
        return $this->render('home/index.html.twig', [
            'websites' => $websites,
            'status' => $status
        ]);
    }

    
    /**
     * @Route("/websites/analyze", name="analyze")
     */

    public function analyze(WebsiteRepository $repository, EntityManagerInterface $manager) {
        // recup les sites

        $websites = $repository->findAll();

        // recup leurs status

        foreach($websites as $key => $site) {
            $url = $site->getUrl();
            $handle = curl_init($url);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($handle);
            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            curl_close($handle);

            // creer une nouvelle entités status -> save

            $status = new Status();
            $status->setCode($code)
                ->setReportedAt(new \DateTime())
                ->setWebsite($site);
            $manager->persist($status);
        }
        $manager->flush();

        $this->addFlash(
            'success',
            'Le diagnostic à bien été effectué.'
        );

        // Se rediriger vers "home"

        return $this->redirectToRoute('home');
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
