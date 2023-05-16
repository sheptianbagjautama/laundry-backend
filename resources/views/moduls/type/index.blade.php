@extends('layouts.main')

@section('links')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert/sweetalert2.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Tipe</h3>

                    <div class="card-tools">
                        <a class="btn btn-secondary" href="javascript:void(0)" id="createNew">
                            Tambah Data Tipe
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.card -->


            <div class="modal fade" id="ajaxModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading">Tambah Data Grup</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="typeForm" name="typeForm" class="form-horizontal">
                            <div class="modal-body">

                                <input type="hidden" name="type_id" id="type_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan nama tipe" />
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                <button type="submit" id="saveBtn" class="btn btn-success" value="create">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <!-- SweetAlert2 -->
    <script src="{{ asset('lte/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }} "></script>


    <script type="text/javascript">
        $(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('types.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });


            /*------------------------------------------
                --------------------------------------------
                Click to Button
                --------------------------------------------
                --------------------------------------------*/
            $('#createNew').click(function() {
                // $(this).html('Simpan');
                $('#saveBtn').val("create-type");
                $('#type_id').val("");
                $('#modelHeading').html("Membuat Tipe Baru");
                $('#typeForm').trigger("reset");
                $('#ajaxModel').modal("show");

            })

            /*------------------------------------------
                --------------------------------------------
                Click to Edit Button
                --------------------------------------------
                --------------------------------------------*/
            $('body').on('click', '.editType', function() {
                var type_id = $(this).data('id');
                console.log('type id => ', type_id)
                $.get("{{ route('types.index') }}" + '/' + type_id + '/edit', function(data) {
                    $('#modelHeading').html("Mengubah Tipe");
                    $('#saveBtn').val("edit-type");
                    $('#ajaxModel').modal('show');
                    $('#type_id').val(data.id);
                    $('#name').val(data.name);
                })
            })



            /*------------------------------------------
                --------------------------------------------
                Create Code
                --------------------------------------------
                --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                // $(this).html('Mengirim..');

                console.log($('#typeForm').serialize());

                $.ajax({
                    data: $('#typeForm').serialize(),
                    url: "{{ route('types.store') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        $('#typeForm').trigger("reset");
                        $('#ajaxModel').modal('hide');


                        let isCreate = $('#typeForm').serialize();
                        console.log("isCreate : ", isCreate)

                        if (isCreate.includes('type_id=&')) {
                            console.log('create')
                            Swal.fire(
                                'Sukses!',
                                'Berhasil menyimpan tipe',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Sukses!',
                                'Berhasil mengubah tipe',
                                'success'
                            )
                        }



                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error: ', data);
                        $('#saveBtn').html("Simpan Perubahan");
                    }
                });
            });


            /*------------------------------------------
                --------------------------------------------
                Delete Code
                --------------------------------------------
                --------------------------------------------*/
            $('body').on('click', '.deleteType', function() {

                Swal.fire({
                    title: 'Anda yakin ?',
                    text: 'Data tipe ini akan dihapus jika menekan tombol hapus',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Kembali',
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: "#dc3545",
                }).then((result) => {
                    if (result.isConfirmed) {

                        var type_id = $(this).data("id");

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('types.store') }}" + '/' + type_id,
                            success: function(data) {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil menghapus grup',
                                    'success'
                                )
                                table.draw();
                            },
                            error: function(data) {
                                console.log('Error: ', data);
                            }
                        })
                    }
                })


            })



        });
    </script>
@endsection
