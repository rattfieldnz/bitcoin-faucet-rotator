<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 19/03/2017
 * Time: 20:43
 */

namespace Http\Controllers;


/**
 * Interface IController
 * @package Http\Controllers
 */
interface IController
{
    /**
     * @param array $input
     * @return array
     */
    static function cleanInput(array $input);
}