<?php

use App\Models\Item;

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 20) as $range) {
            Item::create([
                'name' => 'Item ' . $range,
                'description' => 'Item description ' . $range,
                'price' => $range * 100
            ]);
        }
    }
}
