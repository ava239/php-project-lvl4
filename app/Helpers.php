<?php

namespace App\Helpers;

use Route;

function navLink(string $route, string $title): string
{
    $isActiveClass = Route::is($route) ? "active" : "";
    return sprintf("<a class=\"nav-link %s\" href=\"%s\">%s</a>", $isActiveClass, route($route), $title);
}
