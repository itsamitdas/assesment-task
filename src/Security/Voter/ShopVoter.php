<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ShopVoter extends Voter
{
    public const EDIT = 'EDIT';

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT])
            && $subject instanceof \App\Entity\Shop;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
       $city = $subject->getCity();
       if($city === "Krishnanagar"){
           return true;
       }
       return false;
    }
}
