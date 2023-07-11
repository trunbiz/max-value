<?php

namespace Database\Seeders;

use App\Models\TypeCategory;
use Illuminate\Database\Seeder;

class CreateTypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TypeCategory::firstOrCreate([
            'id' => '13',
            "name" => "Arts &amp; Entertainment",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '33',
            "name" => "Automotive",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '34',
            "name" => "Business",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '35',
            "name" => "Careers",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '36',
            "name" => "Education",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '37',
            "name" => "Family &amp; Parenting",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '39',
            "name" => "Food &amp; Drink",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '28',
            "name" => "Health &amp; fitness",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '10',
            "name" => "Hobbies &amp; Interests",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '41',
            "name" => "Home &amp; Garden",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '42',
            "name" => "Law, Government, &amp; Politics",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '11',
            "name" => "News &amp; Media",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '7',
            "name" => "Personal Finance",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '47',
            "name" => "Pets",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '52',
            "name" => "Real Estate",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '46',
            "name" => "Science",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '23',
            "name" => "Shopping",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '8',
            "name" => "Society",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '5',
            "name" => "Sports",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '49',
            "name" => "Style &amp; Fashion",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '6',
            "name" => "Technology &amp; Computing",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '51',
            "name" => "Travel",
        ]);

        TypeCategory::firstOrCreate([
            'id' => '31',
            "name" => "Uncategorized",
        ]);

    }
}
