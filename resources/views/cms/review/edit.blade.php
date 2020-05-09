<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modifica Recensione</h4>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="{{ $form_name }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="d-block">
                        Nome*
                    </label>
                    <input type="text" name="nome" id="nome" value="{{$review->nome}}" class="form-control mb-2" />
                </div>
                <div class="form-group">
                    <label class="d-block">
                        Data evento
                    </label>
                    <input type="text" name="data_evento" id="data_evento" value="{{$review->data_evento}}" class="form-control mb-2" />
                </div>
                <div class="form-group">
                    <label class="d-block">
                        Messaggio*
                    </label>
                    <textarea id="messaggio" style="min-height: 100px;" name="messaggio" class="form-control summernote mb-2"  >{{$review->messaggio}}</textarea>
                </div>
                <div class="form-group">
                    <span>* campi obbligatori</span>
                    <br><br>
                    <button class="btn btn-primary btn-lg w-100" type="submit">
                        <i class="fa fa-dot-circle-o"></i> SALVA
                    </button>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
        </div>
    </div>

</div>
<script>
    //per l'editor delle textarea
    $(document).ready(function(){$('.summernote').summernote({height:100});});

    $("#{{$form_name}}").validate({
        rules: {
            nome:{required:true},
            messaggio:{required:true},
        },
        messages: {
            nome:{required:'Questo campo è obbligatorio'},
            messaggio:{required:'Questo campo è obbligatorio'},
        },
        submitHandler: function (form)
        {
            $.ajax({
                type: "PUT",
                url: "{{route('review.update',[$review->id])}}",
                data: $("#{{$form_name}}").serialize(),
                dataType: "json",
                success: function (data)
                {
                    if (data.result === 1)
                    {
                        alert(data.msg);
                        $(location).attr('href', data.url);
                    }
                    else{ alert( data.msg ); }
                },
                error: function (){ alert("Si è verificato un errore! Riprova!"); }
            });
        }
    });
</script>