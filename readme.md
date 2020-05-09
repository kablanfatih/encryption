# encryption

![PHP Composer](https://github.com/kablanfatih/encryption/workflows/PHP%20Composer/badge.svg)
<a href="https://packagist.org/packages/kablanfatih/encryption"><img alt="Packagist Downloads" src="https://img.shields.io/packagist/dt/kablanfatih/encryption"></a>
<a href="https://packagist.org/packages/kablanfatih/encryption"><img alt="Packagist Version" src="https://img.shields.io/packagist/v/kablanfatih/encryption"></a>
[![Build Status](https://scrutinizer-ci.com/g/kablanfatih/encryption/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kablanfatih/encryption/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kablanfatih/encryption/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kablanfatih/encryption/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kablanfatih/encryption/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Code Coverage](https://scrutinizer-ci.com/g/kablanfatih/encryption/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kablanfatih/encryption/?branch=master)

#### A package for automatically encrypting and decrypting Eloquent attributes in Laravel , based on configuration settings.

### Installation

Via Composer command line:

`composer require kablanfatih/encryption`

#### Configure the package

simply setting the the DB_ENCRYPTION_ENABLED environment variable to true, via the Laravel .env file or hosting environment.

`DB_ENCRYPTION=true`

##### !!! If package not work !!!

Via Artisan command line:

`php artisan config:clear`
or
`php artisan optimize`

### Usage

Use the Encryptable trait in any Eloquent model that you wish to apply encryption to and define a protected $encrypted array containing a list of the attributes to encrypt.

```
 namespace App\Models;
 
 use Encryption\src\Encryptable;
 use Illuminate\Database\Eloquent\Model;
 
 class Question extends Model
 {
 
     use Encryptable;
     /**
      * The table associated with the model.
      *
      * @var string
      */
     protected $table = 'questions';
    
     /**
      * The attributes that are mass assignable.
      * @var array
      */
     protected $fillable = [
         'question', 'incorrect1', 'incorrect2', 'incorrect3', 'incorrect4', 'correct'
     ];
 
     /**
      * The attributes that are encrypted.
      *
      * @var array
      */
     protected $encrypted = [
         'question','answer'
     ];
 }
