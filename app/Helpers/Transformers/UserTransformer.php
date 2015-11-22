<?php namespace Helpers\Transformers;

/**
 * Class UserTransformer
 * This class is responsible for showing
 * user related data in a specified format.
 * @package Helpers\Transformers
 */
class UserTransformer extends Transformer
{

    /**
     * The method which transforms the
     * user related data.
     * @param $user
     * @return array
     */
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
