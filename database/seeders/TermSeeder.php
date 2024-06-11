<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;
use Carbon\Carbon;

class TermSeeder extends Seeder
{
    public function run()
    {
        $terms = [
            [
                "period" => '1/21',
                "beginning" => Carbon::create(2021, 1, 1)->toDateString(),
                "end" => Carbon::create(2021, 6, 30)->toDateString()
            ],
            [
                "period" => '2/21',
                "beginning" => Carbon::create(2021, 7, 1)->toDateString(),
                "end" => Carbon::create(2021, 12, 31)->toDateString()
            ],
            [
                "period" => '1/22',
                "beginning" => Carbon::create(2022, 1, 1)->toDateString(),
                "end" => Carbon::create(2022, 6, 30)->toDateString()
            ],
            [
                "period" => '2/22',
                "beginning" => Carbon::create(2022, 7, 1)->toDateString(),
                "end" => Carbon::create(2022, 12, 31)->toDateString()
            ],
            [
                "period" => '1/23',
                "beginning" => Carbon::create(2023, 1, 1)->toDateString(),
                "end" => Carbon::create(2023, 6, 30)->toDateString()
            ],
            [
                "period" => '2/23',
                "beginning" => Carbon::create(2023, 7, 1)->toDateString(),
                "end" => Carbon::create(2023, 12, 31)->toDateString()
            ],
            [
                "period" => '1/24',
                "beginning" => Carbon::create(2024, 1, 1)->toDateString(),
                "end" => Carbon::create(2024, 6, 30)->toDateString()
            ],
            [
                "period" => '2/24',
                "beginning" => Carbon::create(2024, 7, 1)->toDateString(),
                "end" => Carbon::create(2024, 12, 31)->toDateString()
            ],
            [
                "period" => '1/25',
                "beginning" => Carbon::create(2025, 1, 1)->toDateString(),
                "end" => Carbon::create(2025, 6, 30)->toDateString()
            ],
            [
                "period" => '2/25',
                "beginning" => Carbon::create(2025, 7, 1)->toDateString(),
                "end" => Carbon::create(2025, 12, 31)->toDateString()
            ],
            [
                "period" => '1/26',
                "beginning" => Carbon::create(2026, 1, 1)->toDateString(),
                "end" => Carbon::create(2026, 6, 30)->toDateString()
            ],
            [
                "period" => '2/26',
                "beginning" => Carbon::create(2026, 7, 1)->toDateString(),
                "end" => Carbon::create(2026, 12, 31)->toDateString()
            ],
            [
                "period" => '1/27',
                "beginning" => Carbon::create(2027, 1, 1)->toDateString(),
                "end" => Carbon::create(2027, 6, 30)->toDateString()
            ],
            [
                "period" => '2/27',
                "beginning" => Carbon::create(2027, 7, 1)->toDateString(),
                "end" => Carbon::create(2027, 12, 31)->toDateString()
            ],
            [
                "period" => '1/28',
                "beginning" => Carbon::create(2028, 1, 1)->toDateString(),
                "end" => Carbon::create(2028, 6, 30)->toDateString()
            ],
            [
                "period" => '2/28',
                "beginning" => Carbon::create(2028, 7, 1)->toDateString(),
                "end" => Carbon::create(2028, 12, 31)->toDateString()
            ],
        ];

        foreach ($terms as $term) {
            Term::create($term);
        }
    }
}
