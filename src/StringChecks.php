<?php

namespace Alphaolomi\Mrz;

use Alphaolomi\Mrz\Helper;

/**
 * Trait StringChecks
 *
 * @package Alphaolomi\Mrz
 * @version 1.0.0
 *
 * @author Evandro Kondrat
 */
trait StringChecks
{
    function document_type()
    {
        return Helper::id($this->document_type);
    }

    function document_number()
    {
        return Helper::field($this->document_number, 9);
    }

    function sex()
    {
        return Helper::sex($this->sex);
    }

    function country_code()
    {
        return Helper::country($this->country_code);
    }

    function nationality()
    {
        return Helper::country($this->nationality);
    }

    private function optional_data1()
    {
        return Helper::field(Helper::transliterate($this->optional_data1), 15);
    }

    private function optional_data2()
    {
        return Helper::field(Helper::transliterate($this->optional_data2), 11);
    }
}
