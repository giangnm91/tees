<?php
namespace App\Http\Models\Backend;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';    
    protected $primaryKey = 'UserID';
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['*'];

    public function orders()
    {
        return $this->hasMany('App\Http\Models\Backend\Order','UserID');
    }

    public function FindUser($user_id) {
        $user = User::find($user_id);
        if ($user && sizeof($user) > 0) {
            return response()->json(['status' => 200, 'data' => $user->toArray()]);
        }
        return response()->json(['status' => 409, 'message' => 'Có lỗi trong quá trình tìm kiếm dữ liệu']); 
    }

}
