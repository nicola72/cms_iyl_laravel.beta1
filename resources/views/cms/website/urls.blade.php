@extends('layouts.cms')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    <!-- header del box -->
                    <div class="ibox-title">
                        <!-- Pagine -->
                        <a href="{{url('cms/website/pages')}}" class="btn btn-w-m btn-primary">Pagine</a>
                        <!-- -->

                        <!-- urls solo pagine -->
                        <a href="{{url('cms/website/urls',['type' => 'App\Model\Page'])}}" class="btn btn-w-m btn-primary">Urls Pagine</a>
                        <!-- -->

                        <!-- urls solo macrocategorie -->
                        <a href="{{url('cms/website/urls',['type' => 'App\Model\Macrocategory'])}}" class="btn btn-w-m btn-primary">Urls Macro</a>
                        <!-- -->

                        <!-- urls solo categorie -->
                        <a href="{{url('cms/website/urls',['type' => 'App\Model\Category'])}}" class="btn btn-w-m btn-primary">Urls Categorie</a>
                        <!-- -->

                        <!-- urls solo prodotto -->
                        <a href="{{url('cms/website/urls',['type' => 'App\Model\Product'])}}" class="btn btn-w-m btn-primary">Urls Prodotto</a>
                        <!-- -->

                        <!-- urls solo abbinamenti -->
                        <a href="{{url('cms/website/urls',['type' => 'App\Model\Pairing'])}}" class="btn btn-w-m btn-primary">Urls Abbinamenti</a>
                        <!-- -->

                        <!-- indietro -->
                        <a href="{{url("cms/website")}}" class="btn btn-w-m btn-primary">Indietro</a>
                        <!-- -->

                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <!-- fine header -->

                    <div class="ibox-content">
                        Le urls vengono generate automaticamente alla creazione di un prodotto, abbinamento, macrocategoria, categoria o pagina.<br>
                        Dal pannello possono essere eventualmente solo modificate.<br>
                        Macrocategorie: <em>it/nome_macro_it p en/nome_macro_ing</em><br>
                        Categorie: <em>it/nome_macro_it-macro_id-categoria_id o en/nome_macro_en-macro_id-categoria_id</em><br>
                        Prodotti: <em>it/dettaglio-id_prodotto o en/details-id_prodotto</em><br>
                        Abbinamenti: <em>it/dettaglio_abbinamento-id_abbinamento o en/pairing_detail-id_abbinamento</em><br>
                        Pagine: <em>it/nome_pagina o en/nome_pagina</em><br>
                        Le url possono essere associate al seo o singolarmente o per tipo

                    </div>

                    <div class="ibox-content">
                        <table id="table-urls" style="font-size:12px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nome Tipo</th>
                                <th>Completa</th>
                                <th>Dominio</th>
                                <th>Locale</th>
                                <th>Slug</th>
                                <th>Tipo</th>
                                <th>Id</th>
                                <th>Seo</th>
                                <th data-orderable="false">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($urls as $url)
                                <tr>
                                    <td>
                                        @if(isset($url->urlable->nome))
                                            {{$url->urlable->nome}}
                                        @else
                                            {{$url->urlable->nome_it}}
                                        @endif
                                    </td>
                                    <td>www.{{$url->domain->nome}}/{{$url->locale}}/{{$url->slug}}</td>
                                    <td>{{$url->domain->nome}}</td>
                                    <td>{{$url->locale}}</td>
                                    <td>{{$url->slug}}</td>
                                    <td>{{$url->urlable_type}}</td>
                                    <td>{{$url->urlable->id}}</td>

                                    <td>
                                        @if($url->seo_id == null)
                                            no
                                        @else
                                            <a href="javascript:void(0)" onclick="gat_modal('{{url('cms/seo/show',$url->seo_id)}}')">
                                                <i class="fa fa-file"></i>
                                            </a>
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
                order: [[ 0, "asc" ]], //order in base a order
                language:{ "url": "/cms_assets/js/plugins/dataTables/dataTable.ita.lang.json" }
            });

        });
    </script>
@stop
