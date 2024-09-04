<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($orderId, $grossAmount)
    {

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => 'Budi',
                'last_name' => 'Pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ],
            'item_details' => [
                [
                    'id' => 'item1',
                    'price' => 100000,
                    'quantity' => 1,
                    'name' => 'Item Dummy 1'
                ],
                [
                    'id' => 'item2',
                    'price' => 200000,
                    'quantity' => 1,
                    'name' => 'Item Dummy 2'
                ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
