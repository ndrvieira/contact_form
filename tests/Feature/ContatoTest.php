<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Validator;

class ContatoTest extends TestCase
{
    /**
     * Url principal.
     *
     * @return void
     */
    public function testUrl()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Ajax erro - email errado.
     */
    public function testAjaxErrorWrongEmail()
    {
        $response = $this->post('/contato', [
            'nome' => 'Andre',
            'email' => 'wrongemail',
            'telefone' => '(11) 1111-1111',
            'mensagem' => 'minha mensagem',
            'anexo' => UploadedFile::fake()->image('anexo.txt'),
        ])->assertStatus(302);
    }
    /**
     * Ajax erro - telefone errado.
     */
    public function testAjaxErrorWrongPhone()
    {
        $response = $this->post('/contato', [
            'nome' => 'Andre',
            'email' => 'teste@teste.com',
            'telefone' => '(11)1111-1',
            'mensagem' => 'minha mensagem',
            'anexo' => UploadedFile::fake()->image('anexo.txt'),
        ])->assertStatus(302);
    }
    /**
     * Ajax erro - anexo errado.
     */
    public function testAjaxErrorWrongFile()
    {
        $response = $this->post('/contato', [
            'nome' => 'Andre',
            'email' => 'teste@teste.com',
            'telefone' => '(11) 1111-1111',
            'mensagem' => 'minha mensagem',
            'anexo' => 'not a file',
        ])->assertStatus(302);
    }

    /**
     * Ajax.
     */
    public function testAjaxOk()
    {
        $response = $this->post('/contato', [
            'nome' => 'Andre',
            'email' => 'andr3_717@hotmail.com',
            'telefone' => '(11) 1111-1111',
            'mensagem' => 'minha mensagem',
            'anexo' => UploadedFile::fake()->image('anexo.txt'),
        ])->assertJson(['validate' => true]);
    }
}
