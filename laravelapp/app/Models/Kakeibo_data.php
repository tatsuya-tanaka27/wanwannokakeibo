<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo_data extends Model
{
    use HasFactory;

    // dataは不可算名刺なので固定の名前を設定
    protected $table = 'kakeibo_data';

    public static $rules = array(
        'item_id' => 'required',
        'input_date' => 'required',
        'amount' => 'required',
        //'age' => 'integer|min:0|max:150'
    );

    public function scopeUserIdEqual($query, $user_id)
    {
        return $query->where('user_id', $user_id)->orderBy('input_date', 'asc')->get();
    }
}
