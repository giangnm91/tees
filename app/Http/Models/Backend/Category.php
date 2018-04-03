<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;

class Category extends Model
{
    use NestableTrait;
    protected $table = 'category';    
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['id', 'name'];

    public function product()
    {
        return $this->belongsToMany('App\Http\Models\Backend\Product')->withPivot('id');
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
}
