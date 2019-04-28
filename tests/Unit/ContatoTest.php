<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Contato;

class ContatoTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testContatoModel()
    {
        $contato = new Contato;
        $contato->nome = 'Nome Teste';
        $contato->email = 'teste@email.com';
        $contato->telefone = '(11) 1111-1111';
        $contato->mensagem = 'Mensagem de teste';
        $contato->anexo = 'link/link.png';
        $contato->ip = '127.0.0.1';
        $contato->save();
        
        $this->assertEquals('Nome Teste', $contato->nome);
        $this->assertEquals('teste@email.com', $contato->email);
        $this->assertEquals('(11) 1111-1111', $contato->telefone);
        $this->assertEquals('Mensagem de teste', $contato->mensagem);
        $this->assertEquals('link/link.png', $contato->anexo);
        $this->assertEquals('127.0.0.1', $contato->ip);
    }
}
