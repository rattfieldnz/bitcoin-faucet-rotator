<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 11-Mar-2015
 * Time: 15:25
 */

namespace Helpers\Validators;


use Illuminate\Validation\Validator;

class FaucetValidator extends Validator{
     public function validateEach($attribute, $values, $parameters)
     {
         $rule = array_shift($parameters);

         $method = 'validate' . studly_case($rule);

         foreach($values as $value)
         {
             if(! $this->validateExists($attribute, $value, $parameters))
             {
                 return false;
             }
         }

         return true;
     }
}