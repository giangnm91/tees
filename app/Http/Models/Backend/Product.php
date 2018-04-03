<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';    
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    protected $fillable = ['id', 'title', 'description','url', 'thumb',
                            'mockup1', 'mockup2', 'mockup3', 'price', 'price_discount',
                            'type', 'android_clicks','ios_clicks'];

    public function category()
    {
        return $this->belongsToMany('App\Http\Models\Backend\Category')->withPivot('id');
    }

}
