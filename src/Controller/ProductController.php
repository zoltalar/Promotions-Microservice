<?php

namespace App\Controller;

use App\DTO\LowestPriceInquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\PromotionFilterInterface;
use App\Service\Serializer\DTOSerializer;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ?EntityManagerInterface $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
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
        
        $product = $this
            ->entityManager
            ->getRepository(Product::class)
            ->find($id);
        
        $lowestPriceInquiry->setProduct($product);
        
        $promotions = $this
            ->entityManager
            ->getRepository(Promotion::class)
            ->findAllValidForProduct(
                $product, 
                new DateTimeImmutable($lowestPriceInquiry->getRequestDate())
            );
        
        $modifiedInquiry = $promotionFilter->apply($lowestPriceInquiry, $promotions);
        $responseContent = $serializer->serialize($modifiedInquiry, 'json');
        
        return new Response($responseContent, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
    
    #[Route('/products/{id}/tests', name: 'tests', methods: 'GET')]
    public function tests(int $id): Response
    {
        $product = $this
            ->entityManager
            ->getRepository(Product::class)
            ->find($id);
        
        dd($product);
    }
}