<?php

namespace PhpCollective\MenuMaker;


class MenuItem
{
    public $name;
    public $alias;
    public $routes;
    public $link;
    public $icon;
    public $class;
    public $attr;
    public $active;
    public $children;

    /**
     * Create a new MenuItem instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value)
        {
            if(property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function url() : string
    {
        return url($this->link);
    }

    public function hasChildren() : bool
    {
        return $this->children->count() > 0;
    }
}
