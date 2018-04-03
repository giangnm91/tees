<?php
namespace App\Http\Helpers;

use Request;

class Helper
{
	public static function Money($int = 0) {
    	return number_format($int, 0, ',', '.');
    }

    public static function flattenJsonTree($aJSON, $iParentId = 0, $iLevel = 0)
    {
        $aRetval = array();
        $iPosition = 1;
        foreach ($aJSON as $aChilds) {
            $aDescendents = array();
            if (isset($aChilds['children'])) {      
                $aDescendents = Helper::flattenJsonTree(
                    $aChilds['children'], $aChilds['id'], $iLevel+1
                );
            }
            $aRetval[] = array(
                'name' => $aChilds['title'],
                'slug'     => $aChilds['slug'],
                'id'  => $aChilds['id'], 
                'parent_id'   => $iParentId,
            );
            $aRetval = array_merge($aRetval, $aDescendents);
        }
        return $aRetval;
    }

    public static function buildTree(array &$elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as &$element) {
            if ($element['parent'] == $parentId) {
                $children = Helper::buildTree($elements, $element['menu_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['menu_id']] = $element;
                unset($element);
            }
        }
        return $branch;
    }

    public static function buildMenuTree($jsonCate, $isChild = false, $childLevel = 0) 
    {
        $html = "";        
        if ($isChild) 
        {            
            $html .= "<ul class='sub-menu'>";
            foreach ($jsonCate as $key => $value) {
                $html .= "<li class='nav-item start'><a class='nav-link' href='{$value['slug']}'><i class='fa {$value['icon']}'></i> <span class='title'>{$value['name']}</span></a>";
                if (isset($value['children']) && sizeof($value['children']) > 0)
                {
                    $html .= self::buildMenuTree($value['children'], true);
                }
                $html .= "</li>";
            }
            $html .= "</ul>";
        }
        else
        {   
            $html = '<ul class="page-sidebar-menu page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">';         
            foreach ($jsonCate as $key => $value) {                
                $html .= "<li class='nav-item start '><a href='{$value['slug']}' class='nav-link nav-toggle' >
                        <i class='fa {$value['icon']}'></i> <span class='title'>{$value['name']}</span><span class='arrow'></span>";
                if(isset($value['children']) && count($value['children']) > 0)
                {
                    //$html .= "<b class='caret'></b></a>";
                    $html .= self::buildMenuTree($value['children'], true);
                }
                $html .= "</a></li>";            
            }
        }
        return $html;
    }
}