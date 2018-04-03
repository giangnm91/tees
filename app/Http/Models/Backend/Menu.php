<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Menu extends Model
{
	use NestableTrait;
	protected $table = 'menus';    
	protected $primaryKey = 'id';
	protected $parent = 'parent_id';
	public $timestamps = false;
	protected $guarded = [];
	protected $fillable = ['name', 'id', 'parent_id','slug', 'icon'];

	public static function createOrUpdate($data, $keys) {
	    $record = self::where($keys)->get();
	    
	    if (is_null($record)) {
	        return self::create($data);
	    } else {    
	        return \DB::table('menus')->where($keys)
	                ->update(array('name' => $data['name'], 'parent_id' => $data['parent_id'], 'slug' => $data['slug'], 'icon' => $data['icon']));
	    }
	}

	public static function renderMenu() 
	{       
	    $menu = array_reverse(self::nested()->getWithoutCache());
	    return Helper::buildMenuTree($menu);
	}

	public function parents()
	{       
	    return $this->belongsTo('App\Http\Models\Backend\Menu', 'parent_id');
	}

	public function childrens()
	{
	    return $this->hasMany('App\Http\Models\Backend\Menu', 'parent_id');
	}
}
