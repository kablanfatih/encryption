<?php


namespace Encryption\tests\Unit;


use Encryption\src\Encryptable;
use Tests\TestCase;

class EncryptableTest extends TestCase
{

    use Encryptable;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testifJson_ifJsonIsNotEmpty_shouldReturnTrue()
    {
        $body = json_encode(['field' => 'json']);
        $this->assertTrue($this->ifJson($body));
    }
    public function testifJson_ifJsonIsEmpty_shouldReturnFalse()
    {
        $body = json_encode(null);
        $this->assertFalse($this->ifJson($body));
    }
}
