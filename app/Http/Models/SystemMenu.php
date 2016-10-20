<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Category extends Model
{
    use NestableTrait;
    protected $table = 'products_categories';    
    protected $primaryKey = 'CategoryID';
    protected $parent = 'ParentID';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['CategoryName', 'CategoryID', 'ParentID','Slug'];

    public function products()
    {
        return $this->hasMany('App\Http\Models\Backend\Products','CategoryID');
    }

    public static function createOrUpdate($data, $keys) {
        $record = self::where($keys)->get();
        
        if (is_null($record)) {
            return self::create($data);
        } else {    
            return \DB::table('products_categories')->where($keys)
                    ->update(array('CategoryName' => $data['CategoryName'], 'ParentID' => $data['ParentID'], 'Slug' => $data['Slug']));
        }
    }

    public static function renderFrontendCate() 
    {       
        return Helper::buildFrontendCateTree(self::nested()->getWithoutCache());
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
