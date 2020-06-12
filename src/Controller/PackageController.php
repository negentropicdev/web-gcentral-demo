<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends AbstractController
{
    /**
     * @Route("/packages", name="package_list")
     */
    public function index()
    {
        return $this->render('package/index.html.twig', [
            'controller_name' => 'PackageController',
        ]);
    }
}
