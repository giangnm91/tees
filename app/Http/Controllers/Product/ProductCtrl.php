<?php namespace App\Http\Controllers\Product;

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
class ProductCtrl extends Controller
{
	public function __construct() {
        $this->pageInfo = [
        	"title" => trans("backend.Product.list"), 
        	"title_info" => trans("backend.Product.list")
        ];
        $this->listCategory = Category::all();
    }

    function getIndex() {
        $pageInfo = $this->pageInfo;   
        $pageInfo['breadcrumb'] = 'products';
        $input = \Input::except('_token');
        $limit = \Input::get('limit') ?: 20;
        $from = \Input::get('from') ?: 0;
        $sortColumn = 'price';
        $sortValue = 'desc';
        $listCategory = $this->listCategory;

        if (\Input::has('order')) {
            foreach (\Input::get('order') as $key => $value) {
                $sortColumn = \Input::get('columns.'.$value['column'].'.data');
                $sortValue = $value['dir'];
            }
        }
        

        if (isset($input) && $input != null) {
            $query = Product::whereHas('category',function($query) use ($input) {
                foreach ($input as $key => $value) {                          
                    if ($value != "") {
                        if ($key == "price" && $value != "") {
                            $value = explode(";", $value);
                            $query->whereBetween('price', [$value[0], $value[1]]);
                        } else if ($key == "title" && $value != "") {
                            $query->where('title', 'like', '%' . $value . '%');
                        } else if ($value[0] != "") {
                            $query->where($key,$value);
                        }                            
                    }                                              
                }
            });
            $products = $query->limit($limit)->offset($from)->orderBy($sortColumn, $sortValue)->get()->toArray();
        } else {
            $products = Product::limit($limit)->offset($from)->orderBy($sortColumn, $sortValue)->get()->toArray();
        }
        return view('backend.product.index', compact('products','pageInfo','input','listCategory'));
	}

    function postAddOrUpdateProduct() {
        $data_add       = \Input::except('_token');
        $is_new         = true;
        $productObj     = null;
        if(isset($data_add['id'])) {
            $product    = Product::firstOrNew(['id' => $data_add['id']]);  
            $is_new     = false;
        } else {
            $product = new Product();
        }

        $images = isset($data_add['thumb']) ? $this->uploadImages($data_add['thumb']) : false;
        if ($images != false && isset($images) && sizeof($images) > 0) {
            $listImages = "";
            foreach ($images as $key => $value) {
                $listImages .= $value .",";
            }
            $data_add['thumb'] = $listImages;
        }

        $productObj = $this->parseProductData($product,$data_add); 
        try {
            if($productObj != null && $productObj->save()){
                if ($is_new) {
                    $productObj->category()->attach($data_add['category']);
                    return ['code' => 200, 'message' => 'Thêm mới thành công.'];
                } else {
                    $productObj->category()->sync(array($data_add['category']));
                    return ['code' => 200, 'message' => 'Cập nhật thành công.'];
                }            
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        
        return ['code' => 400, 'message' => 'Thất bại, xin thử lại.'];
    }

    function parseProductData($product, $productData)
    {       
        $product->title = $productData['title'];
        if (isset($productData['thumb'])) {
            $product->thumb = $productData['thumb'];
        }
        $product->price = isset($productData['price']) ? $productData['price'] : 0;
        $product->price_discount = isset($productData['price_discount']) ? $productData['price_discount'] : 0;  
        $product->description = $productData['description'];
        $product->type = isset($productData['type']) ? $productData['type'] : 0;
        $product->url = $productData['url'];
        $product->mockup1 = $productData['mockup1'];
        $product->mockup2 = $productData['mockup2'];
        $product->mockup3 = $productData['mockup3'];
        $product->android_clicks = isset($productData['android_clicks']) ? $productData['android_clicks'] : 0;
        $product->ios_clicks = isset($productData['ios_clicks']) ? $productData['ios_clicks'] : 0;
        return $product;
    }

    function uploadImages($imagesUploaded)
    {       
        $destinationPath = public_path('images/frontend');
        $images = [];   
        foreach ($imagesUploaded as $key => $value) {           
            $image_name = url('images/frontend') . "/" . str_replace("-", "_", $value->getClientOriginalName());
            if (!in_array($image_name, $images)) {
                array_push($images, $image_name);
            }
            $value->move($destinationPath,$image_name);
        }               
        return $images;
    }

    function delete() {
        $id = \Input::get('id'); 
        Product::find($id)->category()->detach();
        $deleted = Product::find($id)->delete();
        if ($deleted) {            
            return ['code' => 200, 'message' => 'Xoá thành công.'];
        }
        return ['code' => 500, 'message' => 'Xoá thất bại, vui lòng thử lại!'];
    }

    function getFindProduct()
    {
        $product_id = \Input::get('id');
        $listCategory = $this->listCategory;
        try {
            $product        = Product::where('id',$product_id)->get()->toArray();                    
            //$category       = Category::selected('id',$product[0]->CategoryID)->renderAsDropdown();
            //$images         = $product->images;

            if($product){
                //$category = $product[0]->category()->get();
                return view('backend.product.edit', compact('product','category','listCategory'));
            }
            return response()->json(['code' => 400, 'message' => 'Không tìm thấy sản phẩm']);
        }
        catch (\Exception $e){          
            return response()->json(['code' => 400, 'message' => $e->getMessage()]);
        }
    }

    function postImportExcel(Request $request) 
    {
        $rules = array(
            'file' => 'required',
        );
        $data = \Input::except('_token');
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) 
        {
            return \Redirect::to('product')->withErrors($validator);
        }
        else 
        {
            try {
                $extension = File::extension($data['file']->getClientOriginalName());
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                    $path = $request->file->getRealPath();
                    $data = \Excel::load($path, function($reader) {
                    })->get();
                    if(!empty($data) && $data->count()){
                        foreach ($data as $key => $value) {                        
                            $insert[] = [
                                'title' => isset($value->title) ? $value->title : "unknown_product_" . (string)rand() ,
                                'description' => isset($value->description) ? $value->description : "",
                                'url' => $value->url,
                                'mockup1' => $value->mockup1,
                                'mockup2' => $value->mockup2,
                                'mockup3' => $value->mockup3,
                                'price' => isset($value->price) ? $value->price : 0,
                                'price_discount' => isset($value->price_discount) ? $value->price_discount : 0,
                                'type' => $value->type,
                                'android_clicks' => isset($value->android_clicks) ? $value->android_clicks : 0,
                                'ios_clicks' => isset($value->ios_clicks) ? $value->ios_clicks : 0
                            ];
                            $category_list[] = [
                                $value->category_id 
                            ];
                        }
                        if(!empty($insert)){
                            $insertData = \DB::table('products')->insert($insert);
                            if ($insertData) {
                                $lastIdBeforeInsertion = \DB::getPdo()->lastInsertId();
                                $insertedIds = [];
                                for($i=0; $i <= sizeof($insert); $i++) {
                                    array_push($insertedIds, $lastIdBeforeInsertion+$i);
                                }
                                for($j=0; $j <= sizeof($insertedIds); $j++) {
                                    $product = Product::find($insertedIds[$j]);
                                    if ($product) {
                                        $product->category()->attach($category_list[$j]);
                                    }                                    
                                }
                                \DB::commit();
                                return response()->json(['code' => 200, 'message' => 'Nhập liệu thành công!']);
                            } else {                        
                                \DB::rollback();                                
                                return response()->json(['code' => 500, 'message' => 'Có lỗi trong quá trình nhập liệu!']);                            
                            }
                        }
                    }
     
                } else {
                    return response()->json(['code' => 500, 'message' => 'Có lỗi trong quá trình nhập liệu!']);
                }
            } catch(\Exception $e){
                \DB::rollback();
            }
        }
    }

    function excludeCategory($array){
        foreach ($array as $key => $value) {
            if($key == "categoryID") {
                unset($array[$key]);
            }
        }
        return $array;
    }

    function getProductByCategory() {
        $result = new \stdClass();
        $category_id = \Input::has('catid') ? \Input::get('catid') : 1;
        $page = \Input::has('page') ? \Input::get('page') : 0;
        $size = \Input::has('size') ? \Input::get('size') : 10;

        $products = Product::with('category')
                ->whereHas('category', function($query) use ($category_id) {                    
                    $query->where('category_id',$category_id);                    
                })->limit($size)->offset($page)->get()->toJson();
        //$product   = Product::where('id',$product_id)->get()->toArray();
        if (isset($products) && count(json_decode($products, true)) > 0) {
            return response()->json([
                'code' => 200,
                'message' => "Tìm thấy " . count(json_decode($products, true)) . " kết quả",
                'result' => json_decode($products,true)
            ]);           
        } else {
            return response()->json([
                'code' => 500,
                'message' => "Không tìm thấy kết quả nào.",
                'result' => []
            ]);
        }
    }
}   
