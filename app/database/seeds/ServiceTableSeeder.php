<?php

class ServiceTableSeeder extends Seeder {

    public function run()
    {
        DB::table('services')->delete();

        $services = array(
            array(
                'serviceName'      => 'Washing',
                'status'   => 1,
                'updated_at' => new DateTime,
                'created_at' => new DateTime
            ),
            array(
                'serviceName'      => 'Shampooing',
                'status'   => 1,
                'updated_at' => new DateTime,
                'created_at' => new DateTime
            ),
            array(
                'serviceName'      => 'Pedicure',
                'status'   => 1,
                'updated_at' => new DateTime,
                'created_at' => new DateTime
            ),
            array(
                'serviceName'      => 'Manisure',
                'status'   => 1,
                'updated_at' => new DateTime,
                'created_at' => new DateTime
            ),
            array(
                'serviceName'      => 'Polishing',
                'status'   => 1,
                'updated_at' => new DateTime,
                'created_at' => new DateTime
            )
        );

        DB::table('services')->insert( $services );
    }

}
