<?php

use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shows = [[
            'id' => 1,
            'uid' => 'ateam',
            'name' => 'A-Team',
            'description' => 'If you can find them...',
            'logo' => 'http://placekitten.com/200/500'
        ],[
            'id' => 2,
            'uid' => 'blind_date',
            'name' => 'Blind Date',
            'description' => 'Watch over suspiciously single contestants fight it out to win a date with the bottom of the barrel.',
            'logo' => 'http://placekitten.com/250/200'
        ],[
            'id' => 3,
            'uid' => 'mrmen',
            'name' => 'Mr Men',
            'description' => 'Visit a world of odd people, that we\'re not allowed to all odd any more, simply: socially alternative people',
            'logo' => 'http://placekitten.com/250/525'
        ],[
            'id' => 4,
            'uid' => 'automan',
            'name' => 'Automan',
            'description' => '80s cop drama featuring a digital man',
            'logo' => 'http://placekitten.com/225/400'
        ],[
            'id' => 5,
            'uid' => 'got',
            'name' => 'Game of Thrones',
            'description' => 'Can\'t decide between wathing porn, or a fantasy adventure? Look no further',
            'logo' => 'http://placekitten.com/300/200'
        ],[
            'id' => 6,
            'uid' => 'playhouse',
            'name' => 'Play House',
            'description' => 'Hi kids! Welcome to the most fun place since the dentist!',
            'logo' => 'http://placekitten.com/305/205'
        ],[
            'id' => 7,
            'uid' => 'happy_days',
            'name' => 'Happy Days',
            'description' => '80s show, set in the 50s. Racism, sexism and domestic abuse. What a laugh!',
            'logo' => 'http://placekitten.com/315/215'
        ],[
            'id' => 8,
            'uid' => 'goodnight',
            'name' => 'Goodnight Sweetheatt',
            'description' => 'Mild mannered Gary discovers a portal from 1992 to 1940.. and doesn\'t stop the war. Cheers mate.',
            'logo' => 'http://placekitten.com/295/215'
        ]];

        foreach ($shows as $show) {
            DB::table('shows')->insert($show);
        }
    }
}
