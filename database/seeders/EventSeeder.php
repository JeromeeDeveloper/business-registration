<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'event_id' => 1,
                'title' => 'General Assembly Registration',
                'description' => 'General Assembly Registration',
                'start_date' => '2025-05-22',
                'end_date' => '2025-05-22',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-05 20:49:30'),
                'updated_at' => Carbon::parse('2025-03-18 05:27:03'),
            ],
            [
                'event_id' => 13,
                'title' => 'CEOs/Manager Congress',
                'description' => 'CEOs/Manager Congress',
                'start_date' => '2025-05-23',
                'end_date' => '2025-05-23',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-18 02:11:22'),
                'updated_at' => Carbon::parse('2025-03-18 05:28:09'),
            ],
            [
                'event_id' => 14,
                'title' => 'Gender Congress',
                'description' => 'Gender Congress',
                'start_date' => '2025-05-23',
                'end_date' => '2025-05-23',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-18 02:12:38'),
                'updated_at' => Carbon::parse('2025-03-18 05:28:30'),
            ],
            [
                'event_id' => 15,
                'title' => 'Youth Congress',
                'description' => 'Youth Congress',
                'start_date' => '2025-05-23',
                'end_date' => '2025-05-23',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-18 02:13:37'),
                'updated_at' => Carbon::parse('2025-03-18 05:29:17'),
            ],
            [
                'event_id' => 16,
                'title' => '55th CO-OP LEADERS\' CONGRESS',
                'description' => '55th CO-OP LEADERS\' CONGRESS',
                'start_date' => '2025-05-25',
                'end_date' => '2025-05-25',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-18 05:30:49'),
                'updated_at' => Carbon::parse('2025-03-18 05:30:49'),
            ],
            [
                'event_id' => 17,
                'title' => '51st General Assembly',
                'description' => '51st General Assembly',
                'start_date' => '2025-05-25',
                'end_date' => '2025-05-25',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-18 05:32:42'),
                'updated_at' => Carbon::parse('2025-03-18 05:32:42'),
            ],
            [
                'event_id' => 18,
                'title' => 'Education Committee Forum',
                'description' => 'Education Committee Forum',
                'start_date' => '2025-05-23',
                'end_date' => '2025-05-23',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-18 05:33:20'),
                'updated_at' => Carbon::parse('2025-03-18 05:33:20'),
            ],
        ]);
    }
}
