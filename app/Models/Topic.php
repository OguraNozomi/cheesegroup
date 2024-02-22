<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    //  // News Modelに関連付けを行う
    // public function histories()
    // {
    //     return $this->hasMany('App\Models\History');
    // }
    
    // users Modelに関連付けを行う
    //従テーブルの場合は、belongsToと書く
    //usersテーブルのデータを呼び出せるようになる
    // public function user(){
    // return $this->belongsTo('App\Models\User');
    // }
}
