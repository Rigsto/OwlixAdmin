<?php

namespace App\Models;

class OwlixApi {
    private $base_url;
    private $url;

    public function __construct(){
        $this->base_url = "https://production.owlix-id.com/api/admin/";
        $this->url = "https://production.owlix-id.com/api/";
    }

    //--------------------------------------------------------------------------
    //authentication
    function login(){
        return $this->base_url."login";
    }

    function register(){
        return $this->base_url."register";
    }

    function detail(){
        return $this->base_url."detail";
    }

    function logout(){
        return $this->base_url."logout";
    }

    //--------------------------------------------------------------------------
    //partner category
    function createPartnerCategory(){
        return $this->base_url."create_partner_category";
    }

    function readPartnerCategories(){
        return $this->base_url."read_partner_categories";
    }

    function deletePartnerCategories(){
        return $this->base_url."delete_partner_category";
    }

    //--------------------------------------------------------------------------
    //itemcategory
    function createItemCategory(){
        return $this->base_url."create_item_category";
    }

    function readItemCategories(){
        return $this->base_url."read_item_categories";
    }

    function deleteItemCategory(){
        return $this->base_url."delete_item_category";
    }

    //--------------------------------------------------------------------------
    //xendit
    function getBalance(){
        return $this->base_url."get_balance";
    }

    //--------------------------------------------------------------------------
    //location
    function addProvince(){
        return $this->base_url."add_province";
    }

    function addCity(){
        return $this->base_url."add_city";
    }

    //--------------------------------------------------------------------------
    //order
    function getAllOrder(){
        return $this->base_url."admin_get_all_order";
    }

    function getOrderDetail(){
        return $this->base_url."admin_get_order_detail";
    }

    //--------------------------------------------------------------------------
    //user
    function getAllUser(){
        return $this->base_url."get_all_user_per_zone";
    }

    //--------------------------------------------------------------------------
    //orphanage
    function createOrphanage(){
        return $this->base_url."create_orphanage";
    }

    function readOrphanages(){
        return $this->base_url."read_orphanage";
    }

    function updateOrphanage(){
        return $this->base_url."update_orphanage";
    }

    function deleteOrphanage(){
        return $this->base_url."delete_orphanage";
    }

    //--------------------------------------------------------------------------
    //push notif
    function readAllPushNotif(){
        return $this->base_url."read_push_notification";
    }

    //--------------------------------------------------------------------------
    //voucher
    function createVoucher(){
        return $this->base_url."create_voucher";
    }

    function readVouchers(){
        return $this->base_url."read_voucher";
    }

    function updateVoucher(){
        return $this->base_url."update_voucher";
    }

    function deleteVoucher(){
        return $this->base_url."delete_voucher";
    }

    function readSingleVoucher(){
        return $this->base_url."read_single_voucher";
    }

    //--------------------------------------------------------------------------
    //mading category
    function createMadingCategory(){
        return $this->base_url."create_mading_category";
    }

    function readMadingCategory(){
        return $this->base_url."read_mading_category";
    }

    //--------------------------------------------------------------------------
    //mading
    function createMading(){
        return $this->base_url."create_mading";
    }

    function readMading(){
        return $this->base_url."read_mading";
    }

    function updateMading(){
        return $this->base_url."update_mading";
    }

    function deleteMading(){
        return $this->base_url."delete_mading";
    }

    //--------------------------------------------------------------------------
    //province and cities
    function readProvince(){
        return $this->url."read_province";
    }

    function readCity(){
        return $this->url."read_city";
    }

    //--------------------------------------------------------------------------
    //donasi
    function readDonation(){
        return $this->base_url."read_donation";
    }
}
