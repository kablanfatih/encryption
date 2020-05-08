<?php

namespace Kablanfatih\Encryption\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Crypt;
use Tests\BaseTestCase;
use Tests\TestModel;

class EncryptableTest extends BaseTestCase
{
    use DatabaseMigrations;

    private $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new TestModel();
    }

    /**
     * @test
     */
    public function testGetAttribute()
    {
        $value = 0123456;
        $this->model->phone = $value;
        $this->model->save();
        $decrypt = Crypt::decrypt($this->model->getAttributeValue('phone'));
        $this->assertEquals($value, $decrypt);
    }

    /**
     * @test
     */
    public function testSetAttribute_ShouldSaveNotEncrypt_WhenEncryptIsFalse()
    {
        config(['encryption.encrypt' => false]);
        $value = 'Kablan';
        $this->model->surname = $value;
        $this->model->save();
        $this->assertEquals($value, $this->model->surname);
    }

    /**
     * @test
     */
    public function testSetAttribute_ShouldSaveEncrypt_WhenIsJson()
    {
        $value = json_encode([
            'language' => 'PHP',
            'framework' => 'Laravel'
        ]);
        $this->model->body= $value;
        $this->model->save();
        $this->assertEquals(json_decode($value), $this->model->body);
    }

    /**
     * @test
     */
    public function testAttributesToArray()
    {
        $this->model->surname = 'Kablan';
        $this->model->phone = '12345';
        $this->model->save();

        $this->assertEquals('Kablan', $this->model->attributesToArray()['surname']);
        $this->assertEquals('12345', $this->model->attributesToArray()['phone']);
    }

    /**
     * @test
     */
    public function testAttributesToArray_ShouldSaveNotEncrypt_WhenEncryptIsFalse()
    {
        config(['encryption.encrypt' => false]);
        $this->model->surname = 'Kablan';
        $this->model->phone = '12345';
        $this->model->save();

        $this->assertEquals('Kablan', $this->model->attributesToArray()['surname']);
        $this->assertEquals('12345', $this->model->attributesToArray()['phone']);
    }
}