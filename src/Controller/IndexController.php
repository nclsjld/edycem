<?php

namespace App\Controller;

use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'is_home' => true,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
