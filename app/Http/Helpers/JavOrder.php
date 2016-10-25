<?php

namespace App\Http\Helpers;

use App\Http\Helpers\Contracts\JavOrderContract;
use App\Http\Models\Backend\Order;
use App\Http\Models\Backend\Product, App\Http\Models\Backend\User;
use Carbon\Carbon;
use DB, Exception;


class JavOrder implements JavOrderContract
{
    const PERCENT_EFFORT = 5;
    const DEFAULT_STATUS = "pending";
    const DEFAULT_USER = "admin";    

    public function __construct() {        
    }

    // Hàm tính tổng tiền hoá đơn
    public static function calculateTotalPrice($orders) {
        $total = 0;
        foreach ($orders as $key => $value) {
            if (isset($value['ProductTax']) && $value['ProductTax'] != '') {
                $priceItem = ($value['ProductPrice'] + $value['ProductPrice'] * $value['ProductTax'] / 100)
                                * $value['ProductQty'];
            }
            else {
                $priceItem = $value['ProductPrice'] * $value['ProductQty'];
            }
            $total += $priceItem;
        }
        return $total;
    }

    // Convert json data thành Product Object để insert multi
    public static function buildProductObjects($products) {
        $ProductObject = function ($product) {
            return new Product($product);
        };
        $products = array_map($ProductObject, $products);
        return $products;
    }

    // Hàm tạo khung data cho 1 đơn hàng
    public static function buildAnOrder($order_data)
    {
        $order = new Order;
        $order->UserID = $order_data['UserID'];
        $order->OrderDate = Carbon::now();
        $order->OrderPercentEffort = self::PERCENT_EFFORT;
        $order->OrderTotal = isset($order_data['total']) ? $order_data['total'] : 0;
        $order->OrderStatus = self::DEFAULT_STATUS;
        $order->OrderCreator = self::DEFAULT_USER;
        $order->OrderReceiverName = isset($order_data['Receiver']['UserLastName']) ?
                                    $order_data['Receiver']['UserLastName'] : '' ;                                     
        $order->OrderReceiverAddress = isset($order_data['Receiver']['UserAddress']) ? 
                                    $order_data['Receiver']['UserAddress'] : '';
        $order->OrderReceiverPhone = isset($order_data['Receiver']['UserPhone']) ? 
                                    $order_data['Receiver']['UserPhone'] : '';

        if($order->save()) {
            return $order;
        }
    }

    // Hàm tạo đơn hàng
    public static function PlaceOrder($data) {        
        
    	if(empty($data)){
    		return response()->json(['code' => 409, 'message' => 'Không có sản phẩm hoặc có sản phẩm lỗi trong đơn hàng']);
    	}

        $data['meta']['total'] = self::calculateTotalPrice($data['orders']);
        try {
        	DB::transaction(function () {
			    self::buildAnOrder($data['meta']);
				$data['orders'] = self::buildProductObjects($data['orders']);
            	$order->products()->saveMany($data['orders']);
			});
            DB::commit();
            return response()->json(['code' => 200, 'message' => 'Tạo Order thành công']);
        }
        catch(PDOException $e)
        {
            DB::rollBack();
        	return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
        catch (Exception $e) {
        	DB::rollBack();
        	return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

    }

}