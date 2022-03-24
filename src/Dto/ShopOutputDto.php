<?php


namespace App\Dto;

use App\Entity\Shop;
use Symfony\Component\Serializer\Annotation\Groups;


class ShopOutputDto
{
    public $id;

    #[Groups("user:read")]
    public $name;
    public $shop_owner_name;
    public $owner_contact_number;
    public $address1;
    public $address2;
    public $zip;
    public $country;
    public $city;
    public $shop_description;
    public $licence_number;
    public $email;
    public $phone;
    public $latitude;
    public $longitude;
    public $vat_number;
    public $shop_bank_account_number;
    public $bank_details;
    public $created_at;
    public $updated_at;

    public static function fromEntity($shop): self
    {
        $shopDto = new self();
        $shopDto->id = $shop->getId();
        $shopDto->name = $shop->getName();
        $shopDto->shop_owner_name = $shop->getShopOwnerName();
        $shopDto->owner_contact_number = $shop->getShopOwnerName();
        $shopDto->address1 = $shop->getAddress1();
        $shopDto->address2 = $shop->getAddress2();
        $shopDto->zip = $shop->getZip();
        $shopDto->country = $shop->getCountry();
        $shopDto->city = $shop->getCity();
        $shopDto->shop_description = $shop->getShopDescription();
        $shopDto->licence_number = $shop->getLicenceNumber();
        $shopDto->email = $shop->getEmail();
        $shopDto->phone = $shop->getPhone();
        $shopDto->latitude = $shop->getLatitude();
        $shopDto->longitude = $shop->getLongitude();
        $shopDto->vat_number = $shop->getVatNumber();
        $shopDto->shop_bank_account_number = $shop->getShopBankAccountNumber();
        $shopDto->bank_details = $shop->getBankDetails();
        $shopDto->created_at = $shop->getCreatedAt();
        $shopDto->updated_at = $shop->getUpdatedAt();
        return $shopDto;
    }

}