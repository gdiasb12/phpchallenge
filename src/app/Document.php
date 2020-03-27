<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

	public $fillable = ['filename'];

	public $append = ['path_file'];
    //
	public function getPathFileAttribute() 
	{	
		$fileName = $this->attributes['filename'];

		return $fileName ? public_path('storage/xml/' . $fileName) : null;
	}

}
