<?php
namespace App\Http\Models\Backend;

use Carbon\Carbon;
use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{    
    protected $table = 'orders';    
    protected $primaryKey = 'OrderID';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['OrderUserID', 'OrderAmount', 'OrderShipping','OrderTax', 'OrderPercentOff',
                            'OrderDate', 'OrderPercentEffort', 'OrderTotal', 'OrderStatus', 'OrderGuestNote',
                            'OrderAdminNote', 'OrderCreator'];

    public function products()
    {
        return $this->hasMany('App\Http\Models\Backend\Product','OrderID');
    }

    public function user()
    {
        return $this->belongsTo('App\Http\Models\Backend\User', 'OrderID');
    }



}
