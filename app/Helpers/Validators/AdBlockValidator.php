<?php namespace Helpers\Validators;

use Illuminate\Validation\Validator;

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
