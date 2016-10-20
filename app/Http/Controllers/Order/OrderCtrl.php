<?php namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Category;
use App\Http\Models\Backend\Order;
use App\Http\Models\Backend\Product, App\Http\Models\Backend\User;
use App\Http\Helpers\Helper;
use App\Http\Helpers\Contracts\JavOrderContract;

/**
* Order Controller
*/
class OrderCtrl extends Controller
{
	public function __construct() {
        $this->pageInfo = [
        	"title" => trans("backend.System.Menu.menu"), 
        	"title_info" => trans("backend.System.Menu.info")
        ];
    }

    function getIndex() {
        $pageInfo = $this->pageInfo;        
        $input = \Input::get('input');
        $paging = \Input::get('paging');
        $pageInfo['breadcrumb'] = 'order';  

        if ($input) {
            $products = Product::with('order')
                ->whereHas('order', function($query) use ($input) {
                    foreach ($input as $key => $value) {
                        if ($key == "Date") {
                            $query->whereBetween('OrderDate', [$value['From'], $value['To']]);
                        }  
                        else if ($value != "") {
                            $query->where($key,$value);
                        }                                              
                    }
                })->limit($paging['limit'])->offset($paging['offset'])->get()->toArray();
        }  
        else {
            $products = Product::with('order')->limit($paging['limit'])->offset($paging['offset'])->get()->toArray();
        }

        if ($products) {
            return response()->json(['status' => 200, 'data' => $products, 'input' => $input]);
        }
        return response()->json(['status' => 409, 'message' => 'Có lỗi trong quá trình tìm kiếm dữ liệu']);
	}    

    public function PlaceOrder(JavOrderContract $javOrder) {
        $data   = \Input::except('_token');
        $result = $javOrder::PlaceOrder($data);
        return $result;
    }
}   
