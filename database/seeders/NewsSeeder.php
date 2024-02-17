<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::factory()->count(25)->create()->each(function ($news) {
            $news->categories()->attach(Category::all()->random(rand(1, 3)));
        });
    }
}
