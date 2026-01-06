<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $qty;

    public function __construct($id, $name, $price, $qty)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = (float)$price;
        $this->qty = (int)$qty;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function amount()
    {
        return $this->price * $this->qty;
    }

    public function isValidQty()
    {
        return $this->qty > 0;
    }
}
