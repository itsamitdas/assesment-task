<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\ShopOutputDto;
use App\Repository\ShopRepository;
use App\Validator\IsValidLatLong;
use Doctrine\ORM\Mapping as ORM;
use http\Message;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ShopRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" ,
        "post"
    ],
        itemOperations: [
        "get" => ["security" => "is_granted('EDIT',object)"],
        "put",
        "delete"
    ],
    output: ShopOutputDto::class,
)]
class Shop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]

    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBank]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $shop_owner_name;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $owner_contact_number;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $address1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address2;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    private $zip;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $city;

    #[ORM\Column(type: 'text', nullable: true)]
    private $shop_description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $licence_number;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $latitude;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $longitude;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $vat_number;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $shop_bank_account_number;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank]
    private $bank_details;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updated_at;

    #[ORM\Column(type: 'boolean')]
    private $isActive;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'shops')]
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getShopOwnerName(): ?string
    {
        return $this->shop_owner_name;
    }

    public function setShopOwnerName(string $shop_owner_name): self
    {
        $this->shop_owner_name = $shop_owner_name;

        return $this;
    }

    public function getOwnerContactNumber(): ?string
    {
        return $this->owner_contact_number;
    }

    public function setOwnerContactNumber(string $owner_contact_number): self
    {
        $this->owner_contact_number = $owner_contact_number;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getShopDescription(): ?string
    {
        return $this->shop_description;
    }

    public function setShopDescription(?string $shop_description): self
    {
        $this->shop_description = $shop_description;

        return $this;
    }

    public function getLicenceNumber(): ?string
    {
        return $this->licence_number;
    }

    public function setLicenceNumber(string $licence_number): self
    {
        $this->licence_number = $licence_number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vat_number;
    }

    public function setVatNumber(string $vat_number): self
    {
        $this->vat_number = $vat_number;

        return $this;
    }

    public function getShopBankAccountNumber(): ?string
    {
        return $this->shop_bank_account_number;
    }

    public function setShopBankAccountNumber(string $shop_bank_account_number): self
    {
        $this->shop_bank_account_number = $shop_bank_account_number;

        return $this;
    }

    public function getBankDetails(): ?string
    {
        return $this->bank_details;
    }

    public function setBankDetails(string $bank_details): self
    {
        $this->bank_details = $bank_details;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
