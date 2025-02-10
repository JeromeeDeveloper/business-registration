<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Tech Conference 2024',
                'description' => 'An annual conference for tech enthusiasts and professionals.',
                'start_date' => '2024-06-15',
                'end_date' => '2024-06-17',
                'location' => 'Manila Convention Center',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Business Innovation Summit',
                'description' => 'A gathering of entrepreneurs and industry leaders to discuss business innovations.',
                'start_date' => '2024-08-20',
                'end_date' => '2024-08-22',
                'location' => 'Cebu Business Park',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Healthcare and AI Conference',
                'description' => 'Exploring the intersection of artificial intelligence and healthcare.',
                'start_date' => '2024-09-10',
                'end_date' => '2024-09-12',
                'location' => 'Davao Medical Center',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Green Energy Expo',
                'description' => 'A showcase of the latest advancements in renewable energy solutions.',
                'start_date' => '2024-07-05',
                'end_date' => '2024-07-07',
                'location' => 'Laguna Eco Park',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Startup Pitch Night',
                'description' => 'An event where startups pitch their ideas to investors and mentors.',
                'start_date' => '2024-11-18',
                'end_date' => '2024-11-18',
                'location' => 'Quezon City Innovation Hub',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
