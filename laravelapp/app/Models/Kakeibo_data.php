<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakeibo_data extends Model
{
    use HasFactory;

    // dataは不可算名刺なので固定の名前を設定
    protected $table = 'kakeibo_data';
}
