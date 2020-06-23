<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PackageAPIController extends AbstractController
{
    /**
     * @Route("/api/packages", name="api_packages")
     */
    public function index() {
        $response = new JsonResponse(['packages' => []]);

        return $response;
    }

    /**
     * @Route("/api/packages/search", name="api_package_search")
     */
    public function package_search(Request $request) {
        $params = json_decode($request->getContent(), true);
    }
}
