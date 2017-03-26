<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 26/03/2017
 * Time: 17:52
 */

namespace Helpers\Validators;


use Illuminate\Validation\Validator;

/**
 * Class AdminValidator
 * @package Helpers\Validators
 */
class AdminValidator extends Validator
{
    /**
     * Validates updates to an admin user.
     * I.D is used so unchanged unique attributes can
     * still be submitted without any duplication
     * errors.
     *
     * @param $id
     * @return array
     */
    public static function validationRulesEdit($id)
    {
        return [
            'user_name' => 'min:5|max:15|required|unique:users,user_name, ' . $id,
            'first_name' => 'required|min:1|max:50',
            'last_name' => 'required|min:1|max:50',
            'email' => 'required|email|unique:users,email, ' . $id,
            'password' => [
                'required',
                'confirmed',
                'min:10',
                'max:20',
                // Regex sourced from https://regex101.com/r/pX7jN4/3
                'regex:/^(?=(?:.*[A-Z]){2,})(?=(?:.*[a-z]){2,})(?=(?:.*\d){2,})(?=(?:.*[!@#$%^&*()\-_=+{};:,<.>]){2,})(.{10,20})$/'
            ],
            'bitcoin_address' => 'required|string|min:26|max:35|unique:users,bitcoin_address, ' . $id,
        ];
    }
}