<?php

namespace Raakkan\ThemesManager\Menu;

use Illuminate\Contracts\Support\Arrayable;
use Raakkan\ThemesManager\Support\Traits\HasName;

class Menu implements Arrayable
{
    use HasName;

    protected $items = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function make($name)
    {
        return new static($name);
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'items' => $this->items,
        ];
    }
}