<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo_user extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = ['user_id'];

    public static $rules = array(
        'user_id' => 'required',
        'password' => 'required',
        //'age' => 'integer|min:0|max:150'
    );
}
