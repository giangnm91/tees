<?php

namespace App\Http\Helpers\Contracts;

interface JavOrderContract
{
    public static function calculateTotalPrice($orders);
    public static function buildProductObjects($products);
    public static function buildAnOrder($order_data);
    public static function PlaceOrder($data);
}