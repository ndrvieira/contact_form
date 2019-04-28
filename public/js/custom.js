$(document).ready(function() {

    $('[name="telefone"]').inputmask({
        mask: ["(99) 9999-9999", "(99) 99999-9999", ],
        keepStatic: true
    }); //static mask

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Formato inválido."
    );

    toastr.options = {
        positionClass : "toast-top-center"
    }

    $("#form_contato").validate({
        debug: true,
        rules: {
            nome: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            telefone: {
                required: true,
                regex: /(\()([0-9]{2})(\))( )([0-9]{4,5})([0-9\-])([0-9]{4})/gm,
            },
            mensagem: {
                required: true,
            },
            anexo: {
                required: true,
                extension: "pdf|doc|docx|odt|txt",
            },
        },
        messages: {
            nome: {
                required: "O campo nome é obrigatório",
            },
            email: {
                required: "O campo email é obrigatório",
                email: "Formato de email inválido"
            },
            telefone: {
                required: "O campo telefone é obrigatório",
            },
            mensagem: {
                required: "O campo mensagem é obrigatório",
            },
            anexo: {
                required: "É obrigatório enviar um anexo",
                extension: "Extensões permitidas: pdf,doc,docx,odt e txt"
            },
        },
        highlight: function(element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            enviaAjax(form);
        }
    });

    function enviaAjax(form){
        var formData = new FormData(form);
        var action = $(form).attr('action');
        $.ajax({
            url: action,
            type: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            beforeSend: function(){
                $('.spinner-container').show();
            },
            success: function(response) {
                $('.spinner-container').hide();
                let retorno = JSON.parse(response);
                if(retorno.status){
                    toastr.success(retorno.mensagem);
                } else {
                    toastr.error(retorno.mensagem);
                }
            },
            error: function(response) {
                $('.spinner-container').hide();
                if (response.responseJSON) {
                    if(response.responseJSON.message == "Server Error"){
                        toastr.error('Erro no servidor. Entrar em contato com o Administrador.');
                    }
                    $.each(response.responseJSON.errors, function(field, value) {
                        $('[name="' + field + '"]').addClass('is-invalid');
                        $.each(value, function(index, text) {
                            $('[name="' + field + '"]').parent().find('.invalid-feedback').html(text);
                        });
                    });
                }
            }
        });
    }

    $('#validatedCustomFile').on('change',function(){
        // var fileName = $(this).val();
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-label').html(fileName);
    })
});