<?php

namespace App\Models;

class OwlixApi {
    private $base_url;

    public function __construct(){
        $this->base_url = "https://production.owlix-id.com/api/admin/";
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
}
