# [MRZ]() for PHP

Machine Readable Zone for PHP, originally based on [mrz](https://github.com/MrEko/mrz)

## Install

Via [Composer](https://getcomposer.org/)

``` bash
composer require alphaolomi/mrz
```

## Usage

### Writing

``` php
use Alphaolomi\Mrz\Mrz;

$mrz = new Mrz("I", "Tanzania", "D23148958907", date("dmy",strtotime("1999-10-14")), "M", date("dmy",strtotime("2030-12-31")), "TZA", "OLOMI", "ALPHA");

echo $mrz->TD1CodeGenerator();
```

### Reading

``` php
use Alphaolomi\Mrz\MrzParser;

$mrzParser = new MrzParser();

$mrzOcrString = 'PTUNKKONI<<MARTINA<<<<<<<<<<<<<<<<<<<<<<<<<<K0503499<8UNK9701241F06022201170650553<<<<10';

$mrzData = $mrzParser->parse($mrzOcrString);

print(json_encode($mrzData, JSON_PRETTY_PRINT));
```

#### Reading Formats Supported

1. TD1

    ```
    I<UTOD231458907<<<<<<<<<<<<<<<
    7408122F1204159UTO<<<<<<<<<<<6
    ERIKSSON<<ANNA<MARIA<<<<<<<<<<
    ```

1. TD2

    ```
    I<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<
    D231458907UTO7408122F1204159<<<<<<<6
    ```

1. TD3

    ```
    P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<
    L898902C36UTO7408122F1204159ZE184226B<<<<<14
    ```

1. MRV

    ```
    V<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<
    L8988901C4XXX4009078F96121096ZE184226B<<<<<<
    ```


## Testing

Unit tests are written with [PHPUnit](https://phpunit.de/).

``` bash
composer test
```

## Credits

- [Evandro Kondrat](https://github.com/MrEko) Original Author
- [Alpha Olomi](https://github.com/alphaolomi)
- [Nascent Michael](https://github.com/nascent1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
