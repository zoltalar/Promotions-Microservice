<?php

namespace App\Controller;

use App\DTO\LowestPriceInquiry;
use App\Filter\PromotionFilterInterface;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionFilterInterface $promotionFilter
    ): Response
    {
        $lowestPriceInquiry = $serializer->deserialize(
            $request->getContent(), 
            LowestPriceInquiry::class, 
            'json'
        );
        
        $modifiedInquiry = $promotionFilter->apply($lowestPriceInquiry);
        $responseContent = $serializer->serialize($modifiedInquiry, 'json');
        
        return new Response($responseContent, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}