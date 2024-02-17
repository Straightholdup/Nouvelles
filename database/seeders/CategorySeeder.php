<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private function seedRecursive(int $levels)
    {
        $categories = Category::factory()
            ->count(rand($levels, $levels + 3))
            ->create();

        if ($levels == 1) return $categories;

        $categories->each(function ($category) use ($levels) {
            $subcategories = $this->seedRecursive($levels - 1);
            foreach ($subcategories as $subcategory) {
                $subcategory->parent()->associate($category)->save();
            }
        });
        return $categories;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedRecursive(3);
    }
}
