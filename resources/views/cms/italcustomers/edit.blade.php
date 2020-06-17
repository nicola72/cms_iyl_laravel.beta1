@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">

                        <!-- Indietro -->
                        <a href="{{url('cms/italcustomers')}}" class="btn btn-w-m btn-primary">Clienti Italfama</a>
                        <!-- fine pulsante nuovo -->

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content">
                        <form action="" method="POST" id="{{ $form_name }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nome*</label>
                                        <input type="text" name="nome" id="nome" value="{{$customer->name}}" class="form-control mb-2" />
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email*</label>
                                        <input type="text" name="email" id="email" value="{{$customer->email}}" class="form-control mb-2" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password*</label>
                                        <input type="text" name="password" id="password" value="{{$customer->clear_pwd}}" class="form-control mb-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Sconto*</label>
                                        <input type="number" name="sconto" id="sconto" value="{{$customer->sconto}}" class="form-control mb-2" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tipo Sconto*</label>
                                        <select name="tipo_sconto" id="tipo_sconto" class="form-control mb-2">
                                            <option value="+" {{($customer->tipo_sconto == '+') ? 'selected' : ''}}>+</option>
                                            <option value="-" {{($customer->tipo_sconto == '-') ? 'selected' : ''}}>-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="d-block">Condizioni cliente</label>
                                        <textarea id="condizioni_cliente" style="min-height: 100px;" name="condizioni_cliente" class="form-control mb-2"  >{{$customer->condizioni_cliente}}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block">Condizioni pagamento</label>
                                        <textarea id="condizioni_pagamento" style="min-height: 100px;" name="condizioni_pagamento" class="form-control mb-2"  >{{$customer->condizioni_pagamento}}</textarea>
                                    </div>
                                </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_script')
    <script>
        $("#{{$form_name}}").validate({
            rules: {

                nome:{required:true},
                email:{required:true,email:true},
                password:{required:true},
                sconto:{required:true},
                tipo_sconto:{required:true},
            },
            messages: {
                nome:{required:'Questo campo è obbligatorio'},
                email:{required:'Questo campo è obbligatorio',email:'Inserisci un\'email valida'},
                password:{required:'Questo campo è obbligatorio'},
                sconto:{required:'Questo campo è obbligatorio'},
                tipo_sconto:{required:'Questo campo è obbligatorio'},
            },
            submitHandler: function (form)
            {
                $.ajax({
                    type: "PUT",
                    url: "{{route('italcustomers.update',[$customer->id])}}",
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
@endsection