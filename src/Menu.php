<?php

namespace Jevets\Menuer;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;

class Menu implements Jsonable, JsonSerializable
{
    use HasItems;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @param string $name
     * @param array $items
     * @param string $label
     * @return void
     */
    public function __construct($name, array $items = [], $label = null)
    {
        $this->name($name);
        $this->label($label);

        $this->addItems($items);
    }

    /**
     * @param string $name
     * @return string
     */
    public function name($name = null)
    {
        if ($name) {
            $this->name = $name;
        }

        return $this->name;
    }

    /**
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
     * @return string
     */
    public function jsonSerialize()
    {
        $items = collect($this->items())->transform(function ($item) {
            return $item->jsonSerialize();
        });

        return [
            'name' => (string) $this->name(),
            'label' => (string) $this->label(),
            'items' => $items,
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
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
