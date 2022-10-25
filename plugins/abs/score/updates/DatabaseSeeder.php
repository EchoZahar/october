<?php

namespace Abs\Score\Updates;

use Seeder;
 
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SeedCategoriesTable::class);
    }
}