@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">

                        <!-- CREA PDF -->
                        <a href="{{url('cms/ital_order/pdf',$order->id)}}" class="btn btn-w-m btn-primary">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                        <!-- fine pulsante nuovo -->

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content ">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <b>Data:</b><br>
                                {{$order->created_at->format('d/m/Y')}}
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <b>Sconto</b>: @money($order->sconto)<br>
                            </div>
                        </div>
                        <div class="row mb-2">

                            <div class="col-md-4">
                                <b>Imponibile</b>: @money($order->imponibile)<br>
                            </div>
                            <div class="col-md-4">
                                <b>Iva</b>: @money($order->iva)<br>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h3>IMPORTO: @money($order->importo)</h3>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h2>Prodotti ordinati</h2>
                            </div>
                        </div>
                        @foreach($order->orderDetails as $detail)
                            <div class="row mb-4">
                                <div class="col-md-1">
                                    <b>Q.tà</b>:{{$detail->qta}}
                                </div>
                                <div class="col-md-5">

                                    <b>Codice</b>:{{$detail->codice}}
                                    {{$detail->nome_prodotto}}

                                </div>
                                <div class="col-md-3">
                                    <b>prezzo</b>: @money($detail->prezzo)
                                </div>
                                <div class="col-md-3">
                                    <b>tot.</b>: @money($detail->totale)
                                </div>
                            </div>
                        @endforeach

                        @if($order->user_id != '')
                            <div class="row mb-2 mt-2">
                                <div class="col-md-12">
                                    <h2>Cliente</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Nome</b>: {{$order->user->name}}
                                </div>
                                <div class="col-md-4">
                                    <b>Email</b>: {{$order->user->email}}
                                </div>
                            </div>
                        @endif
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
