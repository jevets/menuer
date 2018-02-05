<?php

require __DIR__ . '/../vendor/autoload.php';

use Jevets\Menuer\Menu;

$items = [
    [
        'label' => 'Home',
        'url' => '/',
    ],
    [
        'label' => 'About',
        'url' => '/about',
    ],
    [
        'label' => 'Contact',
        'url' => '/contact',
    ],
    [
        'label' => 'Parent',
        'url' => '/section',
        'items' => [
            [
                'label' => 'Child 1',
                'url' => '/section/child-1',
            ],
            [
                'label' => 'Child 2',
                'url' => '/section/child-2',
            ],
        ],
    ],
];

$menu = new Menu('main', $items);
$menu->label('Main Menu');
