<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\product;

class DatabaseSeeder extends Seeder
{

    public function run()
    {


        $categories =  [
            ['id' => 1, 'name' => 'كاميرات', 'description' => 'كاميرات إلكترونية', 'imagepath' => 'assets/img/Cameras.jpg'],
            ['id' => 2,'name' => 'مأكولات', 'description' => 'مأكولات مصرية', 'imagepath' => 'assets/img/food.jpg'],
            ['id' => 3, 'name' => 'إلكترونيات', 'description' => 'إلكترونيات حديثة', 'imagepath' => 'assets/img/electronics.jpg'],
            ['id' => 4,'name' => 'ملابس', 'description' => '', 'imagepath' => 'assets/img/clothes.jpg'],
            ['id' => 5,'name' => 'شنط', 'description' => '', 'imagepath' => 'assets/img/bags.jpg'],
            ['id' => 6,'name' => 'ساعات', 'description' => '', 'imagepath' => 'assets/img/watches.jpg'],

        ];


        DB::table('categories')->insertOrIgnore($categories);




        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'description' => 'Description for Product ' . $i,
                'price' => rand(10,100),
                'quantity' => rand(1,50),
                'imagepath' => '',
                'category_id' => rand(1,6),

            ]);
        }
    }
}







