<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Local News',"World News","Sports","Foods","Travel"];
        $toAdd = [];
        foreach ($categories as $category){
            $toAdd[] = [
                'title' => $category,
                'user_id' => rand(1,11),
                "created_at" => now(),
                "updated_at" => now()
            ];

            Category::insert($toAdd);
        }
    }
}
