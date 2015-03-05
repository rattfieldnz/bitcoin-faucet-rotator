<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 05-Mar-2015
 * Time: 15:54
 */

namespace Helpers\Transformers;


class UserTransformer extends Transformer {

    public function transform($user)
    {
        return [
            'id' => (int)$user['id'],
            'user_name' => $user['user_name'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'bitcoin_address' => $user['bitcoin_address'],
        ];
    }
}