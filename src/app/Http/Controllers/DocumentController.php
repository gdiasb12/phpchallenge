<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class DocumentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    //Brigs all Documents
    public function index()
    {
        return response()->json(Document::latest()->get());
    } 

	//Show the Document based on the ID  
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

    //Save Document file and Create a new record 
    public function store()
    {
    	$file = request()->file('xmlfile');
		//Use the time to set a new name to the file 
    	$fileName = time().'_'.$file->getClientOriginalName();
    	
		//Move the file to a storage folder
    	if ($file->storeAs('public/xml', $fileName)) {

			//Create a new record 
    		$document = Document::create([
    			'filename' => $fileName
    		]);

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

	//Delete the record and unlink the file as well
    public function destroy(Document $document)
    {
    	$document->delete();

    	return redirect('/home');
    }
}
