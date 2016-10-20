<?php namespace App\Http\Controllers\Article;
use Request;
use Yajra\Datatables\Html\Builder;
use Datatables;
use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use Carbon\Carbon;
/**
* Dashboard Controller
*/
class ArticleCtrl extends Controller
{
	public function __construct() {
        $this->pageInfo = [
        	"title" => trans("backend.Article.page_title"), 
        	"title_info" => trans("backend.Article.page_add")
        ];
    }

	function getIndex(Request $request, Builder $htmlBuilder) {
		$pageInfo['breadcrumb'] = "article";
		$listFields = ['_id', 'images', 'vn' , 'created_time', 'modified_time', 'author'];
		if ($request::ajax()) {
			$limit  = 0+\Input::get('length');			
			$offset = 0+\Input::get('start');
			$article = Article::orderBy('created_time','desc')->skip($offset)->take($limit);
						
			if(\Input::has('search.value') && \Input::has('search.value') != "") {
				$article = $article->where(function($q) use ($request) {
					if ( $term = strtolower(\Input::get('search.value')) )
					{	
						$q->orWhere('vn.name', 'like', '%'.$term.'%');
					}
				});
			}

			if(\Input::has('startDate') && \Input::has('endDate')){
				$article = $article->where(function($q) use ($request) {					
					$q->orWhereBetween('created_time', [0+\Input::get('startDate'), 0+\Input::get('endDate')]);					
				});
			}
			if(\Input::has('order')){
				foreach (\Input::get('order') as $key => $value) {
					$article = $article->orderBy(\Input::get('columns.'.$value['column'].'.data'),$value['dir']);
				}
			}
			
			foreach (config('app.languages') as $key => $value){
				array_push($listFields, $key);
			}
			$article = $article->get($listFields);
			
	        return Datatables::of($article)
	        	->editColumn('created_time','{!! isset($created_time) ? date("d/m/Y",$created_time) : "--" !!}')
  	 		    ->editColumn('modified_time','{!! isset($modified_time) ? date("d/m/Y",$modified_time) : "--" !!}')
	        	->addColumn('checkbox', function($article){
	        		return "<input type='checkbox' name='checkboxSelect'>";
	        	})
		        ->addColumn('action', function ($article) {
		            return '<a href="javascript:;" data-id="'.$article['_id'].'" class="btn btn-xs btn-primary edit-merchant"><i class="fa fa-edit"></i></a>
		            <a href="javascript:;" data-id="'.$article['_id'].'" class="btn btn-xs btn-danger delete-merchant"><i class="fa fa-trash"></i></a>';
		        })
		        ->make(true);
		    }				
			return view('article.index',compact('pageInfo'));					
	}

	function getAddArticle() {		
		$pageInfo = $this->pageInfo;
		$pageInfo['breadcrumb'] = "add_article";
		return view('article.add', compact('pageInfo'));
	}

	function postAdd() {
		$data = \Input::except('_token');
		$file = \Input::file();
		$list_images = [];
		$article = new Article;
		if (isset($file) && sizeof($file) > 0) {
			foreach ($file['file'] as $image) {
				$image_name = $image->getClientOriginalName();
				array_push($list_images, url('public/images/'). "/" .$image_name);
				$image->move(public_path('images'),$image_name);			
			}
		}		
		$article->images = $list_images;
		foreach (config('app.languages') as $key => $value) {			
			$article->$key = $data['article'][$key];							
		}		

		$article->created_time = Carbon::now()->timestamp;
		$article->modified_time = null;
		$article->author = $data['author'];
		$article->status = $data['status'];

		if($article->save()){
			return response()->json(['code' => 'success', 'message' => 'Insert thành công!']);
		}
		else{
			return response()->json(['code' => 'error', 'message' => 'Insert chưa thành công!']);
		}
	}


}
