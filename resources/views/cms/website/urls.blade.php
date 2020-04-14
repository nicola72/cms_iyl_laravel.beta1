@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">

                        <!-- Nuovo Dominio -->
                        <a href="javascript:void(0)" onclick="get_modal('{{url("cms/website/create_page")}}')" class="btn btn-w-m btn-primary">Nuovo</a>
                        <!-- fine pulsante nuovo -->

                        <!-- indietro -->
                        <a href="{{url("cms/website")}}" class="btn btn-w-m btn-primary">Indietro</a>
                        <!-- -->

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content">
                        <table id="table-urls" style="font-size:12px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Completa</th>
                                <th>Dominio</th>
                                <th>Locale</th>
                                <th>Slug</th>
                                <th>Tipo</th>
                                <th>Id</th>
                                <th>Nome Tipo</th>
                                <th data-orderable="false">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urls as $url)
                                <tr>
                                    <td>www.{{$url->domain->nome}}/{{$url->locale}}/{{$url->slug}}</td>
                                    <td>{{$url->domain->nome}}</td>
                                    <td>{{$url->locale}}</td>
                                    <td>{{$url->slug}}</td>
                                    <td>{{$url->urlable_type}}</td>
                                    <td>{{$url->urlable->id}}</td>
                                    <td>
                                        @if(isset($url->urlable->nome))
                                            {{$url->urlable->nome}}
                                        @else
                                            {{$url->urlable->nome_it}}
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Pulsante per modificare -->
                                        <a class="azioni-table" onclick="get_modal('{{url('/cms/website/edit_url',[$url->id])}}')"  href="javascript:void(0)">
                                            <i class="fa fa-edit fa-2x"></i>
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
            $('#table-urls').DataTable({
                responsive: true,
                pageLength: 100,
                language:{ "url": "/cms_assets/js/plugins/dataTables/dataTable.ita.lang.json" }
            });

        });
    </script>
@stop
