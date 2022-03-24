<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/active-shops', name: 'app_activeShop')]
    public function index(ShopRepository $shopRepository)
    {
//        $activeShops = $shopRepository->allActiveshopes();
//        dd($activeShops);


//        $city = "Kolkata";
//        $activeShopsByCity = $shopRepository->allActiveshopesByCity($city);
//        dd($activeShopsByCity);
    }
}
