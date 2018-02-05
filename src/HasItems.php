<?php

namespace Jevets\Menuer;

trait HasItems
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param array $items
     * @return void
     */
    protected function addItems(array $items = [])
    {
        $this->items = collect($items)->transform(function ($item) {
            return $this->transformItem($item);
        })->toArray();
    }

    /**
     * @param array $item
     * @return array \Jevets\Menuer\MenuItem[]
     */
    protected function transformItem(array $item)
    {
        return new MenuItem($item);
    }

    /**
     * @return boolean
     */
    public function hasChildren()
    {
        return count($this->items) > 0;
    }

    /**
     * Optionally set, then get the menu items
     *
     * @param array $items
     * @return array
     */
    public function items(array $items = [])
    {
        if (count($items) > 0) {
            $this->setItems($items);
        }

        return $this->items;
    }
}
