<?php

namespace App;

use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Menu
{
    public static $menu_collection;
    public static $menu_file = 'menu.yaml';

    protected $attributes;

    public static function all()
    {
        if (empty(self::$menu_collection)) {
            self::$menu_collection = self::make(self::$menu_file);
        }

        return self::$menu_collection;
    }

    public static function make($file)
    {
        return self::mapInto(self::readFile($file));
    }

    public static function readFile($file)
    {
        return Yaml::parseFile(base_path($file));
    }

    public static function mapInto(array $items)
    {
        return collect($items)->filter(function ($item, $key) {
            if (!array_has($item, 'permissions')) {
                return true;
            }

            return self::isUserCanAccessMenu($item);
        })->mapInto(self::class);
    }

    public static function isUserCanAccessMenu($menu)
    {
        $user = Auth::user();

        foreach (array_get($menu, 'permissions') as $permission) {
            if ($user->can($permission)) {
                return true;
            }
        }

        return false;
    }

    public function __construct($attributes)
    {
        $this->attributes = Collection::wrap($attributes);

        if ($this->has('childs')) {
            $this->put('childs', self::mapInto($this->childs));
        }
    }

    public function __get($attribute)
    {
        return call_user_func([$this, $attribute]);
    }

    public function __call(string $name, array $arguments = null)
    {
        return $this->attributes->get($name, '');
    }

    public function isDropdown()
    {
        return $this->has('childs');
    }

    public function has($key)
    {
        return $this->attributes->has($key);
    }

    public function put(...$args)
    {
        return $this->attributes->put(...$args);
    }

    public function liClass()
    {
        return $this->isDropdown() ? 'nav-dropdown' : '';
    }

    public function class()
    {
        $class = $this->attributes->get('class');

        if ($this->isDropdown()) {
            $class .= ' nav-dropdown-toggle';
        }

        return $class;
    }

    public function icon()
    {
        return $this->attributes->get('icon', 'icon-plus');
    }

    public function link()
    {
        return $this->attributes->get('link', '#');
    }
}
