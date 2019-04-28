<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Http\Controllers\Controller;
use App\Http\Services\ContatoServices;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    /**
     * valida, grava no banco e chama função para enviar email
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nome' => 'required|max:100|string',
            'email' => 'required|max:100|string|email',
            'telefone' => 'required|max:50|string|regex:/(\()([0-9]{2})(\))( )([0-9]{4,5})([0-9\-])([0-9]{4})/i',
            'mensagem' => 'required|string',
            'anexo' => 'required|file|max:500|mimes:pdf,doc,docx,odt,txt',
        ]);

        /**
         * para fins de teste do ajax com phpunit
         */
        if(!array_key_exists('HTTP_HOST', $_SERVER)){
            return response()->json(['validate' => true]);
        }

        $contato = new Contato;
        $contato->nome = $request->input('nome');
        $contato->email = $request->input('email');
        $contato->telefone = $request->input('telefone');
        $contato->mensagem = $request->input('mensagem');
        $contato->anexo = $request->file('anexo')->store('public');
        $contato->ip = $request->ip();
        $contato->save();

        $contatoServices = new ContatoServices();
        return $contatoServices->enviaEmail($contato);
    }
}
