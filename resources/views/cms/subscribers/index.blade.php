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

                    <div class="ibox-content">
                        <table id="table-iscritti" style="font-size:12px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Lingua</th>
                                <th data-orderable="false">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($iscritti as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->email}}</td>

                                    <td>{{$item->lang}}</td>

                                    <td data-orderable="false">

                                        <!-- pulsante per eliminare -->
                                        <a class="azioni-table azione-red elimina pl-1"  href="{{url('/cms/newsletter_subscribers/destroy',[$item->id])}}" title="elimina">
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
            $('#table-iscritti').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':not(:last-child)', //per rimuovere il campo azioni vedere https://datatables.net/forums/discussion/30504/exclude-column-from-export-by-using-html5-buttons
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':not(:last-child)', //per rimuovere il campo azioni vedere https://datatables.net/forums/discussion/30504/exclude-column-from-export-by-using-html5-buttons
                        }
                    }

                ],
                responsive: true,
                pageLength: 100,
                language:{ "url": "/cms_assets/js/plugins/dataTables/dataTable.ita.lang.json" }
            });

        });

    </script>
@stop
