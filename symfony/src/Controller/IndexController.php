<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller
 *
 * @Route("/")
 */

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}