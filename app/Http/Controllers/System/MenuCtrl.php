<?php namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Menu;
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
		$listMenu = Menu::renderAsJSON();
		return view('system.menu', compact('listMenu','pageInfo'));
	}

	function Add() {
		$data = \Input::except('_token');
		$menu = new Menu;
		$menu->name = $data['name'];
		$menu->slug = isset($data['slug']) ? $data['slug'] : "/";
		if($menu->save()){
			$html = '<li class="dd-item" data-id="' . $menu->id .'" data-title="'.$data['name']. '" data-slug="'
					.$data['slug']. '"><div class="dd-handle">' . $data['name'] .'<a href="javascript:;" class="pull-right delete-category" data-id="' .$menu->id. '"><i class="fa fa-trash"></i></a></div></li>';
		}
		
		return response()->json(['code' => 'success', 'html' => $html]);
	}

	function SavePosition() {
		$data = \Input::except('_token');		
		$data = Helper::flattenJsonTree(json_decode($data['obj'],true));	
		foreach ($data as $key => $menu) {
			Menu::createOrUpdate($menu,array('id' => $menu['id']));			

		}
		return response()->json(['code' => 'success', 'message' => 'Thành công!']);
	}

	function Delete($menu_id) {
		try {
			$delete_child_cats 	= Menu::where('parent_id',$menu_id)->delete();
			$delete_cat 		= Menu::destroy($menu_id);
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
