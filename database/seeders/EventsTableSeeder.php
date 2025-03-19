<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to prevent issues
        Schema::disableForeignKeyConstraints();
        DB::table('events')->truncate(); // Clears the table
        Schema::enableForeignKeyConstraints();

        // Insert events
        DB::table('events')->insert([
            [
                'event_id' => 1,
                'title' => 'Start of Online Registration',
                'description' => 'Start of Online Registration',
                'start_date' => '2025-03-17',
                'end_date' => '2025-05-22',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-06 04:49:30'),
                'updated_at' => Carbon::parse('2025-03-17 05:34:43')
            ],
            [
                'event_id' => 6,
                'title' => 'Start of Filing Candidacy',
                'description' => 'Filing of Candidacy',
                'start_date' => '2025-04-01',
                'end_date' => '2025-05-17',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:04:01'),
                'updated_at' => Carbon::parse('2025-03-17 05:35:03')
            ],
            [
                'event_id' => 7,
                'title' => 'End of Filing of Candidacy',
                'description' => 'End of Filing of Candidacy',
                'start_date' => '2025-05-17',
                'end_date' => '2025-05-17',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:06:17'),
                'updated_at' => Carbon::parse('2025-03-17 05:38:34')
            ],
            [
                'event_id' => 8,
                'title' => 'SECTORAL CONGRESS 55th CO-OP LEADERS',
                'description' => 'SECTORAL CONGRESS (Managers, Gender, Youth) 55th CO-OP LEADERS',
                'start_date' => '2025-05-23',
                'end_date' => '2025-05-23',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:08:01'),
                'updated_at' => Carbon::parse('2025-03-17 05:54:21')
            ],
            [
                'event_id' => 9,
                'title' => '55th  CO-OP LEADERS',
                'description' => 'A gathering of cooperative leaders...',
                'start_date' => '2025-05-24',
                'end_date' => '2025-05-24',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:09:21'),
                'updated_at' => Carbon::parse('2025-03-17 05:09:21')
            ],
            [
                'event_id' => 10,
                'title' => '51st General Assembly',
                'description' => 'A gathering of cooperative members...',
                'start_date' => '2025-05-25',
                'end_date' => '2025-05-25',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:25:56'),
                'updated_at' => Carbon::parse('2025-03-17 05:25:56')
            ],
            [
                'event_id' => 11,
                'title' => 'Ceremonial Opening of Election',
                'description' => 'Ceremonial Opening of Election',
                'start_date' => '2025-05-21',
                'end_date' => '2025-05-21',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:39:38'),
                'updated_at' => Carbon::parse('2025-03-17 05:39:38')
            ],
            [
                'event_id' => 12,
                'title' => 'End of Reg for Non-Voting',
                'description' => 'End of Reg for Non-Voting',
                'start_date' => '2025-05-22',
                'end_date' => '2025-05-22',
                'location' => 'Cagayan De Oro City',
                'created_at' => Carbon::parse('2025-03-17 05:40:25'),
                'updated_at' => Carbon::parse('2025-03-17 05:40:25')
            ]
        ]);
    }
}
