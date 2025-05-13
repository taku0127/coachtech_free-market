<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private static int $count = 0;
    public function run()
    {
        $faker = \Faker\Factory::create();
        //
        $orders = Order::with('product')->get();
        $datas = [];
        foreach ($orders as $order) {
            $datas = array_merge($datas,[
                [
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'message' => 'テスト'.self::$count++,
                    'image_url' => $faker->randomElement(['HDD+Hard+Disk.jpg','Armani+Mens+Clock.jpg',null]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'order_id' => $order->id,
                    'user_id' => $order->product->user_id,
                    'message' => 'テスト'.self::$count++,
                    'image_url' => $faker->randomElement(['HDD+Hard+Disk.jpg','Armani+Mens+Clock.jpg',null]),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]],
            );
        }
        DB::table('chats')->insert($datas);
    }
}
