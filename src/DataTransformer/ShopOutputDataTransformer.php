<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

use App\Dto\ShopOutputDto;
use App\Entity\Shop;

class ShopOutputDataTransformer implements DataTransformerInterface
{

    /**
     * @param Shop $shop
     */
    public function transform($shop, string $to, array $context = [])
    {
        return ShopOutputDto::fromEntity($shop);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof Shop && $to === ShopOutputDto::class;
    }
}