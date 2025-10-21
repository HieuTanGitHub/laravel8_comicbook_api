<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocLoai extends Model
{
    use HasFactory;
    protected $fillable = [
    	'theloai_id','truyen_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'thuocloai';
}
