<?php

namespace App\Services;

use App\Services\ApiClient;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Stock;

class ImportService
{
    public function __construct(
        private ApiClient $client
    ) {}

    public function import(
        ?string $from,
        ?string $to,
        int $page = 1,
        int $limit = 500
    ) : void
    {
        $endpoints = config('api.endpoints');

        foreach ($endpoints as $endpoint)
        {

        $params = [
            'page'  => $page,
            'limit' => $limit,
        ];

        if ($endpoint === '/api/stocks') {
            $today = today()->toDateString();

            $params['dateFrom'] = $today;
            $params['dateTo']   = $today;
        } else {
            $params['dateFrom'] = $from;
            $params['dateTo']   = $to;
        }

        $response = $this->client->get($endpoint, $params);

        $data = $response['data']; //

        //dd($response);//dd(($data['links']['last'][-1]));

        switch ($endpoint){
            case '/api/sales':
                foreach ($data as $row) {

                 Sale::updateOrCreate(
                    [
                        'g_number'          => $row['g_number'],
                        'date'              => $row['date'],
                        'last_change_date'  => $row['last_change_date'],

                        'supplier_article'=> $row['supplier_article'],
                        'tech_size' => $row['tech_size'],

                        'barcode'=> $row['barcode'],

                        'total_price' => $row['total_price'],
                        'discount_percent' => $row['discount_percent'],

                        'is_supply' => $row['is_supply'],
                        'is_realization' => $row['is_realization'],

                        'promo_code_discount'=> $row['promo_code_discount'],

                        'warehouse_name'=> $row['warehouse_name'],
                        'country_name' => $row['country_name'],
                        'oblast_okrug_name' => $row['oblast_okrug_name'],
                        'region_name' => $row['region_name'],

                        'income_id'=> $row['income_id'],

                        'sale_id' => $row['sale_id'],
                        'odid' => $row['odid'],

                        'spp' => $row['spp'],

                        'for_pay' => $row['for_pay'],
                        'finished_price' => $row['finished_price'],
                        'price_with_disc' => $row['price_with_disc'],

                        'nm_id' => $row['nm_id'],

                        'subject' => $row['subject'],
                        'category' => $row['category'],
                        'brand' => $row['brand'],
                        'imported_at' => now(),
                        'is_storno' => $row['is_storno'],

                    ]
                );
                }
                break;
            case '/api/orders':
                foreach ($data as $row) {
                    Order::updateOrCreate(
                        [
                        'g_number'          => $row['g_number'],
                        'date'              => $row['date'],
                        'last_change_date'  => $row['last_change_date'],
                        'supplier_article'=> $row['supplier_article'],
                        'tech_size' => $row['tech_size'],
                        'barcode'=> $row['barcode'],
                        'total_price' => $row['total_price'],
                        'discount_percent' => $row['discount_percent'],
                        'warehouse_name'=> $row['warehouse_name'],
                        'oblast' => $row['oblast'],
                        'income_id'=> $row['income_id'],
                        'odid' => $row['odid'],
                        'nm_id' => $row['nm_id'],
                        'subject' => $row['subject'],
                        'category' => $row['category'],
                        'brand' => $row['brand'],
                        'is_cancel' => $row['is_cancel'],
                        'cancel_dt' => $row['cancel_dt'],
                        'imported_at' => now(),
                        ]
                        );
                }
                break;
            case '/api/stocks':
                foreach ($data as $row) {
                    Stock::updateOrCreate(
                        [
                        'date'              => $row['date'],
                        'last_change_date'  => $row['last_change_date'],
                        'supplier_article'=> $row['supplier_article'],
                        'tech_size' => $row['tech_size'],
                        'barcode'=> $row['barcode'],
                        'quantity' =>$row['quantity'],
                        'is_supply' => $row['is_supply'],
                        'is_realization' => $row['is_realization'],
                        'quantity_full' =>$row['quantity_full'],
                        'warehouse_name'=> $row['warehouse_name'],
                        'in_way_to_client' =>$row['in_way_to_client'],
                        'in_way_from_client' =>$row['in_way_from_client'],
                        'nm_id' => $row['nm_id'],
                        'subject' => $row['subject'],
                        'category' => $row['category'],
                        'brand' => $row['brand'],
                        'sc_code' =>$row['sc_code'],
                        'price' => $row['price'],
                        'discount' => $row['discount'],
                        'imported_at' => now(),
                        ]
                    );
                    }
                    break;
        }
      }
    }
}
