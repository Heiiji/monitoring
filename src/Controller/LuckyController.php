<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{

    /**
     * @Route("/lucky/number", name="lucky")
     */

    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('test.html.twig', [
            'number' => $number
        ]);
    }
}