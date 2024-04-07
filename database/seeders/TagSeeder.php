<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tags=[
            ["name"=>"Design"],
            ["name"=>"Development"],
            ["name"=>"Marketing"],
            ["name"=>"SEO"],
            ["name"=>"Writing"],
            ["name"=>"Consulting"],
        ];
        Tag::insert($tags);
    }
}
