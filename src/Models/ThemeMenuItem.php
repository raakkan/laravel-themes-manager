<?php

namespace Raakkan\ThemesManager\Models;

use Illuminate\Database\Eloquent\Model;

// TODO: menu and menu item add and update rules pending
class ThemeMenuItem extends Model
{
    protected $fillable = ['menu_id', 'name', 'order', 'url', 'icon', 'parent_id'];

    public function menu()
    {
        return $this->belongsTo(ThemeMenu::class);
    }

    public function parent()
    {
        return $this->belongsTo(ThemeMenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ThemeMenuItem::class, 'parent_id')->orderBy('order');
    }

    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    public function hasParent()
    {
        return $this->parent()->exists();
    }

    public function updateOrder($newPosition)
    {
        $oldPosition = $this->order;
        $parentId = $this->parent_id;

        if ($parentId === null) {
            $siblingItems = ThemeMenuItem::whereNull('parent_id')
                ->where('id', '!=', $this->id)
                ->orderBy('order')
                ->get();
        } else {
            $siblingItems = ThemeMenuItem::where('parent_id', $parentId)
                ->where('id', '!=', $this->id)
                ->orderBy('order')
                ->get();
        }

        foreach ($siblingItems as $siblingItem) {
            if ($oldPosition < $newPosition) {
                if ($siblingItem->order > $oldPosition && $siblingItem->order <= $newPosition) {
                    // dd($siblingItem->order, $oldPosition, $newPosition); try to understand
                    $siblingItem->order--;
                    $siblingItem->save();
                }
            } else {
                if ($siblingItem->order >= $newPosition && $siblingItem->order < $oldPosition) {
                    $siblingItem->order++;
                    $siblingItem->save();
                }
            }
        }

        $this->order = $newPosition;

        $this->save();
    }

    public static function addMenuItem($menu, $item)
    {
        $lastItem = self::where('menu_id', $menu->id)
            ->whereNull('parent_id')
            ->orderBy('order', 'desc')
            ->first();

        $order = $lastItem ? $lastItem->order + 1 : 0;

        $newItem = new self([
            'name' => $item['name'],
            'url' => $item['url'],
            'icon' => $item['icon'],
            'order' => $order,
        ]);

        $menu->items()->save($newItem);
    }

    public static function addAsChild($menu, $item, $parentId)
    {
        $lastChild = self::where('parent_id', $parentId)
            ->orderBy('order', 'desc')
            ->first();

        $order = $lastChild ? $lastChild->order + 1 : 0;

        $menuItem = new self([
            'name' => $item['name'],
            'order' => $order,
            'url' => $item['url'],
            'icon' => $item['icon'],
            'parent_id' => $parentId,
        ]);

        $menu->items()->save($menuItem);
    }

    public function getTable(): string
    {
        return config('themes-manager.menus.menu_items_database_table_name', 'theme_menu_items');
    }
}
