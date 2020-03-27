<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testDocumentUpload()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/document', [
            'file' => $file,
        ]);

        // Assert the file was stored...
        Storage::disk('public')->assertExists($file->hashName());

        // Assert a file does not exist...
        Storage::disk('public')->assertMissing('missing.jpg');
        
        $this->assertCount(1, Document::all());
    }

}