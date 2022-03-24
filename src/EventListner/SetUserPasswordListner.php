<?php


namespace App\EventListner;


use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SetUserPasswordListner
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function prePersist(User $user){

        if($user->getPlainPassword()){
            $user->setPassword(
                $this->passwordHasher->hashPassword($user,$user->getPlainPassword())
            );
            $user->eraseCredentials();
        }


    }

}