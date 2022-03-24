<?php

namespace App\Tests;



use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Repository\UserRepository;


class UserTest extends ApiTestCase
{
    public function testCreateUser()
    {
        $postData = [
            "email" => "amit@gmail.com",
            "password" => "123",
            "roles" => [
                "ROLE_SHOP_OWNER"
            ],
            "mobile" => "9153016977",
            "address" => "Krishnanagar",
            "name" => "Amit Kumar Das"
        ];

        $response = static::createClient()->request('POST', '/api/users', ['json' => $postData]);
        $this->assertResponseStatusCodeSame(201);
    }

    public function testGetUserCollection()
    {
        $response = static::createClient()->request('GET', '/api/users');
        $this->assertResponseIsSuccessful();
    }

    public function testGetUserItem()
    {
        $response = static::createClient()->request('GET','/api/users/'.$this->getValidUserId());
        $this->assertResponseIsSuccessful();
    }

    public function testUserUpdate(): void
    {
        $client = static::createClient();
        $iri = '/api/users/'.$this->getValidUserId();
        $client->request('PUT', $iri, ['json' => [
            'name' => 'Name for PHP UNIT TEST',
        ]]);

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteUser(){
        $response = static::createClient()->request('DELETE','/api/users/'.$this->getValidUserId());
        $this->assertResponseStatusCodeSame(204);
    }

    public function getValidUserId(){
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('amit@gmail.com');
        return $testUser->getId();
    }
}
