<?php

test('globals dd')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();

test('globals controllers')
    ->expect('request')
    ->not->toBeUsedIn('App\Http\Controllers');

test('app traits')
    ->expect('App\Traits')
    ->toBeTraits();
