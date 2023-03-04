<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    public function users(){ //多対多の「多」側なので複数系
        return $this->belongsToMany('App\Models\Users\User','subject_users','id','id');// リレーションの定義
    }
}
