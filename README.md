# MRZ for PHP

Machine Readable Zone for PHP, originally based on [mrz](https://github.com/MrEko/mrz)

## Install

Via [Composer](https://getcomposer.org/)

``` bash
composer require alphaolomi/mrz
```

## Usage

``` php
$mrz = new Mrz("I", "Tanzania", "D23148958907", date("dmy",strtotime("1999-10-14")), "M", date("dmy",strtotime("2030-12-31")), "TZA", "OLOMI", "ALPHA");

echo $mrz->TD1CodeGenerator();
```

## Testing

``` bash
composer test
```

## Credits

- [Evandro Kondrat][https://github.com/MrEko] Original Author
- [Alpha Olomi][https://github.com/alphaolomi]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
