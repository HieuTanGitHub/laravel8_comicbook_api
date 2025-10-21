<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocDanh extends Model
{
    use HasFactory;

    protected $fillable = [
    	'danhmuc_id','truyen_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'thuocdanh';

 	
}
