<?php

namespace Encryption\src;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    /**
     * Determine if the field is JSON.
     *
     * @param $json
     * @return bool
     */
    public function ifJson($json): bool
    {
        $ob = json_decode($json);

        return $ob === null ? false : true;
    }

    /**
     * Decrypt field.
     *
     * @param $value
     * @return mixed
     */
    public function decryptField($value)
    {
        $decrypt = $this->decryptValue($value);

        if (!is_array($decrypt) && $this->ifJson($decrypt))
            $decrypt = json_decode($decrypt);

        return $decrypt;
    }

    /**
     * Decrypt the column value if it is in the encrypted array.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encrypted ?? [])) {
            $value = $this->decryptField($value);
        }
        return $value;
    }

    /**
     * Decrypts a value only if it is not null and not empty.
     *
     * @param $value
     *
     * @return mixed
     */
    protected function decryptValue($value)
    {
        if (config('encryption.encrypt') && $value !== null && !empty($value)) {
            return Crypt::decrypt($value);
        }

        return $value;
    }

    /**
     * Set the value, encrypting it if it is in the encrypted array.
     *
     * @param $key
     * @param $value
     *
     * @return
     */
    public function setAttribute($key, $value)
    {
        if (config('encryption.encrypt')) {
            if ($value !== null && in_array($key, $this->encrypted ?? [])) {
                $value = Crypt::encrypt($value);
            }
        }
        return parent::setAttribute($key, $value);
    }

    /**
     * Retrieves all values and decrypts them if needed.
     *
     * @return mixed
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        if (!config('encryption.encrypt'))
            return $attributes;

        foreach ($this->encrypted ?? [] as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = $this->decryptValue($attributes[$key]);
            }
        }
        return $attributes;
    }
}
