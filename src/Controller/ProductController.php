<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(Request $request, int $id): JsonResponse
    {
        return new JsonResponse([
            'quantity' => 5,
            'country_name' => 'Poland',
            'voucher_code' => 'DH-715',
            'request_date' => date('Y-m-d'),
            'product_id' => $id
        ], 200);
    }
}