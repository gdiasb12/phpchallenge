<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Document;

class DocumentTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function a_document_can_be_uploaded()
    {

        $this->withoutExceptionHandling();

        $file = UploadedFile::fake()->create('document_test.xml');

        // Use the time to set a new name to the file 
        $fileName = time().'_'.$file->getClientOriginalName();
        
        //Move the file to a storage folder
        $response = $file->storeAs('public/xml', $fileName);

        // Assert the file was stored...
        Storage::disk('public')->assertExists('xml/'.$fileName);

        //Delete the file
        Storage::disk('public')->delete('xml/'.$fileName);

    }

    /** @test */
    public function a_document_can_be_stored()
    {
        $this->withoutExceptionHandling();
        
        $response = $this->post('/document', $this->data());

        $response->assertRedirect('/home');       

        $document = Document::first();
        //Delete the file
        $this->deleteFile($document->filename);
    }

    /** @test */
    public function a_document_list_can_be_showed()
    {
        $this->withoutExceptionHandling();

        $this->post('/document', $this->data());

        $this->get('/document')->assertStatus(200);

        $document = Document::first();
        //Delete the file
        $this->deleteFile($document->filename);
    }

    /** @test */
    public function a_document_can_be_deleted()
    {

        $this->withoutExceptionHandling();

        $this->post('/document', $this->data());

        $this->assertCount(1, Document::all());

        //Delete the record
        $response =  Document::first()->delete();

        $this->assertCount(0, Document::all());
    }

    public function data()
    {
        return ['xmlfile' => UploadedFile::fake()->create('document_test.xml')];
    }

    public function deleteFile($fileName)
    {
        //Delete the file
        Storage::disk('public')->delete('xml/'.$fileName);
    }
}
