@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">

                        <!-- NUOVO COUPON -->
                        <a href="javascript:void(0)" onclick="get_modal('{{url('cms/coupons/create')}}')" class="btn btn-w-m btn-primary">Aggiungi</a>
                        <!-- fine pulsante nuovo -->

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content">
                        <table id="table-coupons" style="font-size:12px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Per</th>
                                <th>Tipo</th>
                                <th>Sconto</th>
                                <th>Utilizzato</th>
                                <th>Data Utilizzo</th>
                                <th>Valido da</th>
                                <th>Valido fino a</th>
                                <th data-orderable="false">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $item)
                                <tr>
                                    <td>{{ $item->codice }}</td>
                                    <td>{{ ($item->user_id == 0) ? 'tutti' : $item->user->name}}</td>
                                    <td>{{ ($item->tipo_sconto == 1) ? 'fisso' : 'percentuale' }}</td>
                                    <td>{{ $item->sconto }}</td>
                                    <td>{{ ($item->utilizzato == 1) ? 'si' : '' }}</td>
                                    <td>{{ ($item->data_utilizzo != '') ? $item->data_utilizzo->format('d/m/Y') : '' }}</td>
                                    <td>{{ ($item->valido_da != '') ? $item->valido_da->format('d/m/Y') : '' }}</td>
                                    <td>{{ ($item->valido_fino_a != '') ? $item->valido_fino_a->format('d/m/Y') : '' }}</td>

                                    <td data-orderable="false">
                                        <!-- Pulsante per modificare -->
                                        <a class="azioni-table" onclick="get_modal('{{ route('coupons.edit',['id'=>$item->id]) }}')"  href="javascript:void(0)">
                                            <i class="fa fa-edit fa-2x"></i>
                                        </a>
                                        <!-- -->

                                        <!-- pulsante per eliminare -->
                                        <a class="azioni-table azione-red elimina pl-1"  href="{{url('/cms/coupons/destroy',[$item->id])}}">
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
            $('#table-coupons').DataTable({
                responsive: true,
                pageLength: 100,
                order: [[ 4, "asc" ]], //order in base a order
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
    </script>
@stop
