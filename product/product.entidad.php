<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product
{
	private $product_id;
	private $prod_name;
	private $prod_description;
        private $prod_size;
        private $prod_price;
        private $prod_offerPrice;
        private $prod_stock;
        private $prod_imgName;
        private $prod_category_id;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}