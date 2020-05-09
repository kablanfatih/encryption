#encryption

![PHP Composer](https://github.com/kablanfatih/encryption/workflows/PHP%20Composer/badge.svg)

#### A package for automatically encrypting and decrypting Eloquent attributes in Laravel , based on configuration settings.

### Installation

Via Composer command line:

`composer require kablanfatih/encryption`

#### Configure the package

simply setting the the DB_ENCRYPTION_ENABLED environment variable to true, via the Laravel .env file or hosting environment.

`DB_ENCRYPTION_ENABLED=true`

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
