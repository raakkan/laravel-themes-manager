<?php

namespace Raakkan\ThemesManager\Menu;

use Illuminate\Contracts\Support\Arrayable;
use Raakkan\ThemesManager\Menu\Traits\HasItems;

class Menu implements Arrayable
{
    use HasItems;

    /**
     * The menu name.
     *
     * @var string
     */
    protected $name;

    protected $location;

    protected $is_active = true;

    /**
     * Create a new Menu instance.
     */
    public function __construct(string $name, ?string $location, bool $is_active = true)
    {
        $this->name = $name;
        $this->items = collect();
        $this->location = $location;
        $this->is_active = $is_active;
    }

    /**
     * Search item by key and value recursively.
     *
     * @param string $key
     * @param string $value
     *
     * @return mixed
     */
    public function searchBy($key, $value, ?callable $callback = null): ?Item
    {
        $matchItem = null;

        $this->items->first(function ($item) use (&$matchItem, $key, $value) {
            if ($foundItem = $item->findBy($key, $value)) {
                $matchItem = $foundItem;
            }
        });

        if (is_callable($callback) && $matchItem) {
            call_user_func($callback, $matchItem);
        }

        return $matchItem;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'location' => $this->location,
            'is_active' => $this->is_active,
            'items' => $this->items->toArray(),
        ];
    }
}