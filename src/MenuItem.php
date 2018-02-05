<?php

namespace Jevets\Menuer;

use Illuminate\Support\Facades\Gate;

class MenuItem
{
    use HasItems;

    protected $label;
    protected $url;
    protected $active;
    protected $can;

    public function __construct(array $attributes = [])
    {
        $this->setItems(array_get($attributes, 'items', []));
        $this->label(array_get($attributes, 'label'));
        $this->url(array_get($attributes, 'url'));
        $this->active(array_get($attributes, 'active', false));
        $this->can(array_get($attributes, 'can', true));
    }

    /**
     * Get or set the label
     *
     * @param string $label
     * @return string
     */
    public function label($label = null)
    {
        if ($label) {
            $this->label = $label;
        }

        return $this->label;
    }

    /**
     * Get or set the item URL
     *
     * @param string $url
     * @return string
     */
    public function url($url = null)
    {
        if ($url) {
            $this->url = $url;
        }

        return $this->url;
    }

    public function can($can = '')
    {
        if ($can) {
            $this->can = $can;
        }

        return $this->can;
    }

    public function active($condition = false)
    {
        if ($condition) {
            $this->active = (boolean) $condition;
        }

        return $this->active;
    }

    public function items(array $items = [])
    {
        if (count($items) > 0) {
            $this->setItems($items);
        }

        return collect($this->items)->filter(function ($item) {
            if ($item->can) {
                return Gate::allows($item->can);
            }
            return $item;
        })->toArray();
    }

    protected function setItems($items)
    {
        $this->items = collect($items)->transform(function ($item) {
            return new MenuItem($item);
        });
    }

    public function hasChildren()
    {
        return count($this->items) > 0;
    }
}
