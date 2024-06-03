<?php

namespace App\Controller;

use App\DTO\LowestPriceInquiry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(
        Request $request,
        int $id,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $lowestPriceInquiry = $serializer->deserialize(
            $request->getContent(), 
            LowestPriceInquiry::class, 
            'json'
        );
        
        dd($lowestPriceInquiry);
        
        return new JsonResponse([
            'quantity' => 5,
            'country_name' => 'Poland',
            'voucher_code' => 'DH-715',
            'request_date' => date('Y-m-d'),
            'product_id' => $id
        ], 200);
    }
}