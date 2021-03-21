<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo_item_mst extends Model
{
    use HasFactory;

    public static $rules = array(
        'item_id' => 'required',
        'item_name' => 'required',
        //'age' => 'integer|min:0|max:150'
    );

    // mstは略称なので固定の名前を設定
    protected $table = 'kakeibo_item_mst';
}
