<?php namespace Helpers\Transformers;

/**
 * Class Transformer
 * This class is responsible for showing
 * general collections of data, specified by
 * the abstract 'transform' method.
 * @package Helpers\Transformers
 */
abstract class Transformer
{

    /**
     * This method transforms a collection of data
     * into a specified format, determined by the
     * transform method.
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * This method is used for transforming a single
     * item with a defined format.
     * @param $item
     * @return mixed
     */
    abstract public function transform($item);
}
