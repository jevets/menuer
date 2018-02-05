<?php

namespace Jevets\Menuer;

class Menu
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
}
