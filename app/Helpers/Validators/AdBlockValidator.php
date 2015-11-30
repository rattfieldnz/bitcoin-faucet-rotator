<?php namespace Helpers\Validators;

use Illuminate\Validation\Validator;

/**
 * Class AdBlockValidator
 *
 * A class to handle validation of Ad block
 * updates and creation.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package Helpers\Validators
 */
class AdBlockValidator extends Validator
{
    /**
     * Validates new ad block entries.
     * @return array
     */
    public static function validationRules()
    {
        return [
            'ad_content' => 'string',
            'user_id' => 'required|integer'
        ];
    }
}
