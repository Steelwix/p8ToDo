<?php

namespace App\Tests\Security;

use App\Entity\Users;
use App\Repository\UsersRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class UserAuthentificatorAuthenticatorTest extends WebTestCase
{

    private MockObject | Request | null $request;
    public function setUp(): void

    {
        $this->client = static::createClient();
        $request = $this->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();
    }
    public function testAuthenticate(): void
    {
    }
}
