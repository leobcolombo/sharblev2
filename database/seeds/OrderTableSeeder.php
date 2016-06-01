<?php

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Order::class, 10)->create()->each(function($order){
            for($i=0; $i<2;$i++){
                $order->items()->save(factory(OrderItem::class)->make(
                    [
                        'product_id' => rand(1,50),
                        'qtd' => rand(1,5),
                        'price' => rand(5,100)
                    ]
                ));
            }
        });
    }
}
