<?php
/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 05-Mar-2015
 * Time: 13:36
 */

namespace Helpers\Transformers;


abstract class Transformer {

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}