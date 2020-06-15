<?php

use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // hard coding ID here for the seed test data to 'just work'
        // Typically (and obviously), one never hard codes id index columns

        $channels = [['id' => 1,
                        'uid' => 'chan001',
                        'name' => 'Channel ONE',
                        'description' => 'Channel ONE is a smorgasbord of entertainment and education',
                        'icon' => 'http://placekitten.com/200/300'
                    ],[
                        'id' => 2,
                        'uid' => 'movie_men',
                        'name' => 'Movies for Men',
                        'description' => 'MM is your one stop shop for adrenaline, explosions speed and hard core rides!',
                        'icon' => 'http://placekitten.com/250/250'
                    ],[
                        'id' => 3,
                        'uid' => 'childish',
                        'name' => 'Child O\'clock',
                        'description' => 'Can\'t afford a babysitter? We got you covered!',
                        'icon' => 'http://placekitten.com/200/250'
                    ]];
        foreach ($channels as $channel) {
            DB::table('channels')->insert($channel);
        }

    }
}
