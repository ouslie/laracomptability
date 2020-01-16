<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Session;

class Base extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'user_id'
    ];

    public static function defaultBase() {

        $base = Base::where('user_id', '=', Auth::id())->where('is_default', '=', 1)->first();

        // if($base->count() == 1) {
        //     $base_id =  $base->id;
        // } else {
        //     $base = Base::where('user_id', '=', Auth::id())->first();
        //     $base_id =  $base->id;
        // }
        return 1;
    }

    public static function activeBase()
    {
        return Session::get('base_id');
    }


}
