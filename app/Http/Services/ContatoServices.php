<?php

namespace App\Http\Services;

use App\Models\Contato;
use Illuminate\Http\Request;
use Mail;

class ContatoServices
{
    /**
     * Realiza o envio de emails
     * 
     * @return json
     */
    public function enviaEmail(Contato $contato)
    {
        $app = getenv('MAIL_NAME');
        $email = getenv('MAIL_ADDR');
        $assunto = getenv('MAIL_SUBJECT');

        Mail::send('contact_form.email_template', ['contato' => $contato], function ($m) use ($contato, $email, $assunto, $app) {
            $m->from($email, $app);
            $m->to($contato->email, $contato->nome)->subject($assunto);
            $m->attach(storage_path("app/".$contato->anexo));
        });

        if(count(Mail::failures()) > 0){
            return json_encode(['status' => false, 'mensagem' => 'Erro. Falha ao enviar a mensagem, tente novamente mais tarde.']);
        } else {
            return json_encode(['status' => true, 'mensagem' => 'A mensagem foi enviada com sucesso!']);
        }
    }
}
