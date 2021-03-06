[![Build Status](https://travis-ci.org/alceanicu/cif.svg?branch=master)](https://travis-ci.org/alceanicu/cif) [![Latest Stable Version](https://poser.pugx.org/alcea/cif/v/stable.svg)](https://packagist.org/packages/alcea/cif) [![Total Downloads](https://poser.pugx.org/alcea/cif/downloads.svg)](https://packagist.org/packages/alcea/cif) [![License](https://poser.pugx.org/alcea/cif/license.svg)](https://packagist.org/packages/alcea/cif) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alceanicu/cif/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alceanicu/cif/?branch=master)

# CIF
PHP validation for Romanian VAT code (Validare PHP pentru CIF/ CUI)

# How to install?

### 1. use composer
```php
composer require alcea/cif
```

### 2. or, edit require section from composer.json
```
"alcea/cif": "^1.1"
```

# How to use?

```php
<?php
# require __DIR__ . '\vendor\autoload.php';
use alcea\cif\Cif;

$cifToBeValidated = '159'; // without prefix digit (RO|R)
$cif = new Cif($cifToBeValidated);
echo "CIF {$cifToBeValidated} is " . ( $cif->isValid() ? 'valid' : 'invalid' ) . PHP_EOL;

// or

echo "CIF {$cifToBeValidated} is " . ( Cif::validate($cifToBeValidated) ? 'valid' : 'invalid' ) . PHP_EOL;
```
 
 # How to run tests?
```
## Open an terminal and run commands:
git clone https://github.com/alceanicu/cif.git
cd cif
composer install
./vendor/bin/phpunit --bootstrap ./vendor/autoload.php --testdox
```


## License

This package is licensed under the [MIT](http://opensource.org/licenses/MIT) license.
