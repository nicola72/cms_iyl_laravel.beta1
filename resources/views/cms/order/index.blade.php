@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content ">
                        <table id="table-orders" style="font-size:12px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th data-orderable="false">Data</th>
                                <th>Pagam.</th>
                                <th>Pagato</th>
                                <th>IdTrans</th>
                                <th>Tot.</th>
                                <th>Lingua</th>
                                <th>Utente</th>
                                <th data-orderable="false">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->created_at->format('d/m/Y')}}</td>
                                    <td>{{$order->modalita_pagamento}}</td>
                                    <td>
                                        @if($order->stato_pagamento)
                                            si
                                        @else
                                            no
                                        @endif
                                    </td>
                                    <td>{{$order->idtranspag}}</td>
                                    <td>@money($order->importo)</td>
                                    <td>{{$order->locale}}</td>
                                    <td>
                                        @if($order->user_id != '')
                                            {{$order->user->name}} {{$order->user->surname}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('cms/order/order',$order->id)}}">
                                            <i class="fa fa-search"></i>
                                        </a>
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
            $('#table-orders').DataTable({
                responsive: true,
                pageLength: 100,
                order: [[ 0, "desc" ]], //order in base a order
                language:{ "url": "/cms_assets/js/plugins/dataTables/dataTable.ita.lang.json" }
            });

        });
    </script>
@stop
