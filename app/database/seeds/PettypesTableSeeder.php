<?php

class PettypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pettypes')->delete();


        $pettypes = array(
            array(
                'pettype'      => 'Dogs',
                'status'   => 1
            ),
            array(
                'pettype'      => 'Cats',
                'status'   => 1
            ),
            array(
                'pettype'      => 'Rabbits',
                'status'   => 1
            ),
            array(
                'pettype'      => 'Tortoises',
                'status'   => 1
            ),
            array(
                'pettype'      => 'Pet Snakes',
                'status'   => 1
            )
        );

        DB::table('pettypes')->insert( $pettypes );
    }

}
