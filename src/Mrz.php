<?php

declare(strict_types=1);

namespace Alphaolomi\Mrz;

/**
 * Write MRZ code for TD1 format
 *
 * @package Alphaolomi\Mrz
 * @version 1.0.0
 * @see https://en.wikipedia.org/wiki/Machine-readable_passport
 */
class Mrz
{
    use HashGenerator, StringChecks;

    private string $document_type;
    private string $country_code;
    private string $document_number;
    private string $birth_date;
    private string $sex;
    private string $expiry_date;
    private string $nationality;
    private string $surname;
    private string $given_names;
    private string $optional_data1 = "";
    private string $optional_data2 = "";
    private bool $gen_hash_doc = true;

    public function __construct(
        string $document_type,
        string $country_code,
        string $document_number,
        string $birth_date,
        string $sex,
        string $expiry_date,
        string $nationality,
        string $surname,
        string $given_names,
        string $optional_data1 = "",
        string $optional_data2 = "",
        bool $force = false
    ) {
        $this->document_type = $document_type;
        $this->country_code = $country_code;
        $this->document_number = $document_number;
        $this->birth_date = $birth_date;
        $this->sex = $sex;
        $this->expiry_date = $expiry_date;
        $this->nationality = $nationality;
        $this->surname = $surname;
        $this->given_names = $given_names;
        $this->optional_data1 = $optional_data1;
        $this->optional_data2 = $optional_data2;

        $this->handleBiggerDocumentNumbers();
    }

    /**
     * Generate TD1 code
     */
    public function TD1CodeGenerator(): string
    {
        return $this->line1() . PHP_EOL . $this->line2() . PHP_EOL . $this->line3();
    }

    private function line1(): string
    {
        return $this->document_type() . $this->country_code() . $this->document_number() . $this->document_number_hash() . $this->optional_data1();
    }

    private function line2(): string
    {
        return $this->birth_date . $this->birth_date_hash() . $this->sex() . $this->expiry_date . $this->expiry_date_hash() . $this->nationality() . $this->optional_data2() . $this->final_hash();
    }

    private function line3(): string
    {
        return Helper::field(Helper::transliterate($this->surname) . "<<" . Helper::transliterate($this->given_names), 30);
    }

    private function final_hash(): string
    {
        return Helper::hash_string(
            $this->document_number() .
                $this->document_number_hash() .
                $this->optional_data1() .
                $this->birth_date .
                $this->birth_date_hash() .
                $this->expiry_date .
                $this->expiry_date_hash() .
                $this->optional_data2()
        );
    }

    private function handleBiggerDocumentNumbers(): void
    {
        if (strlen($this->document_number) > 9) {
            $first_part = substr($this->document_number, 0, 9);
            $second_part = substr($this->document_number, 9);

            $this->gen_hash_doc = false;
            $this->document_number = $first_part;
            $this->optional_data1 = $second_part . Helper::hash_string($first_part . "<" . $second_part);
        }
    }
}
