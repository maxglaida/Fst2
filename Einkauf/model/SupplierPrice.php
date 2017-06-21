<?php

class SupplierPrice {

    private $name;
    private $price;
    private $minimumAmount;

    function __construct($name, $price, $minimumAmount) {
        $this->name = $name;
        $this->price = $price;
        $this->minimumAmount = $minimumAmount;
    }

    function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }

    function getMinimumAmount() {
        return $this->minimumAmount;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setMinimumAmount($minimumAmount) {
        $this->minimumAmount = $minimumAmount;
    }

}
