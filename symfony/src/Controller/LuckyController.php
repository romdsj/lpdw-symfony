<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    #[Route('/number/{number}', requirements: ['number' => '\d+'])]
    public function number(int $number = 10): Response
    {
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}