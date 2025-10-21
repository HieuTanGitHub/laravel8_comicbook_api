<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileGGDrive extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'type', 'path','filename','extension','timestamp','mimetype','size','dirname','basename','chapter_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'files_ggdrive';

 	
}
