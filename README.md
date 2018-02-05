# Work in Progress

This is subject to change!

# Menuer

A simple menu system for Laravel applications.

Menus are defined via arrays and are JsonSerializable and Jsonable for use in PHP or JavaScript.

## Install

Manually add the repository to your Laravel app's `composer.json` file and require it.

```json
"repositories": [
  {
    "type": "git",
    "url": "https://github.com/jevets/menuer"
  }
],
"require": {
  "jevets/menuer": "dev-master"
}
```

Then run `composer update "jevets/menuer"`.

## Array setup

You can place your menu definitions anywhere you'd like. A good spot might be in `app/Http/Menus`. Create a seprate file for each menu.

Example menu:

```php
// app/Http/Menus/main.php
return [
  [
    'label' => 'Home',
    'url' => url('/'),
    'active' => request()->is('/'),
  ],
  [
    'label' => 'About',
    'url' => route('pages.about'),
    'active' => Route::is('about*'),
  ],
  [
    'label' => 'Private Page',
    'url' => route('private-page'),
    'active' => request()->is('private-page'),
    'can' => 'access-private-page',
  ],
];
```

Available keys:

`label`

The text shown inside the anchor element.

`url`

The value of the anchor's `href` attribute.

`active`

A boolean to determine whether the item is active.

`can`

Passed directly to Laravel's `Gate::allows()` function. Default is true, so omitting the `can` key will result in an item that is always shown.

## Templates

For now the system ships with a default menu view (a simple `<ul>` menu), and a [Bulma-compatible vertical menu](http://bulma.io/documentation/components/menu/).

(More templates are in progress and will be added as they're built.)

## Usage

The easiest way to build a menu is to create a [View Composer](https://laravel.com/docs/master/views#view-composers). But you can create a menu however you'd like.

### Basic Example

Here's an example with a View Composer and a Blade layout.

```php
// app/Http/ViewComposers/AppLayoutViewComposer.php
class AppLayoutViewComposer
{
  /**
   * @param \Illuminate\View\View $view
   * @return void
   */
  public function compose(View $view)
  {
    $items = include app_path('Http/Menus/main.php');

    $menu = new Menu('main', $items, 'Main Menu');

    $view->with('menu', $menu);
  }
}
```

```blade
// resources/views/layouts/app.blade.php
// ...
<div class="sidebar">
  @include('menuer::bulma.menu.menu', compact('menu'))
</div>
<div class="main">
  // main content
</div>
// ...
```

## Casting a menu to JSON

Menus support casting to JSON. This can be useful when working with JavaScript libraries like Vue.js.

First, create a menu:

```php
$items = [
  [
    'label' => 'Home',
    'url' => url('/'),
    'active' => request()->is('/'),
  ],
  [
    'label' => 'About',
    'url' => route('pages.about'),
    'active' => Route::is('about*'),
  ]
];

$menu = new \Jevets\Menuer\Menu('my-menu', $items);

$menu->toJson();
json_encode($menu);
```

## TODO

- Make `Menu` and `MenuItem` Arrayable
- Create views for
  - Bulma
    - Navbar
    - Tabs
  - Bootstrap4 (only a few examples)
