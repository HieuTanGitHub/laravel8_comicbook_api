<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tieude', 'mota', 'copyright','map','tieude_footer','logo','updated_at'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'information';

 	
}
