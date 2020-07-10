<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Nuovo Coupon</h4>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="{{ $form_name }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Codice</label>
                    <input type="text" name="codice" id="codice" class="form-control mb-2" />
                </div>
                <div class="form-group">
                    <label>Per</label>
                    <select name="user_id" id="user_id" class="form-control mb-2">
                        <option value="0">tutti</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="tipo" id="tipo" class="form-control mb-2">
                        <option value="1">fisso</option>
                        <option value="2">percentuale</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sconto</label>
                    <input type="text" name="sconto" id="sconto" class="form-control mb-2" />
                </div>
                <div  class="form-group" >
                    <label>Valido da</label>
                    <input id="data_1" type="text" name="valido_da" id="valido_da" class="form-control mb-2" >
                </div>
                <div class="form-group">
                    <label>Valido fino a</label>
                    <input id="data_2" type="text" name="valido_fino_a" id="valido_fino_a" class="form-control mb-2" />
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
    $('#data_1').datepicker({
        format: "dd-mm-yyyy"
    });

    $('#data_2').datepicker({
        format: "dd-mm-yyyy"
    });

    $("#{{$form_name}}").validate({
        rules: {
            codice:{required:true},
            sconto:{required:true},
        },
        messages: {
            codice:{required:'Questo campo è obbligatorio'},
            sconto:{required:'Questo campo è obbligatorio'},
        },
        submitHandler: function (form)
        {
            $.ajax({
                type: "POST",
                url: "{{url('cms/coupons')}}",
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
