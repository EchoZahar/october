<?php

namespace Abs\Score\Updates;


use Abs\Score\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Seeder;
 
class SeedCategoriesTable extends Seeder
{
    public function run()
    {
        $description = Str::random(300);
        
        // Category::create([
        $issetCategories = Category::select('id')->get();
        if ($issetCategories->count() > 0) {
            return $issetCategories;
        } 

        
        DB::table('abs_score_categories')->insert([
            [
                'name'          => $name = 'category ' . Str::random(10),
                'slug'          => Str::slug($name),
                'is_published'  => 1,
                'description'   => $description,
                'parent_id'     => array_rand($issetCategories->toArray()) ?? NULL,
                'nest_left'	    => 0,
	            'nest_right'	=> 0,
	            'nest_depth'	=> 0,
                'created_at'    => now(),
                'updated_at'    => now(),
            ], [
                'name'          => $name = 'category ' . Str::random(10),
                'slug'          => Str::slug($name),
                'is_published'  => 1,
                'description'   => $description,
                'parent_id'     => array_rand($issetCategories->toArray()) ?? NULL,
                'nest_left'	    => 0,
	            'nest_right'	=> 0,
	            'nest_depth'	=> 0,
                'created_at'    => now(),
                'updated_at'    => now(),
            ], [
                'name'          => $name = 'category ' . Str::random(10),
                'slug'          => Str::slug($name),
                'is_published'  => 1,
                'description'   => $description,
                'parent_id'     => array_rand($issetCategories->toArray()) ?? NULL,
                'nest_left'	    => 0,
	            'nest_right'	=> 0,
	            'nest_depth'	=> 0,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}