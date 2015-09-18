<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 18-Sep-2015
 * Time: 16:45
 */

namespace Helpers\Validators;

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