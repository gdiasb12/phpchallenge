<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class DocumentController extends Controller
{
    //
	public function index()
	{
		return Document::all();
	} 
	//
	public function show(Document $document)
	{
		try {
			
			if ($document->path_file) {
				$xml = simplexml_load_file($document->path_file);

				return response()->Json($xml);

			} else {
				return response()->Json('File not found!', 404);
			}
		} catch (Exception $e) {
			return response()->Json('Ops! Error on open file.');			
		}
	}
    //
	public function store()
	{

		$file = request()->file('xmlfile');
		$fileName = time().'_'.$file->getClientOriginalName();
		
		if ($file->storeAs('public/xml', $fileName)) {


			$document = Document::create([
				'filename' => $fileName
			]);
			// $xml = simplexml_load_file($document->path_file);
			// return $file;	
			$msg = [
				'title' => 'Sucesso!',
				'text' => 'Document uploaded!',
				'icon' => 'success'
			];
		}else{
			$msg = [
				'title' => 'Ops!',
				'text' => 'Erro on upload the file!',
				'icon' => 'error'
			];
		}
		return redirect('/home')->with('message', $msg);
	}

	public function destroy(Document $document)
	{
		$document->delete();

		return redirect('/home');
	}
}
