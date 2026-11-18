<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about-project', function () {
    $this->comment('SimplePOS Laravel four-page activity project.');
})->purpose('Display a short description of this project');
