<?php


namespace App\Dto;


use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

class UserInputDto
{

//    public function __construct(private UserPasswordHasher $passwordHasher)
//    {
//    }

    #[Groups("user:write")]
    public $email;

    #[Groups("user:write")]
    #[SerializedName("password")]
    public $plainPassword;

    #[Groups("user:write")]
    public $roles = [];

    public $password;

    public $shops;

    #[Groups("user:write")]
    public $mobile;

    #[Groups("user:write")]
    public $address;

    #[Groups("user:write")]
    public $name;

    private function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }


    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function toEntity($input){
        $user = new User();

        $user->setName($input->name);
        $user->setAddress($input->address);
        $user->setEmail($input->email);
        $user->setMobile($input->mobile);
        $user->setPlainPassword($input->plainPassword);
        $user->setRoles($input->roles);

        return $user;
    }

    public function updateUser($existingUser,$input) {
        if(isset($input->name)) {
            $existingUser->setName($input->name);
        }
        if(isset($input->email)) {
            $existingUser->setEmail($input->email);
        }
        if(isset($input->address)) {
            $existingUser->setAddress($input->address);
        }
        if(isset($input->mobile)) {
            $existingUser->setMobile($input->mobile);
        }
        if(isset($input->plainPassword)) {
            $existingUser->setPlainPassword($input->plainPassword);
        }
        if(isset($input->roles)) {
            $existingUser->setRoles($input->roles);
        }
        return $existingUser;
    }
}