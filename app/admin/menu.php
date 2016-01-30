<?php

/*
 * Describe your menu here.
 *
 * There is some simple examples what you can use:
 *
 * 		Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard')->uses('\AdminController@getIndex');
 * 		Admin::menu(User::class)->icon('fa-user');
 * 		Admin::menu()->label('Menu with subitems')->icon('fa-book')->items(function ()
 * 		{
 * 			Admin::menu(\Foo\Bar::class)->icon('fa-sitemap');
 * 			Admin::menu('\Foo\Baz')->label('Overwrite model title');
 * 			Admin::menu()->url('my-page')->label('My custom page')->uses('\MyController@getMyPage');
 * 		});
 */

Admin::menu(\republic\Place::class)->label('Места')->icon('fa-bank');
Admin::menu()->url('category/')->label('Категории')->icon('fa-list')->items(function()
{
    Admin::menu()->url('add/category/')->label('Добавить')->icon('fa-list')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
    Admin::menu()->url('rewrite/category/')->label('Изменить')->icon('fa-pencil-square-o')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
    Admin::menu()->url('delete/category/')->label('Удалить')->icon('fa-times')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
});;
Admin::menu()->url('person/')->label('Пользователи')->icon('fa-user')->items(function()
{
    Admin::menu()->url('add/person/')->label('Добавить')->icon('fa-user')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
    Admin::menu()->url('rewrite/person/')->label('Изменить')->icon('fa-pencil-square-o')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
    Admin::menu()->url('delete/person/')->label('Удалить')->icon('fa-times')->uses('\SleepingOwl\Admin\Controllers\DummyController@getIndex');
});;