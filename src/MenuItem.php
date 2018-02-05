<?php

namespace Jevets\Menuer;

use JsonSerializable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Support\Jsonable;

class MenuItem implements Jsonable, JsonSerializable
{
    use HasItems;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var string
     */
    protected $can;

    /**
     * Create a new instance
     *
     * @param array $attributes
     * @return void
     */
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

    /**
     * @param string $can
     * @return string
     */
    public function can($can = '')
    {
        if ($can) {
            $this->can = $can;
        }

        return $this->can;
    }

    /**
     * @param boolean $condition
     * @return boolean
     */
    public function active($condition = false)
    {
        if ($condition) {
            $this->active = (boolean) $condition;
        }

        return $this->active;
    }

    /**
     * @param array $items
     * @return array \Jevets\Menuer\MenuItem[]
     */
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

    /**
     * Convert each item from array to a `MenuItem` object
     *
     * @param array $items
     * @return void
     */
    protected function setItems($items)
    {
        $this->items = collect($items)->transform(function ($item) {
            return new MenuItem($item);
        });
    }

    /**
     * Convert the object info something JSON serializable.
     *
     * @return string
     */
    public function jsonSerialize()
    {
        return [
            'label' => (string) $this->label(),
            'url' => (string) $this->url(),
            'active' => (boolean) $this->active(),
            'can' => (string) $this->can($this->can),
        ];
    }

    /**
     * Convert the menu to its JSON representation
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object to its string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
