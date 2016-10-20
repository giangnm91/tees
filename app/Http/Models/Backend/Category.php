<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Category extends Model
{
    use NestableTrait;
    protected $table = 'menus';    
    protected $primaryKey = 'CategoryID';
    protected $parent = 'ParentID';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['CategoryName', 'CategoryID', 'ParentID','Slug', 'Icon'];

    public function products()
    {
        return $this->hasMany('App\Http\Models\Backend\Products','CategoryID');
    }

    public static function createOrUpdate($data, $keys) {
        $record = self::where($keys)->get();
        
        if (is_null($record)) {
            return self::create($data);
        } else {    
            return \DB::table('menus')->where($keys)
                    ->update(array('CategoryName' => $data['CategoryName'], 'ParentID' => $data['ParentID'], 'Slug' => $data['Slug'], 'Icon' => $data['Icon']));
        }
    }

    public static function renderMenu() 
    {       
        $menu = array_reverse(self::nested()->getWithoutCache());
        return Helper::buildMenuTree($menu);
    }

    public function parents()
    {       
        return $this->belongsTo('App\Http\Models\Backend\Category', 'ParentID');
    }

    public function childrens()
    {
        return $this->hasMany('App\Http\Models\Backend\Category', 'ParentID');
    }
}
