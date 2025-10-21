<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theloai extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'tentheloai', 'mota', 'kichhoat','slug_theloai','tukhoa'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'theloai';

 	public function truyen(){
 		return $this->hasMany('App\Models\Truyen');
 	}
 	public function nhieutheloaitruyen(){
 		return $this->belongsToMany(Truyen::class,'thuocloai','theloai_id','truyen_id');
 	}
}
