<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 28-Jun-2015
 * Time: 15:25
 */

namespace App\Http\Controllers;

class BaseController extends Controller {
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }
}