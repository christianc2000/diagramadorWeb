<?php

namespace Database\Seeders;

use App\Models\Pizarra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizarraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // { "class": "go.GraphLinksModel",
        //     "nodeDataArray": [
        //   {"key":"Fred", "text":"Fred: Patron", "isGroup":true, "loc":"0 0", "duration":9},
        //   {"key":"Bob", "text":"Bob: Waiter", "isGroup":true, "loc":"100 0", "duration":9},
        //   {"key":"Hank", "text":"Hank: Cook", "isGroup":true, "loc":"200 0", "duration":9},
        //   {"key":"Renee", "text":"Renee: Cashier", "isGroup":true, "loc":"300 0", "duration":9},
        //   {"group":"Bob", "start":1, "duration":2},
        //   {"group":"Hank", "start":2, "duration":3},
        //   {"group":"Fred", "start":3, "duration":1},
        //   {"group":"Bob", "start":5, "duration":1},
        //   {"group":"Fred", "start":6, "duration":2},
        //   {"group":"Renee", "start":8, "duration":1}
        //    ],
        //     "linkDataArray": [
        //   {"from":"Fred", "to":"Bob", "text":"order", "time":1},
        //   {"from":"Bob", "to":"Hank", "text":"order food", "time":2},
        //   {"from":"Bob", "to":"Fred", "text":"serve drinks", "time":3},
        //   {"from":"Hank", "to":"Bob", "text":"finish cooking", "time":5},
        //   {"from":"Bob", "to":"Fred", "text":"serve food", "time":6},
        //   {"from":"Fred", "to":"Renee", "text":"pay", "time":8}
        //    ]}
        $pizarra1 = Pizarra::create([
            'diagrama' => json_encode([
                "class" => "go.GraphLinksModel",
                "nodeDataArray" => [
                    ["key" => "Fred", "text" => "Fred: Patron", "isGroup" => true, "loc" => "0 0", "duration" => 9],
                    ["key" => "Bob", "text" => "Bob: Waiter", "isGroup" => true, "loc" => "100 0", "duration" => 9],
                    ["key" => "Hank", "text" => "Hank: Cook", "isGroup" => true, "loc" => "200 0", "duration" => 9],
                    ["key" => "Renee", "text" => "Renee: Cashier", "isGroup" => true, "loc" => "300 0", "duration" => 9],
                    ["group" => "Bob", "start" => 1, "duration" => 2],
                    ["group" => "Hank", "start" => 2, "duration" => 3],
                    ["group" => "Fred", "start" => 3, "duration" => 1],
                    ["group" => "Bob", "start" => 5, "duration" => 1],
                    ["group" => "Fred", "start" => 6, "duration" => 2],
                    ["group" => "Renee", "start" => 8, "duration" => 1]
                ],
                "linkDataArray" => [
                    ["from" => "Fred", "to" => "Bob", "text" => "order", "time" => 1],
                    ["from" => "Bob", "to" => "Hank", "text" => "order food", "time" => 2],
                    ["from" => "Bob", "to" => "Fred", "text" => "serve drinks", "time" => 3],
                    ["from" => "Hank", "to" => "Bob", "text" => "finish cooking", "time" => 5],
                    ["from" => "Bob", "to" => "Fred", "text" => "serve food", "time" => 6],
                    ["from" => "Fred", "to" => "Renee", "text" => "pay", "time" => 8]
                ]
            ]),
            'fecha_guardado' => '2024-01-17 14:34',
            'sesion_id' => 1
        ]);
        
              
    }
}
