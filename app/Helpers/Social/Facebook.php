<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 23-Oct-2015
 * Time: 21:07
 */

namespace App\Helpers\Social;

use App\User;
use Facebook\Facebook as FacebookApp;

class Facebook
{
    const DEFAULT_GRAPH_VERSION = 'v2.5';
    private $keys;
    private $facebookConnection;

    public function __construct(User $user)
    {
        $this->setKeys($user);
        $this->setConnection($this->getKeys());
    }

    public function sendMessage($data)
    {
        $pageId = $this->getKeys()['facebook_id'];
        $response = $this->facebookConnection->post('/' . $pageId . '/feed', $data);
    }

    private function setKeys(User $user)
    {
        $user_keys = $user->facebookConfig;
        if ($user_keys != null) {
            $this->keys['app_id'] = $user_keys->app_id;
            $this->keys['app_secret'] = $user_keys->app_secret;
            $this->keys['default_graph_version'] = self::DEFAULT_GRAPH_VERSION;
            $this->keys['access_token'] = $user_keys->access_token;
            $this->keys['facebook_id'] = $user_keys->facebook_id; // Page or group ID.
        }
    }

    public function getKeys()
    {
        return $this->keys;
    }

    private function setConnection($keys)
    {
        $connectionKeys = [
            'app_id' => $keys['app_id'],
            'app_secret' => $keys['app_secret'],
            'default_graph_version' => $keys['default_graph_version']
        ];
        $this->facebookConnection = new FacebookApp($connectionKeys);

        $this->facebookConnection->setDefaultAccessToken($keys['access_token']);
    }
}