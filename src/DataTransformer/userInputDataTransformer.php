<?php


namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Dto\UserInputDto;
use App\Entity\User;

class userInputDataTransformer implements DataTransformerInterface
{

    /**
     * @param UserInputDto $input
     */
    public function transform($input, string $to, array $context = [])
    {
        $existingUser = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] ?? null;

        if(!$existingUser) {
            return $input->toEntity($input);
        }else{
            $UserInputDto = new UserInputDto;
            return $UserInputDto->updateUser($existingUser,$input);
        }
    }

//    public function initialize(string $inputClass, array $context = [])
//    {
//        $existingUser = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] ?? null;
//        dump($existingUser);
//        if (!$existingUser) {
//            return new UserInputDto();
//        }
//
//        $userInputDto = new UserInputDto();
//        $userInputDto->email = $existingUser->getEmail();
//        $userInputDto->name = $existingUser->getName();
//        $userInputDto->address = $existingUser->getAddress();
//        $userInputDto->mobile = $existingUser->getMobile();
//        $userInputDto->plainPassword = $existingUser->getPlainPassword();
//        $userInputDto->roles = $existingUser->getRoles();
//
//        return $userInputDto;
//    }


    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if($data instanceof User){
            return false;
        }
        return $to === User::class && ($context['input']['class'] ?? null) === UserInputDto::class;
    }


}