<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\UserOutputDto;
use App\Entity\User;

class UserOutputTransformer implements DataTransformerInterface
{
    /**
     * @param User $object
     */
    public function transform($object, string $to, array $context = [])
    {
        return UserOutputDto::fromEntity($object);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof User && $to === UserOutputDto::class;
    }
}