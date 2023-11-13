<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Alphaolomi\Mrz\Mrz;

final class MrzTest extends TestCase
{
    /**
     *
     */
    public function testTd1Case01(): void
    {
        $mrz = new Mrz(
            "ID",
            "ESP",
            "BAA000589",
            "800101",
            "F",
            "250101",
            "ESP",
            "ESPAÑOLA ESPAÑOLA",
            "CARMEN",
            "99999999R"
        );


        $this->assertEquals(
            "IDESPBAA000589599999999R<<<<<<" . PHP_EOL . "8001014F2501017ESP<<<<<<<<<<<7" . PHP_EOL . "ESPANOLA<ESPANOLA<<CARMEN<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case02(): void
    {
        $mrz = new Mrz(
            "id",
            "srb",
            "955555546",
            "680229",
            "f",
            "130724",
            "seRbIA",
            "Test",
            "milica",
            "2902968000000",
            ""
        );


        $this->assertEquals(
            "IDSRB95555554612902968000000<<" . PHP_EOL . "6802295F1307245SRB<<<<<<<<<<<6" . PHP_EOL . "TEST<<MILICA<<<<<<<<<<<<<<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case03(): void
    {
        $mrz = new Mrz(
            "id",
            "BRA",
            "9234",
            "870322",
            "M",
            "130724",
            "BRA",
            "Kondrat",
            "Evandro"
        );


        $this->assertEquals(
            "IDBRA9234<<<<<0<<<<<<<<<<<<<<<" . PHP_EOL . "8703226M1307245BRA<<<<<<<<<<<4" . PHP_EOL . "KONDRAT<<EVANDRO<<<<<<<<<<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case04(): void
    {
        $mrz = new Mrz(
            "ID",              # Document type
            "Belgium",         # Country
            "000590448301",       # Document number
            "850101",          # Birth date
            "F",               # Genre
            "170203",          # Expiry date
            "Belgium",         # Nationality
            "Le Meunier",      # Surname
            "Jennifer Anne",   # Given name(s)
            "",                # Optional data 1: This field is null. I still have to think what to do with it
            "85010100200"
        );    # Optional data 2

        $this->assertEquals(
            "IDBEL000590448<3016<<<<<<<<<<<" . PHP_EOL . "8501019F1702035BEL850101002007" . PHP_EOL . "LE<MEUNIER<<JENNIFER<ANNE<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case5(): void
    {
        $mrz = new Mrz(
            "ID",              # Document type
            "Belgium",         # Country
            "000610035701",       # Document number
            "000201",          # Birth date
            "F",               # Genre
            "091019",          # Expiry date
            "Belgium",         # Nationality
            "Maes",            # Surname
            "Sophie Ann G",    # Given name(s)
            "blahblah",                # Optional data 1. Canceled
            "00020100200"
        );    # Optional data 2

        $this->assertEquals(
            "IDBEL000610035<7017<<<<<<<<<<<" . PHP_EOL . "0002015F0910190BEL000201002003" . PHP_EOL . "MAES<<SOPHIE<ANN<G<<<<<<<<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case6(): void
    {
        $mrz = new Mrz(
            "ID",              # Document type
            "BEL",             # Country
            "B100326500",        # Document number
            "821020",          # Birth date
            "F",               # Genre
            "060131",          # Expiry date
            "New Zealand",     # Nationality
            "Flores",          # Surname
            "Gema Caroline J", # Given name(s)
            "",              # Optional data 1. CANCELLED
            "82102008472"
        );    # Optional data 2

        $this->assertEquals(
            "IDBELB10032650<08<<<<<<<<<<<<<" . PHP_EOL . "8210209F0601315NZL821020084722" . PHP_EOL . "FLORES<<GEMA<CAROLINE<J<<<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case7(): void
    {
        $mrz = new Mrz(
            "ID",              # Document type
            "BEL",             # Country
            "B100326500",        # Document number
            "821020",          # Birth date
            "F",               # Genre
            "060131",          # Expiry date
            "New Zealand",     # Nationality
            "Flores",          # Surname
            "Gema Caroline J", # Given name(s)
            "",              # Optional data 1. CANCELLED
            "82102008472"
        );    # Optional data 2

        $this->assertEquals(
            "IDBELB10032650<08<<<<<<<<<<<<<" . PHP_EOL . "8210209F0601315NZL821020084722" . PHP_EOL . "FLORES<<GEMA<CAROLINE<J<<<<<<<",
            $mrz->TD1CodeGenerator()
        );
    }

    public function testTd1Case8(): void
    {
        $mrz = new Mrz(
            "ID",              # Document type
            "BEL",             # Country
            "B100326500",        # Document number
            "821020",          # Birth date
            "F",               # Genre
            "060131",          # Expiry date
            "New Zealand",     # Nationality
            "SANTOS MOURA CABRAL",          # Surname
            "ANA LUIZA", # Given name(s)
            "",              # Optional data 1. CANCELLED
            "82102008472"
        );    # Optional data 2

        $this->assertEquals(
            "IDBELB10032650<08<<<<<<<<<<<<<" . PHP_EOL . "8210209F0601315NZL821020084722" . PHP_EOL . "SANTOS<MOURA<CABRAL<<ANA<LUIZA",
            $mrz->TD1CodeGenerator()
        );
    }
}
