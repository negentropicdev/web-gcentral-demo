<?php

namespace App\Controller;

use App\Entity\Package;
use App\Repository\PackageRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends AbstractController
{
    /**
     * @Route("/packages", name="package_list")
     */
    public function index(PackageRepository $repo)
    {
        $packages = $repo->topPackagesByColumn('downloads');

        return $this->render('package/index.html.twig', [
            'controller_name' => 'PackageController',
            'packages' => $packages,
        ]);
    }

    /**
     * @Route("/package/{id}", name="package_details")
     */
    public function package_details(Package $package) {
        return $this->render('package/details.html.twig', [
            'package' => $package,
        ]);
    }
}
