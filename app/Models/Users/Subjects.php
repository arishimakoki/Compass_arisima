<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'subjects_id',
        'user_id'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\Users\User','subject_id','user_id');// リレーションの定義
    }
}
