<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use republic\Models\Place;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call('PlaceSeeder');

        Model::reguard();
    }
}

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::create([
            'category_id' => 1,
            'place_name'  => 'Запись 1',
            'place_desc'  => 'Внимание: конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.',
            'place_city'  => 1,
            'views'       => 25,
        ]);

        Place::create([
            'category_id' => 1,
            'place_name'  => 'Запись 2',
            'place_desc'  => 'Внимание: конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.',
            'place_city'  => 2,
            'views'       => 15,
        ]);

        Place::create([
            'category_id' => 1,
            'place_name'  => 'Запись 3',
            'place_desc'  => 'Внимание: конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.',
            'place_city'  => 3,
            'views'       => 10,
        ]);

        Place::create([
            'category_id' => 1,
            'place_name'  => 'Запись 4',
            'place_desc'  => 'Внимание: конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.',
            'place_city'  => 4,
            'views'       => 55,
        ]);

        Place::create([
            'category_id' => 2,
            'place_name'  => 'Запись 5',
            'place_desc'  => 'Внимание: конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.',
            'place_city'  => 1,
            'views'       => 25,
        ]);

        Place::create([
            'category_id' => 2,
            'place_name'  => 'Запись 6',
            'place_desc'  => 'Внимание: конструктор запросов Laravel использует привязку параметров к запросам средствами PDO для защиты вашего приложения от SQL-инъекций. Нет необходимости экранировать строки перед их передачей в запрос.',
            'place_city'  => 3,
            'views'       => 25,
        ]);


    }
}

