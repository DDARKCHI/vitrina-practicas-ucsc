<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $projects = collect(config('vitrina.projects'))->map(function (array $project): array {
        $url = $project['url'] ?? null;

        $project['url'] = is_string($url)
            && filter_var($url, FILTER_VALIDATE_URL)
            && in_array(strtolower(parse_url($url, PHP_URL_SCHEME)), ['http', 'https'], true)
                ? $url
                : null;

        return $project;
    });

    return view('vitrina', ['projects' => $projects]);
})->name('portada');
