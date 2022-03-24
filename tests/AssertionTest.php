<?php


namespace App\Tests;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;

class AssertionTest extends ApiTestCase
{
    public function testFailureHasKey(): void
    {
        $this->assertArrayHasKey('foo', ['foo' => 'baz']);
    }

    public function testPassNotHasKey(): void
    {
        $this->assertArrayNotHasKey('foo', ['bar' => 'baz']);
    }

    public function testFailureHasAttribute(): void
    {
        $this->assertClassHasAttribute('name', User::class);
    }

    public function testPassHasAttribute(): void
    {
        $this->assertClassNotHasAttribute('foo', User::class);
    }

    public function testPassHasStaticAttribute(): void
    {
        $this->assertClassNotHasStaticAttribute('foo', User::class);
    }

    public function testFailureContains(): void
    {
        $this->assertContains(3, [1, 2, 3]);
    }

    public function testPassNotContains(): void
    {
        $this->assertNotContains(4, [1, 2, 3]);
    }

    public function testFailureContainsString(): void
    {
        $this->assertStringContainsString('foo', 'foo');
    }
    public function testPassNotContainsString(): void
    {
        $this->assertStringNotContainsString('foo', 'bar');
    }

    //NEED TO UNDERSTOOD
    public function testFailure(): void
    {
        $this->assertStringContainsStringIgnoringCase('foo', 'foo');
    }

    public function testPass(): void
    {
        $this->assertStringNotContainsStringIgnoringCase('foo', 'bar');
    }

    public function testFailureContainsOnly(): void
    {
        $this->assertContainsOnly('string', ['1', '2', '3']);
    }

    public function testFailureNotContainsOnly(): void
    {
        $this->assertNotContainsOnly('string', ['1', '2', 3]);
    }
}