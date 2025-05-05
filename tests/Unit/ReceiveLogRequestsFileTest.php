<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReceiveLogRequestsFileTest extends TestCase
{
    use RefreshDatabase;
    private string $url = 'http://localhost:80/api/requests/import';

    public function test_expected_file_is_required(): void
    {
       $file = '';

       $response = $this->postJson($this->url, ['file' => $file]);
       $response->assertStatus(422)
       ->assertJsonFragment([
            'message' => 'The file field is required.',
       ]);
    }

    public function test_expected_type_file_required(): void
    {
       $file = 'Teste de Texto';

       $response = $this->postJson($this->url, ['file' => $file]);
       $response->assertStatus(422)
       ->assertJsonFragment([
            'message' => 'The file field must be a file.',
       ]);
    }

    public function test_expected_mimeType_text_plain_file(): void
    {
       $file = UploadedFile::fake()->create('logs_test.img', 100);

       $response = $this->postJson($this->url, ['file' => $file]);
       $response->assertStatus(422)
       ->assertJsonFragment([
            'message' => 'mimteType is not text/plain',
       ]);
    }

    public function test_import_file_success(): void
    {
       $path = Storage::disk('public')->path('logs_test.txt');

       $file = new UploadedFile(
        $path,
        'logs_test.txt',
        'text/plain',
        null,
        true
    );

       $response = $this->postJson($this->url, ['file' => $file], [
        'Content-Type' => 'multpart/form-data'
       ]);

       $response->assertStatus(200)
       ->assertJsonFragment([
        'message' => 'Processing...'
       ]);
    }
}
