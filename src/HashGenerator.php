<?php

namespace Alphaolomi\Mrz;

/**
 * Trait HashGenerator
 *
 * @package Alphaolomi\Mrz
 * @version 1.0.0
 */
trait HashGenerator
{
    /**
     * Generates a hash for the document number.
     *
     * Returns a hash string if the document number is to be hashed,
     * otherwise returns a placeholder character.
     *
     * @return string The hash string or a placeholder.
     */
    public function document_number_hash(): string
    {
        return $this->gen_hash_doc ? Helper::hash_string($this->document_number) : "<";
    }

    /**
     * Generates a hash for the birth date.
     *
     * @return string The hash string for the birth date.
     */
    public function birth_date_hash(): string
    {
        return Helper::hash_string($this->birth_date);
    }

    /**
     * Generates a hash for the expiry date.
     *
     * @return string The hash string for the expiry date.
     */
    public function expiry_date_hash(): string
    {
        return Helper::hash_string($this->expiry_date);
    }
}
