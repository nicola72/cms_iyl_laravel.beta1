@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">

                        <!-- NUOVO -->
                        <a href="{{url('cms/italcustomers/create')}}" class="btn btn-w-m btn-primary">Aggiungi</a>
                        <!-- fine pulsante nuovo -->

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content">
                        <table id="table-products" style="font-size:12px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>P.Fabbrica</th>
                                <th>P.Vendita</th>
                                <th>P.Netto</th>
                                <th>Bon.Banc.</th>
                                <th>Sconto</th>
                                <th>Tipo sc.</th>
                                <th data-orderable="false">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->clear_pwd}}</td>
                                    <td>
                                        <!-- Pulsante Switch visibile Prezzo Fabbrica  -->
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" id="switch_p_fabbrica_{{$customer->id}}"
                                                       data-id="{{$customer->id}}"
                                                       class="onoffswitch-checkbox p_fabbrica-check"
                                                        {{ ($customer->vede_p_fabbrica == 1) ? "checked" : "" }} />
                                                <label class="onoffswitch-label" for="switch_p_fabbrica_{{$customer->id}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- -->
                                    </td>
                                    <td>
                                        <!-- Pulsante Switch visibile Prezzo Vendita  -->
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" id="switch_p_vendita_{{$customer->id}}"
                                                       data-id="{{$customer->id}}"
                                                       class="onoffswitch-checkbox p_vendita-check"
                                                        {{ ($customer->vede_p_vendita == 1) ? "checked" : "" }} />
                                                <label class="onoffswitch-label" for="switch_p_vendita_{{$customer->id}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- -->
                                    </td>
                                    <td>
                                        <!-- Pulsante Switch visibile Prezzo Netto  -->
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" id="switch_p_netto_{{$customer->id}}"
                                                       data-id="{{$customer->id}}"
                                                       class="onoffswitch-checkbox p_netto-check"
                                                        {{ ($customer->vede_p_netto == 1) ? "checked" : "" }} />
                                                <label class="onoffswitch-label" for="switch_p_netto_{{$customer->id}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- -->
                                    </td>
                                    <td>
                                        <!-- Pulsante Switch visibile Sconto Bonifico  -->
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" id="switch_sconto_bonifico_{{$customer->id}}"
                                                       data-id="{{$customer->id}}"
                                                       class="onoffswitch-checkbox sconto_bonifico-check"
                                                        {{ ($customer->vede_sconto_bonifico == 1) ? "checked" : "" }} />
                                                <label class="onoffswitch-label" for="switch_sconto_bonifico_{{$customer->id}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- -->
                                    </td>
                                    <td>{{$customer->sconto}}</td>
                                    <td>{{$customer->tipo_sconto}}</td>


                                    <td data-orderable="false">

                                        <!-- Pulsante per modificare -->
                                        <a class="azioni-table pl-1"  href="{{route('italcustomers.edit',['id'=>$customer->id])}}" title="modifica">
                                            <i class="fa fa-edit fa-2x"></i>
                                        </a>
                                        <!-- -->

                                        <!-- pulsante per eliminare -->
                                        <a class="azioni-table azione-red elimina pl-1"  href="{{url('/cms/italcustomers/destroy',[$customer->id])}}" title="elimina">
                                            <i class="fa fa-trash fa-2x"></i>
                                        </a>
                                        <!-- -->
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_script')
    <script>
        $(document).ready(function ()
        {
            $('#table-products').DataTable({
                responsive: true,
                pageLength: 100,
                order: [[ 0, "desc" ]], //order in base a order
                language:{ "url": "/cms_assets/js/plugins/dataTables/dataTable.ita.lang.json" }
            });

        });

        //Per il Pulsante ELIMINA
        $(document).ready(function()
        {
            $('.elimina').click(function (e)
            {
                e.preventDefault();
                var url = $(this).attr('href');

                swal({
                    title: "Sei sicuro?",
                    text: "Sarà impossibile recuperare il file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sì, elimina!",
                    closeOnConfirm: false
                }, function ()
                {
                    showPreloader();
                    location.href = url;
                });
            });
        });
        //Fine Pulsante ELIMINA

        //Switch per VISIBILITA PREZZO FABBRICA
        $('.p_fabbrica-check').change(function ()
        {
            let stato = $(this).is(':checked') ? "1" : "0";

            $.ajax({
                type: "GET",
                url: "/cms/italcustomers/switch_vede_p_fabbrica",
                data: {id: $(this).attr('data-id'), stato : stato},
                dataType: "json",
                success: function (data){ alert(data.msg);},
                error: function (){ alert("Si è verificato un errore! Riprova!");}
            });
        });
        //Fine

        //Switch per VISIBILITA PREZZO NETTO
        $('.p_netto-check').change(function ()
        {
            let stato = $(this).is(':checked') ? "1" : "0";

            $.ajax({
                type: "GET",
                url: "/cms/italcustomers/switch_vede_p_netto",
                data: {id: $(this).attr('data-id'), stato : stato},
                dataType: "json",
                success: function (data){ alert(data.msg);},
                error: function (){ alert("Si è verificato un errore! Riprova!");}
            });
        });
        //Fine

        //Switch per VISIBILITA PREZZO VENDITA
        $('.p_vendita-check').change(function ()
        {
            let stato = $(this).is(':checked') ? "1" : "0";

            $.ajax({
                type: "GET",
                url: "/cms/italcustomers/switch_vede_p_vendita",
                data: {id: $(this).attr('data-id'), stato : stato},
                dataType: "json",
                success: function (data){ alert(data.msg);},
                error: function (){ alert("Si è verificato un errore! Riprova!");}
            });
        });
        //Fine

        //Switch per VISIBILITA SCONTO BONIFICO
        $('.sconto_bonifico-check').change(function ()
        {
            let stato = $(this).is(':checked') ? "1" : "0";

            $.ajax({
                type: "GET",
                url: "/cms/italcustomers/switch_vede_sconto_bonifico",
                data: {id: $(this).attr('data-id'), stato : stato},
                dataType: "json",
                success: function (data){ alert(data.msg);},
                error: function (){ alert("Si è verificato un errore! Riprova!");}
            });
        });
        //Fine


    </script>
@stop
