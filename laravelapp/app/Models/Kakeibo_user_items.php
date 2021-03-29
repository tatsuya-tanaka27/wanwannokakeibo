<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo_user_items extends Model
{
    use HasFactory;

    protected $table = 'kakeibo_user_items';

    public static $rules = array(
        'item_id' => 'required',
        'item_name' => 'required',
    );
}
