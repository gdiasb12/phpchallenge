<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Document extends Model
{

	public $fillable = ['filename'];

	public $appends = ['link'];

	protected static function boot()
	{
		parent::boot();
		//unlink the file when delete the record
		static::deleting(function ($document) {
			unlink($document->path_file);
		});

	}
	
	public function getLinkAttribute()
	{
		return route('document.show', $this->id);
	}

	public function getPathFileAttribute() 
	{	
		$fileName = $this->attributes['filename'];
		return $fileName ? public_path('storage/xml/' . $fileName) : null;
	}

}
