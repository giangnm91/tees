<?php namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;

/**
* Dashboard Controller
*/
class DashboardCtrl extends Controller
{
	public function __construct() {
        $this->pageInfo = ["title" => trans("backend.Dashboard"), "title_info" => trans("backend.Statistic")];
    }

	function getIndex() {
		$pageInfo = $this->pageInfo;
		$pageInfo['breadcrumb'] = 'home';
		return view('main.dashboard', compact('pageInfo'));
	}

	function getHome() {
		return $this->getIndex();
	}

}
