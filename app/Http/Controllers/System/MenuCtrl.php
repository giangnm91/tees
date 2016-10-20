<?php namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Category;
use App\Http\Helpers\Helper;
/**
* System Menu Controller
*/
class MenuCtrl extends Controller
{
	public function __construct() {
        $this->pageInfo = [
        	"title" => trans("backend.System.Menu.menu"), 
        	"title_info" => trans("backend.System.Menu.info")
        ];
    }

    function getIndex() {
    	$pageInfo = $this->pageInfo;
		$pageInfo['breadcrumb'] = 'system_menu';
		$listMenu = Category::renderAsJSON();
		return view('system.menu', compact('listMenu','pageInfo'));
	}

	function Add() {
		$data = \Input::except('_token');
		$menu = new Category;
		$menu->CategoryName = $data['CategoryName'];
		$menu->Slug = isset($data['Slug']) ? $data['Slug'] : "/";
		if($menu->save()){
			$html = '<li class="dd-item" data-id="' . $menu->CategoryID .'" data-title="'.$data['CategoryName']. '" data-slug="'
					.$data['Slug']. '"><div class="dd-handle">' . $data['CategoryName'] .'<a href="javascript:;" class="pull-right delete-category" data-id="' .$menu->CategoryID. '"><i class="fa fa-trash"></i></a></div></li>';
		}
		
		return response()->json(['code' => 'success', 'html' => $html]);
	}

	function SavePosition() {
		$data = \Input::except('_token');		
		$data = Helper::flattenJsonTree(json_decode($data['obj'],true));	
		foreach ($data as $key => $category) {
			Category::createOrUpdate($category,array('CategoryID' => $category['CategoryID']));			

		}
		return response()->json(['code' => 'success', 'message' => 'Thành công!']);
	}

	function Delete($category_id) {
		try {
			$delete_child_cats 	= Category::where('ParentID',$category_id)->delete();
			$delete_cat 		= Category::destroy($category_id);
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
