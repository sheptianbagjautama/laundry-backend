@extends('layouts.main')

@section('links')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert/sweetalert2.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                    <h3 class="card-title">Data Akun Pengguna</h3>

                    <div class="card-tools">
                        <a class="btn btn-secondary" href="javascript:void(0)" id="createNewUser">
                            Tambah Data Akun Pengguna
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
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
                            <h4 class="modal-title" id="modealHeading">Tambah Data Akun Pengguna</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="userForm" name="userForm" class="form-horizontal">
                            <div class="modal-body">

                                <input type="hidden" name="user_id" id="user_id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan nama" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Masukan email" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Kata Sandi</label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukan kata sandi" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-6 control-label">Jenis Pengguna</label>
                                    <div class="col-sm-12">
                                        <select id='select-type' class="form-control select2" style="width: 100%;"
                                            name="type">
                                            <option value='' disabled selected>Pilih Jenis Pengguna</option>
                                            <option value='0'>User</option>
                                            <option value='1'>Admin</option>
                                            <option value='2'>Manager</option>
                                        </select>
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
    <!-- InputMask -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>


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
                ajax: "{{ route('users.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });



            //CREATE BUTTON
            $('#createNewUser').click(function() {

                // $('#select-type').select2();
                $('#select-type').select2({
                    theme: 'bootstrap4'
                })

                $('#saveBtn').val("create-user");

                $('#user_id').val("");
                $('#modealHeading').html("Membuat Akun Pengguna Baru");
                $('#userForm').trigger("reset");
                $('#ajaxModel').modal("show");

            })

            //EDIT BUTTON
            $('body').on('click', '.editUser', function() {
                var user_id = $(this).data('id');

                $.get("{{ route('users.index') }}" + '/' + user_id + '/edit', function(data) {
                    console.log('data edit => ', data)
                    $('#modealHeading').html("Mengubah Akun Pengguna");
                    $('#saveBtn').val("edit-group");
                    $('#ajaxModel').modal('show');

                    $('#user_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#password').val(data.password);
                    $('#type').val(data.type);
                })
            })



            //ACTION CREATE OR UPDATE
            $.validator.setDefaults({
                submitHandler: function() {
                    console.log('request data => ', $('#userForm').serialize())
                    $.ajax({
                        data: $('#userForm').serialize(),
                        url: "{{ route('users.store') }}",
                        type: "POST",
                        dataType: "json",
                        success: function(data) {
                            console.log('response data => ', data)
                            $('#userForm').trigger("reset");
                            $('#ajaxModel').modal('hide');


                            let isCreate = $('#userForm').serialize();

                            if (isCreate.includes('user_id=&')) {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil menyimpan akun pengguna',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil mengubah akun pengguna',
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
                }
            });

            //VALIDATE
            $('#userForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Silahkan masukan nama",
                    },
                    email: {
                        required: "Silahkan masukan email",
                    },
                    type: {
                        required: "Silahkan masukan jenis akun pengguna",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


            //DELETE BUTTON
            $('body').on('click', '.deleteUser', function() {

                Swal.fire({
                    title: 'Anda yakin ?',
                    text: 'Data akun pengguna ini akan dihapus jika menekan tombol hapus',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Kembali',
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: "#dc3545",
                }).then((result) => {
                    if (result.isConfirmed) {

                        var user_id = $(this).data("id");

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('users.store') }}" + '/' + user_id,
                            success: function(data) {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil menghapus akun pengguna',
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
