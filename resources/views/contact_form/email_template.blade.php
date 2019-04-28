<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Nova mensagem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin:0;padding:0;">
    <div style="width:100%;margin: 0; padding: 0;">
        <div style="width:100%;height:200px;background: #49a6e8;margin:0;padding:0;">
            <div style="padding-top:30px;text-align:center;">
                <div style="margin:0 auto;"><img src="<?php echo $message->embed(asset('email_icon.png')); ?>"></div>
                <p style="color:#fafafa;margin:0;">Formulário de contato</p>
                <h1 style="color:#FFF;margin-top:10px;">Você recebeu uma nova mensagem!</h1>
            </div>
        </div>
        <div style="width:100%;background:#fafafa;margin:0;padding:0;">
            <div style="padding:20px;">
                <p><b>Nome:</b> <span style="color:#4c4c4c;">{{ $contato->nome }}</span></p>
                <p><b>Email:</b> <span style="color:#4c4c4c;">{{ $contato->email }}</span></p>
                <p><b>Telefone:</b> <span style="color:#4c4c4c;">{{ $contato->telefone }}</span></p>
                <p><b>IP de envio:</b> <span style="color:#4c4c4c;">{{ $contato->ip }}</span></p>
                <p><b>Horário:</b> <span style="color:#4c4c4c;">{{ date("d/m/Y H:i:s", strtotime($contato->created_at)) }}</a></span></p>
                <p><b>Mensagem:</b> <span style="color:#4c4c4c;">{{ $contato->mensagem }}</span></p>
            </div>
        </div>
        <div style="width:100%;height:50px;background-color:#eaeaea;margin:0;padding:0;">
            <div style="padding:17px;text-align:center;font-size:16px;">
                Notificação gerada a partir do sistema de mensagens em http://{{$_SERVER['HTTP_HOST']}}
            </div>
        </div>
    </div>
</body>

</html>