<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Alphaolomi\Mrz\Helper;

final class HelperTest extends TestCase
{
    public function testField(): void
    {
        $this->assertEquals(
            'STRING<<',
            Helper::field('string', 8)
        );
    }

    public function testTransliterate(): void
    {
        $this->assertEquals(
            'EVANDRO<KONDRAT',
            Helper::transliterate('evandro kondrat')
        );
    }

    public function testSex(): void
    {
        $this->assertEquals(
            'M',
            Helper::sex('m')
        );
    }

    public function testSex1(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Sex Error');

        Helper::sex('X');
    }

    public function testCountry(): void
    {
        $this->assertEquals(
            'ALB',
            Helper::country('alb')
        );
    }

    public function testCountry1(): void
    {
        $this->assertEquals(
            'YEM',
            Helper::country('yemen')
        );
    }

    public function testCountry2(): void
    {
        $this->assertEquals(
            'SRB',
            Helper::country('seRbIA')
        );
    }

    public function testHash(): void
    {
        $this->assertEquals(
            '7',
            Helper::hash_string('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
        );

        $this->assertEquals(
            '7',
            Helper::hash_string('0123456789')
        );

        $this->assertEquals(
            '0',
            Helper::hash_string('0123456789ABCDEF')
        );

        $this->assertEquals(
            '0',
            Helper::hash_string('0')
        );
    }

    public function testBreakFullName(): void
    {
        $this->assertEquals(
            ['Evandro', 'Kondrat'],
            Helper::break_full_name('Evandro Kondrat')
        );

        $this->assertEquals(
            ['Evandro Soares', 'Kondrat'],
            Helper::break_full_name('Evandro Soares Kondrat')
        );

        $this->assertEquals(
            ['Evandro Soares Zee', 'Kondrat'],
            Helper::break_full_name('Evandro Soares Zee Kondrat')
        );

        $this->assertEquals(
            ['Evandro S d O Q', 'Kondrat'],
            Helper::break_full_name('Evandro Soares de Oliveira Quirino Kondrat')
        );

        $this->assertEquals(
            ['INGRID', 'M B D OLIVEIRA'],
            Helper::break_full_name('INGRID MARQUES BARBOSA DE OLIVEIRA', 'XX BARBOSA DE OLIVEIRA', 'XX MARQUES')
        );

        $this->assertEquals(
            ['EMILY C', 'D D ALMEIDA'],
            Helper::break_full_name('EMILY CAROLINA DINIZ DE ALMEIDA', 'XX CELSO DINIZ DE ALMEIDA', 'XX MARIA DINIZ DE ALMEIDA')
        );

        $this->assertEquals(
            ['ERICA APARECIDA', 'QUIRINO'],
            Helper::break_full_name('ERICA APARECIDA QUIRINO', 'XX QUIRINO', 'XX QUIRINO')
        );

        $this->assertEquals(
            ['JESSICA PEREIRA', 'FABRICIO'],
            Helper::break_full_name('JESSICA PEREIRA FABRICIO', 'XX BASSANI FABRICIO', 'XX FABRICIO')
        );

        $this->assertEquals(
            ['LUCAS ANTONIO', 'ROSINA ADRIANO'],
            Helper::break_full_name('LUCAS ANTONIO ROSINA ADRIANO', 'xx GOMES ADRIANO', 'xx ROSINA ADRIANO')
        );

        $this->assertEquals(
            ['ANA GIULIA', 'NEGRELI DOS SANTOS'],
            Helper::break_full_name('ANA GIULIA NEGRELI DOS SANTOS', 'XX BERNARDO DOS SANTOS', 'XX DA SILVA NEGRELI SANTOS')
        );

        $this->assertEquals(
            ['ANA LUIZA', 'SANTOS CABRAL'],
            Helper::break_full_name('ANA LUIZA SANTOS CABRAL', 'XX DOS SANTOS', 'XX DOS SANTOS')
        );

        $this->assertEquals(
            ['ANA LUIZA', 'SANTOS MOURA CABRAL'],
            Helper::break_full_name('ANA LUIZA SANTOS MOURA CABRAL', 'XX DOS SANTOS', 'XX DOS SANTOS')
        );

        $this->assertEquals(
            ['ANNA L', 'I MURTA'],
            Helper::break_full_name('ANNA LYDIA ISKOROSTENSKI MURTA', 'XX TATIANA VIEIRA ISKOROSTENSKI MURTA', 'XX AUGUSTO MURTA')
        );
    }
}
