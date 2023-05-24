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
                    <h3 class="card-title">Data Sales</h3>

                    <div class="card-tools">
                        <a class="btn btn-secondary" href="javascript:void(0)" id="createNewSales">
                            Tambah Data Sales
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Email</th>
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
                            <h4 class="modal-title" id="modealHeading">Tambah Data Sales</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="salesForm" name="salesForm" class="form-horizontal">
                            <div class="modal-body">

                                <input type="hidden" name="sales_id" id="sales_id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan nama sales" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" id="date_of_birth" name="date_of_birth"
                                                class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask
                                                placeholder="Masukan tanggal lahir sales">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="3" id="address" name="address" placeholder="Masukan alamat sales"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Telepon</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Masukan telepon sales" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Masukan email sales" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                <button type="submit" id="saveBtn" class="btn btn-success"
                                    value="create">Simpan</button>
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
                ajax: "{{ route('sales.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
            $('#createNewSales').click(function() {
                $('#date_of_birth').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                })

                $('[data-mask]').inputmask()
                $('#saveBtn').val("create-sales");
                $('#sales_id').val("");
                $('#modealHeading').html("Membuat Sales Baru");
                $('#salesForm').trigger("reset");
                $('#ajaxModel').modal("show");

            })

            //EDIT BUTTON
            $('body').on('click', '.editSales', function() {
                $('#date_of_birth').inputmask('dd/mm/yyyy', {
                    'placeholder': 'dd/mm/yyyy'
                })

                var sales_id = $(this).data('id');
                $.get("{{ route('sales.index') }}" + '/' + sales_id + '/edit', function(data) {
                    $('#modealHeading').html("Mengubah Grup");
                    $('#saveBtn').val("edit-group");
                    $('#ajaxModel').modal('show');

                    $('#sales_id').val(data.id);
                    $('#name').val(data.name);
                    $('#date_of_birth').val(data.date_of_birth);
                    $('#address').val(data.address);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                })
            })



            //ACTION CREATE OR UPDATE
            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        data: $('#salesForm').serialize(),
                        url: "{{ route('sales.store') }}",
                        type: "POST",
                        dataType: "json",
                        success: function(data) {
                            $('#salesForm').trigger("reset");
                            $('#ajaxModel').modal('hide');


                            let isCreate = $('#salesForm').serialize();

                            if (isCreate.includes('sales_id=&')) {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil menyimpan sales',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil mengubah sales',
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
            $('#salesForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    date_of_birth: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Silahkan masukan nama",
                    },
                    date_of_birth: {
                        required: "Silahkan masukan tanggal lahir",
                    },
                    address: {
                        required: "Silahkan masukan alamat",
                    },
                    phone: {
                        required: "Silahkan masukan telepon",
                    },
                    email: {
                        required: "Silahkan masukan email",
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
            $('body').on('click', '.deleteSales', function() {

                Swal.fire({
                    title: 'Anda yakin ?',
                    text: 'Data sales ini akan dihapus jika menekan tombol hapus',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Kembali',
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: "#dc3545",
                }).then((result) => {
                    if (result.isConfirmed) {

                        var sales_id = $(this).data("id");

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('sales.store') }}" + '/' + sales_id,
                            success: function(data) {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil menghapus sales',
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
