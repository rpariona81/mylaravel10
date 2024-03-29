@extends('layouts.main')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <!-- <div class="row">
                                                                              <div class="col-12">
                                                                               <div class="page-title-box">
                                                                                <div class="page-title-right">
                                                                                 <ol class="m-0 breadcrumb">
                                                                                  <li class="breadcrumb-item"><a href="javascript: void(0);">Uplon</a></li>
                                                                                  <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                                                                  <li class="breadcrumb-item active">Data Tables</li>
                                                                                 </ol>
                                                                                </div>
                                                                                <h4 class="page-title">Control de usuarios</h4>
                                                                               </div>
                                                                              </div>
                                                                             </div> -->
        <!-- <div class="row mt-3">
                                                                              <div class="col-12">
                                                                               <div class="card-header bg-light border">
                                                                                <h4 class="page-title">Control de usuarios</h4>
                                                                               </div>
                                                                              </div>
                                                                             </div> -->
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-header bg-light border mt-3">
                    <h4 class="page-title">Control de usuarios</h4>
                </div>
                <div class="card-box">

                    <form action="" method="POST" class="form-horizontal" onsubmit="window.location.reload()">
                        @csrf
                        <div class="col-md-9 col-lg-9 mx-auto">
                            <div class="mb-3">
                                <div class="input-group mb-1">
                                    <select id="role_select" class="form-control" name="role_select">
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $key }}">
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    &nbsp;
                                    <select id="status_select" class="form-control" name="status_select">
                                        @foreach ($condiciones as $key => $condicion)
                                            <option value="{{ $key }}">
                                                {{ $condicion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    &nbsp;
                                    <button class="btn btn-info pull-right font-weight-medium mb-0" type="submit">
                                        <i class="fa fa-search"></i>&nbsp;Filtrar
                                    </button>
                                    &nbsp;
                                    <a class="btn btn-danger" href="{{ route('admin.users') }}">Limpiar filtro</a>
                                    &nbsp;
                                    <a class="btn waves-effect waves-light btn-success pull-right hidden-sm-down"
                                        data-toggle="tooltip" href={{ route('admin.users.create') }}>Nuevo
                                        usuario&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="p-0 table-responsive">
                        <table id="datatable-buttons" class="table table-hover table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <!--<thead class="bg-primary text-white">-->
                            <thead>
                                <tr>
                                    <!--<th colspan="8" class="heading"><span style="float: right"></span></th>-->
                                    <th colspan="8" class="heading"></th>
                                </tr>
                                <tr class="table-info">
                                    <!--<th class="font-weight-bold">Id</th>-->
                                    <th class="font-weight-bold">#</th>
                                    <th class="font-weight-bold">Usuario</th>
                                    <th class="font-weight-bold">Email</th>
                                    <th class="font-weight-bold">Rol</th>
                                    <th class="font-weight-bold">Celular</th>
                                    <th class="font-weight-bold">Condición</th>
                                    <th class="font-weight-bold">Email</th>
                                    <th class="font-weight-bold">Última modif.</th>
                                    <th class="font-weight-bold">Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($records as $key => $item)
                                    <tr class="align-middle">
                                        <!--<td>< ?= str_pad($item->id, 5, '0', STR_PAD_LEFT); ?></td>-->
                                        <td>{{ $item->row }}</td>
                                        <td>{{ $item->display_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->rolename }}</td>
                                        <td class="text-center">
                                            {{ $item->mobile }}</td>
                                        <td class="text-center"> @if ($item->status)
                                            <span class="text-white border badge bg-info">{{ $item->userflag }}</span>
                                        @else
                                            <span class="text-white border badge bg-secondary">{{ $item->userflag }}</span>
                                        @endif</td>
                                        <td class="text-center">{{ $item->email }}</td>
                                        <td>
                                            {{ $item->updated_at ? $item->updated_at->diffForHumans() : ($item->updated_at_role ? $item->updated_at_role->diffForHumans() : null) }}
                                        </td>
                                        <td class="text-center">

                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if ($item->lock == 1)
                                                @else
                                                    @if ($item->status)
                                                        <a href="{{ route('admin.users.banUnban', ['id' => $item->id, 'status' => 0]) }}"
                                                            class="btn btn-outline-danger btn-sm display-inline" data-toggle="tooltip" data-placement="bottom" title="Desactivar"><i class="fa fa-eye-slash"></i></a>
                                                            &nbsp;
                                                        <a class="btn btn-outline-warning btn-sm" data-toggle="tooltip"
                                                            data-placement="bottom" title="Editar"
                                                            href="{{ route('admin.users.edit', ['id' => $item->id]) }}"><i
                                                                class="fa fa-edit"></i></a>
                                                    @else
                                                        <a href="{{ route('admin.users.banUnban', ['id' => $item->id, 'status' => 1]) }}"
                                                            class="btn btn-outline-success btn-sm display-inline" data-toggle="tooltip" data-placement="bottom" title="Activar"><i class="fa fa-eye"></i></a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- end container-fluid -->


    <!--<script>
        $(document).ready(function() {
            //$.noConflict();

            /**https://datatables.net/forums/discussion/43723/how-can-i-remove-default-button-class-of-datatable-btn-default */
            //$.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-md btn-outline-dark border-0';
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-md btn-dark border-0';
            /**https://datatables.net/forums/discussion/61263/how-to-add-class-to-paginate-button*/
            /*$.fn.dataTable.ext.classes.sLengthSelect = 'btn btn-flat btn-sm btn-dark border-0';
            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
            	className: 'btn btn-md btn-dark border-0'
            })*/

            $('#datatable-buttons').DataTable({
                pageLength: 5,
                order: [],
                //responsive: true,
                //scrollX: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
                    paginate: {
                        previous: '<i class="fa fa-chevron-right"></i>', // "<<",
                        next: '<i class="fa fa-chevron-right"></i>', // ">>",
                        first: "<",
                        last: ">"
                    },
                },
                dom: 'Bfrtip',
                buttons: ['copy', 'pdf',
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            //Para ver los estilos de formato https://datatables.net/reference/button/excelHtml5
                            $('row c[r^="B"]', sheet).attr('s', '57');
                            //Para que la columna se muestre como texto https://datatables.net/forums/discussion/73814/export-to-excel-with-format-text-for-column-b-c-and-d
                            $('row c[r^="D"]', sheet).attr('s', '50');
                        }
                    }
                ]
            });
        });
    </script>-->

    <!-- <script>
        $(document).ready(function() {
            $("#btn-notification").click(function() {
                $('.toast').toast('show');
                console.log('toastttt');
            });
        });
    </script> -->

    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            //< ?php if ($this->session->flashdata('success')) { ?>
            //$('.toast').toast('show');
            //toastr.success("< ?= $this->session->flashdata('success') ?>");
            //console.log("< ?= $this->session->flashdata('success') ?>");
            //< ?php } else if ($this->session->flashdata('error')) {  ?>
            //toastr.error("< ?= $this->session->flashdata('error') ?>");
            //< ?php } ?>
        });
    </script>

    <script>
        //document.addEventListener("DOMContentLoaded", function() {
        // Datatables Responsive
        // https://datatables.net/reference/button/excelHtml5

        //https://www.youtube.com/watch?v=j59H9xnyCBs
        $(document).ready(function() {
            /**https://datatables.net/forums/discussion/43723/how-can-i-remove-default-button-class-of-datatable-btn-default */
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-md btn-dark border-0';
            var mytable = $("#datatable-buttons").DataTable({
                deferRender: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                scrollH: true,
                scrollX: true,
                order: [],
                //stateSave: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    paginate: {
                        previous: "<<",
                        next: ">>",
                        first: "<",
                        last: ">"
                    },
                }
            });

            new $.fn.dataTable.Buttons(mytable, {
                buttons: [
                    'copy', 'pdf',
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            //Para ver los estilos de formato https://datatables.net/reference/button/excelHtml5
                            $('row c[r^="B"]', sheet).attr('s', '57');
                            //Para que la columna se muestre como texto https://datatables.net/forums/discussion/73814/export-to-excel-with-format-text-for-column-b-c-and-d
                            $('row c[r^="C"]', sheet).attr('s', '50');
                        }
                    }
                ]
            });

            mytable.buttons().container().appendTo($('tr th.heading', mytable.table().container()));

        });
    </script>
@endsection
