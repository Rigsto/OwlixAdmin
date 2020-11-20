<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getAllOrder(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getAllOrder(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.finance.order.index', [
            'orders' => $content['data'] ?? []
        ]);
    }

    public function getOrder($id){
//        $client = new Client();
//        $response = $client->get((new OwlixApi())->getOrderDetail(), [
//            'headers' => [
//                'Authorization' => 'Bearer '.Auth::user()->token,
//            ],
//            'query' => [
//                'id_order' => $id
//            ]
//        ])->getBody();

        $content = json_decode('{"status":"success","message":"Get order detail","data":{"id":2,"external_id":"INVOICE-20201103-1604375064","amount":86890000,"delivery_expense":16000,"note":null,"status":"REJECTED","receipt_number":null,"id_customer":1,"id_rating":null,"created_at":"2020-11-03T03:44:24.000000Z","updated_at":"2020-11-17T18:01:36.000000Z","customer":{"id":1,"name":"Customer 1","email":"customer1@gmail.com","email_verified_at":null,"province_id":11,"city_id":444,"address":"IV 2 H9\/12","postal_code":"60144","phone_number":"08632682837","date_of_birth":"1998-07-07","on_suspend":"NO","provider":null,"provider_id":null,"remember_token":null,"created_at":"2020-11-03T03:35:01.000000Z","updated_at":"2020-11-03T03:35:01.000000Z"},"order_items":[{"id":6,"quantity":2,"id_order":2,"id_store_item":4,"created_at":"2020-11-03T03:44:24.000000Z","updated_at":"2020-11-03T03:44:24.000000Z","store_item":{"id":4,"name":"IPhone 12 PRO","store_item_price":35600000,"store_item_description":"Produk baru dari apple","id_store":1,"id_partner_item":2,"id_item_category":4,"created_at":"2020-11-03T03:32:05.000000Z","updated_at":"2020-11-03T03:32:05.000000Z","partner_item":{"id":2,"name":"iPhone 12 Pro","weight":170,"description":"Fullset","partner_item_price":26000000,"in_stock":"TRUE","id_partner":2,"id_item_category":4,"created_at":"2020-11-03T02:10:43.000000Z","updated_at":"2020-11-03T02:10:43.000000Z","deleted_at":null,"partner":{"id":2,"name":"Samuel","email":"jersamkris@gmail.com","email_verified_at":null,"image_url":null,"phone_number":"+6285156673385","description":null,"is_verified":"TRUE","province_id":11,"city_id":444,"address":"IV 1 H8\/13","balance":25000000,"on_suspend":"NO","expired_date":"2020-11-02 19:08:56","id_partner_category":1,"created_at":"2020-11-02T19:08:56.000000Z","updated_at":"2020-11-17T04:47:28.000000Z","fcm_token":null}}}},{"id":5,"quantity":1,"id_order":2,"id_store_item":2,"created_at":"2020-11-03T03:44:24.000000Z","updated_at":"2020-11-03T03:44:24.000000Z","store_item":{"id":2,"name":"IPhone 12 mini","store_item_price":15500000,"store_item_description":"New product","id_store":1,"id_partner_item":6,"id_item_category":4,"created_at":"2020-11-03T03:27:47.000000Z","updated_at":"2020-11-03T03:27:47.000000Z","partner_item":{"id":6,"name":"Iphone 12 M","weight":160,"description":"Fullset hape","partner_item_price":15205000,"in_stock":"true","id_partner":1,"id_item_category":4,"created_at":"2020-11-03T03:18:50.000000Z","updated_at":"2020-11-13T04:39:52.000000Z","deleted_at":null,"partner":{"id":1,"name":"Partner 1","email":"partner12@gmail.com","email_verified_at":null,"image_url":"https:\/\/production.owlix-id.com\/partner_files\/partner_images\/1605236064_179ad3ea-1af6-4721-a63f-afb7a5b7cf4e.jpg","phone_number":"+620","description":"ini biodata toko","is_verified":"TRUE","province_id":7,"city_id":88,"address":"IV 1 H8\/13","balance":34750000,"on_suspend":"NO","expired_date":"2020-11-02 19:05:09","id_partner_category":2,"created_at":"2020-11-02T19:05:09.000000Z","updated_at":"2020-11-18T23:48:03.000000Z","fcm_token":null}}}},{"id":4,"quantity":1,"id_order":2,"id_store_item":1,"created_at":"2020-11-03T03:44:24.000000Z","updated_at":"2020-11-03T03:44:24.000000Z","store_item":{"id":1,"name":"Tatakan Buat Tulis","store_item_price":190000,"store_item_description":"Nyaman digunakan","id_store":1,"id_partner_item":5,"id_item_category":3,"created_at":"2020-11-03T03:25:28.000000Z","updated_at":"2020-11-03T03:25:28.000000Z","partner_item":{"id":5,"name":"Papan buat tuliss","weight":250,"description":"Kondisi baru","partner_item_price":175000,"in_stock":"true","id_partner":1,"id_item_category":1,"created_at":"2020-11-03T03:18:04.000000Z","updated_at":"2020-11-13T04:39:50.000000Z","deleted_at":null,"partner":{"id":1,"name":"Partner 1","email":"partner12@gmail.com","email_verified_at":null,"image_url":"https:\/\/production.owlix-id.com\/partner_files\/partner_images\/1605236064_179ad3ea-1af6-4721-a63f-afb7a5b7cf4e.jpg","phone_number":"+620","description":"ini biodata toko","is_verified":"TRUE","province_id":7,"city_id":88,"address":"IV 1 H8\/13","balance":34750000,"on_suspend":"NO","expired_date":"2020-11-02 19:05:09","id_partner_category":2,"created_at":"2020-11-02T19:05:09.000000Z","updated_at":"2020-11-18T23:48:03.000000Z","fcm_token":null}}}}]}}', true);
        return view('admin.finance.order.show', [
            'order' => $content['data']
        ]);
    }
}
