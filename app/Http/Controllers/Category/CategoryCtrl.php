<?php namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Order;
use App\Http\Models\Backend\Product, App\Http\Models\Backend\User;
use App\Http\Helpers\Helper;
use App\Http\Helpers\Contracts\JavOrderContract;
use App\Http\Models\Backend\Menu;
use App\Http\Models\Backend\Category;
use File;
use Illuminate\Http\Request;
/**
* Product Controller
*/
class CategoryCtrl extends Controller
{
	public function __construct() {
        $this->pageInfo = [
        	"title" => trans("backend.Category.list"), 
        	"title_info" => trans("backend.Category.list")
        ];
        $this->listCategory = Category::all();
    }

    function getIndex() {
        $pageInfo = $this->pageInfo;
        $pageInfo['breadcrumb'] = 'category';
        $listCategory = $this->listCategory;
        return view('backend.category.index', compact('listCategory','pageInfo'));
    }

    function Add() {
        $data = \Input::except('_token');
        $category = new Category;
        $category->name = $data['name'];
        if (sizeof(Category::where('name','=',$data['name'])->get()) > 0) {
            return response()->json(['code' => 500, 'message' => 'Category đã tồn tại!']);
        }
        if($category->save()){
            $html = '<li class="dd-item" data-id="' . $category->id .'" data-title="'.$data['name']. '"><div class="dd-handle">' . $data['name'] .'<a href="javascript:;" class="pull-right delete-category" data-id="' .$category->id. '"><i class="fa fa-trash"></i></a></div></li>';
        }
        
        return response()->json(['code' => 200, 'html' => $html, 'message' => 'Thêm mới category thành công!']);
    }

    function Delete($category_id) {
        try {
            $delete_cat         = Category::destroy($category_id);
            if($delete_cat){
                return response()->json(['code' => 200 , 'message' => 'Xoá thành công!']);
            }
            return response()->json(['code' => 400, 'message' => 'Có lỗi trong quá trình xoá']);
        }
        catch (\Exception $e){          
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }
}   
