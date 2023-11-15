<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Alphaolomi\Mrz\MrzParser;

final class MrzParserTest extends TestCase
{
    private const VALID_TD1_MRZ_STRING = '
        I<UTOD231458907<<<<<<<<<<<<<<<
        7408122F1204159UTO<<<<<<<<<<<6
        ERIKSSON<<ANNA<MARIA<<<<<<<<<<
    ';


    private const VALID_TD3_MRZ_STRING = '
        P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<
        L898902C36UTO7408122F1204159ZE184226B<<<<<14
    ';

    public function testParserCanBeCreatedFromValidMrzParserInstance(): void
    {
        $mrzParser = new MrzParser();
        $this->assertInstanceOf(MrzParser::class, $mrzParser);
    }

    public function testMrzParserParsesValidMrzTd1StringCorrectly(): void
    {
        $mrzParser = new MrzParser();
        $parsedData = $mrzParser->parseMRZ(self::VALID_TD1_MRZ_STRING);
        $this->assertIsArray($parsedData);
    }


    public function testMrzParserParsesValidMrzTd3StringCorrectly(): void
    {
        $mrzParser = new MrzParser();
        $parsedData = $mrzParser->parseMRZ(self::VALID_TD3_MRZ_STRING);
        $this->assertIsArray($parsedData);
    }
}
