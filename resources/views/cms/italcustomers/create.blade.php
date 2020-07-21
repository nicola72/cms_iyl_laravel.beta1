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
                                        <input type="text" name="nome" id="nome" class="form-control mb-2" />
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email*</label>
                                        <input type="text" name="email" id="email" class="form-control mb-2" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password*</label>
                                        <input type="text" name="password" id="password" class="form-control mb-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Sconto*</label>
                                        <input type="number" name="sconto" id="sconto" class="form-control mb-2" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tipo Sconto*</label>
                                        <select name="tipo_sconto" id="tipo_sconto" class="form-control mb-2">
                                            <option value="">seleziona</option>
                                            <option value="+">+</option>
                                            <option value="-">-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Tipo Sconto x Importo</label>
                                        <select name="sconto_importo" id="sconto_importo" class="form-control mb-2">
                                            <option value="0">nessuno</option>
                                            <option value="1">tipologia 1</option>
                                            <option value="2">tipologia 2</option>
                                            <option value="3">tipologia 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li>
                                                <b>Tipologia 1:</b><br>
                                                da 4000,00€ a 8000,00€ sconto 4%<br>
                                                da 8000,00€ in su sconto 8%<br>
                                            </li>
                                            <li>
                                                <b>Tipologia 2:</b><br>
                                                da 1500,00€ a 3000,00€ sconto 3%<br>
                                                da 3000,00€ a 5000,00€ sconto 5%<br>
                                                da 5000,00€ in su sconto 8%<br>

                                            </li>
                                            <li>
                                                <b>Tipologia 3:</b><br>
                                                da 2500,00€ a  5000,00€ sconto 10%<br>
                                                da 5000,00€ a  7500,00€ sconto 15%<br>
                                                da 7500,00€ a 10000,00€ sconto 20%<br>
                                                da 10000,00€ a 15000,00€ sconto 22%<br>
                                                da 15000,00€ in su sconto 25%<br>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="d-block">Condizioni cliente</label>
                                        <textarea id="condizioni_cliente" style="min-height: 100px;" name="condizioni_cliente" class="form-control mb-2"  ></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-block">Condizioni pagamento</label>
                                        <textarea id="condizioni_pagamento" style="min-height: 100px;" name="condizioni_pagamento" class="form-control mb-2"  ></textarea>
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
                    type: "POST",
                    url: "{{url('cms/italcustomers')}}",
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
