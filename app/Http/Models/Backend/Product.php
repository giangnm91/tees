<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';    
    protected $primaryKey = 'ProductID';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['ProductID', 'ProductName', 'ProductPrice','ProductColor', 'ProductSize',
                            'ProductDesc', 'ProductImage', 'ProductUpdateDate', 'ProductQty', 'ProductLive',
                            'ProductTax', 'ProductUrl'];

    public function order()
    {
        return $this->belongsTo('App\Http\Models\Backend\Order','OrderID');
    }

}
