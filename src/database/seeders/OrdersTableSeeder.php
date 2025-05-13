<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user1 = User::find(1);
        $product1 = Product::find(6);
        $user2 = User::find(2);
        $product2 = Product::find(1);
        DB::table('orders')->insert([
            [
                'user_id' => $user1->id,
                'product_id' => $product1->id,
                'postcode' => $user1->postcode,
                'address' => $user1->address,
                'building' => $user1->building,
                'payment_method_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => $user2->id,
                'product_id' => $product2->id,
                'postcode' => $user2->postcode,
                'address' => $user2->address,
                'building' => $user2->building,
                'payment_method_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
        $product1->is_sold = true;
        $product1->save();
        $product2->is_sold = true;
        $product2->save();
    }
}
