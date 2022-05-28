<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!CategoryType::where('id', 1)->exists()) {
            $categoryType = new CategoryType();
            $categoryType->id = 1;
            $categoryType->title = "Grocery";
            $categoryType->slug = Str::slug($categoryType->title);
            $categoryType->save();
        }
        if (!CategoryType::where('id', 2)->exists()) {
            $categoryType = new CategoryType();
            $categoryType->id = 2;
            $categoryType->title = "Beauty, Toys & More";
            $categoryType->slug = Str::slug($categoryType->title);
            $categoryType->save();
        }
        if (!CategoryType::where('id', 3)->exists()) {
            $categoryType = new CategoryType();
            $categoryType->id = 3;
            $categoryType->title = "Fashion";
            $categoryType->slug = Str::slug($categoryType->title);
            $categoryType->save();
        }
        if (!CategoryType::where('id', 4)->exists()) {
            $categoryType = new CategoryType();
            $categoryType->id = 4;
            $categoryType->title = "Electronics";
            $categoryType->slug = Str::slug($categoryType->title);
            $categoryType->save();
        }
        if (!CategoryType::where('id', 51)->exists()) {
            $categoryType = new CategoryType();
            $categoryType->id = 5;
            $categoryType->title = "Sports";
            $categoryType->slug = Str::slug($categoryType->title);
            $categoryType->save();
        }
    }
}
