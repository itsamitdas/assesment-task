<?php


namespace App\Dto;


use App\Entity\Shop;
use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;

class UserOutputDto
{

    #[Groups("user:read")]
    public $email;

    #[Groups("user:read")]
    public $shops;

    #[Groups("user:read")]
    public $mobile;

    #[Groups("user:read")]
    public $address;

    #[Groups("user:read")]
    public $name;


    public static function fromEntity($user) : self {
        $userDto = new self();

        $userDto->email = $user->getEmail();
        $userDto->name = $user->getName();
        $userDto->address = $user->getAddress();
        $userDto->shops = $user->getShops();
        $userDto->mobile = $user->getMobile();

        return $userDto;
    }

}