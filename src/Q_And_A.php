<?php

namespace Xdli\Q_And_A;

use Encore\Admin\Extension;

class Q_And_A extends Extension
{
    public $name = 'q_and_a';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Q_And_A',
        'path'  => 'q_and_a',
        'icon'  => 'fa-gears',
    ];
}