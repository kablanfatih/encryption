<?php

namespace Kablanfatih\Encryption\tests\Unit;

use Kablanfatih\Encryption\Encryptable;
use Illuminate\Support\Facades\Crypt;
use Kablanfatih\Encryption\Providers\EncryptableServiceProvider;
use Orchestra\Testbench\TestCase;

class EncryptableTest extends TestCase
{
    use Encryptable;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app->register(EncryptableServiceProvider::class);
    }

    /**
     * @test
     */
    public function testIsJson_ShouldReturnTrue_WhenJsonNotNull()
    {
        $json = json_encode([
            'key' => 'value'
        ]);
        $isJson = $this->is_json($json);

        $this->assertTrue($isJson);
    }

    /**
     * @test
     */
    public function testIsJson_ShouldReturnFalse_WhenJsonNull()
    {
        $json = json_encode(null);
        $isJson = $this->is_json($json);

        $this->assertFalse($isJson);
    }

    /**
     * @test
     */
    public function testDecryptField_ShouldReturnDecodedJson_WhenValueIsJson()
    {
        $json = json_encode([
            'key' => 'value'
        ]);
        $encrypt = Crypt::encrypt($json);
        $decryptField = $this->decryptField($encrypt);

        $this->assertEquals(json_decode($json), $decryptField);
    }

    /**
     * @test
     */
    public function testDecryptField_ShouldReturnDecryptedValue_WhenValueIsArray()
    {
        $array = [
            'key' => 'value'
        ];
        $encrypt = Crypt::encrypt($array);
        $decryptField = $this->decryptField($encrypt);

        $this->assertEquals($array, $decryptField);
    }

    /**
     * @test
     */
    public function testDecryptField_ShouldReturnDecryptedValue_WhenValueIsNotJson()
    {
        $value = "string";
        $encrypt = Crypt::encrypt($value);
        $decryptField = $this->decryptField($encrypt);

        $this->assertEquals($value, $decryptField);
    }

    /**
     * @test
     */
    public function testDecryptValue_ShouldReturnDecryptValue_IfConfigSettingsIsTrue()
    {
        $value = 1234;
        $encrypt = Crypt::encrypt($value);
        $decryptValue = $this->decryptValue($encrypt);

        $this->assertEquals($value, $decryptValue);
    }

    /**
     * @test
     */
    public function testDecryptValue_ShouldReturnEncryptValue_IfConfigSettingsIsFalse()
    {

        config(['encryption.encrypt' => false]);
        $value = 1234;
        $encrypt = Crypt::encrypt($value);
        $decryptValue = $this->decryptValue($encrypt);

        $this->assertEquals($encrypt, $decryptValue);
    }

    /**
     * @test
     */
    public function testDecryptValue_ShouldReturnDecryptValue_IfValueIsNotNull()
    {
        $value = 1234;
        $encrypt = Crypt::encrypt($value);
        $decryptValue = $this->decryptValue($encrypt);

        $this->assertEquals($value, $decryptValue);
    }
}