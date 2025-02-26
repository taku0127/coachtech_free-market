<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();
        $users = User::all();
        $seeder_images = ['Armani+Mens+Clock.jpg','HDD+Hard+Disk.jpg','iLoveIMG+d.jpg','Leather+Shoes+Product+Photo.jpg','Living+Room+Laptop.jpg','Music+Mic+4632231.jpg','Purse+fashion+pocket.jpg','Tumbler+souvenir.jpg','Waitress+with+Coffee+Grinder.jpg','外出メイクアップセット.jpg'];

        foreach ($seeder_images as $seeder_image){
            $source_path = public_path('img/seeder/'.$seeder_image);
            $storage_path = storage_path('app/public/products/'.$seeder_image);
            // ディレクトリがない場合は作成
            if (!File::exists(dirname($storage_path))) {
                File::makeDirectory(dirname($storage_path), 0755, true, true);
            }
            if(!file_exists($storage_path)){
                File::copy($source_path, $storage_path);
            }
        }

        DB::table('products')->insert([
            [
                'name' => '腕時計',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[0],
                'price' => '15000',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'HDD',
                'description' => '高速で信頼性の高いハードディスク',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[1],
                'price' => '5000',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '玉ねぎ3束',
                'description' => '新鮮な玉ねぎ3束のセット',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[2],
                'price' => '300',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '革靴',
                'description' => 'クラシックなデザインの革靴',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[3],
                'price' => '4000',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ノートPC',
                'description' => '高性能なノートパソコン',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[4],
                'price' => '45000',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'マイク',
                'description' => '高音質のレコーディング用マイク',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[5],
                'price' => '8000',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'ショルダーバッグ',
                'description' => 'おしゃれなショルダーバッグ',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[6],
                'price' => '3500',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'タンブラー',
                'description' => '使いやすいタンブラー',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[7],
                'price' => '500',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'コーヒーミル',
                'description' => '手動のコーヒーミル',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[8],
                'price' => '4000',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'メイクセット',
                'description' => '便利なメイクアップセット',
                'brand' => $faker->randomElement(['ブランド1','ブランド2','ブランド3']),
                'image' => $seeder_images[9],
                'price' => '2500',
                'is_sold' => false,
                'user_id' => $users->random()->id,
                'status_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
