<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Document extends Model
{

	public $fillable = ['filename'];

	public $appends = ['link', 'link_api'];

	protected static function boot()
	{
		parent::boot();
		//unlink the file when delete the record
		static::deleting(function ($document) {
			unlink($document->path_file);
		});

	}
	
	public function getLinkApiAttribute()
	{
		return url('api/document/'.$this->id);
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
