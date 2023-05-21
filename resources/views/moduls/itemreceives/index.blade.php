@extends('layouts.main')

@section('links')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert/sweetalert2.min.css') }}">

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
                    <h3 class="card-title">Data Penerimaan Barang</h3>

                    <div class="card-tools">
                        <a class="btn btn-secondary" href="javascript:void(0)" id="createNew">
                            Tambah Data Penerimaan Barang
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jenis Corak</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.card -->

            {{-- MODAL CRUD --}}
            <div class="modal fade" id="ajaxModel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading">Tambah Data Penerimaan Barang</h4>
                        </div>
                        <form id="receiveForm" name="receiveForm" class="form-horizontal">
                            <div class="modal-body">

                                <input type="hidden" name="receive_id" id="receive_id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Barang</label>
                                    <div class="col-sm-12">
                                        <select id='select-product' class="form-control select2" style="width: 100%;"
                                            name="product_id">
                                            <option value='' disabled selected>Pilih Barang</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Jenis Corak</label>
                                    <div class="col-sm-12">
                                        <select id='select-group' class="form-control select2" style="width: 100%;"
                                            name="group_id" disabled>
                                            <option value='' disabled selected>Pilih Jenis Corak</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Kuantitas</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" id="qty" name="qty"
                                            placeholder="Masukan kuantitas" />
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
    <!-- jquery-validation -->
    <script src="{{ asset('lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>


    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var i = 0;
        let indexAddEditRowDetail = 0;

        // function select2(index) {
        //     $(`.select-groups`).select2({
        //         theme: 'bootstrap4',
        //         ajax: {
        //             url: "{{ route('groups.select') }}",
        //             type: "post",
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return {
        //                     _token: CSRF_TOKEN,
        //                     search: params.term // search term
        //                 };
        //             },
        //             processResults: function(response) {
        //                 return {
        //                     results: response
        //                 };
        //             },
        //             cache: true
        //         }
        //     });
        // }

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('item-receives.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product.name',
                        name: 'product.name'
                    },
                    {
                        data: 'group.name',
                        name: 'group.name'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            // //Search Types
            $("#select-product").select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('products.select-products') }}",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        console.log('response => ', response)
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });


            $('#select-product').on('change', function(e) {
                let product_id = this.value;



                $('#select-group').prop('disabled', false);

                //Remove Option Select Type
                $('#select-group')
                    .find('option')
                    .remove()
                    .end();

                $('#select-group').append(
                    `<option value='' disabled selected>Pilih Jenis Corak</option>`);

                $('#select-group').val("");

                $("#select-group").select2({
                    theme: 'bootstrap4',
                    ajax: {
                        url: "{{ route('groups.select-groups') }}",
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                _token: CSRF_TOKEN,
                                search: params.term, // search term
                                product_id: product_id
                            };
                        },
                        processResults: function(response) {
                            console.log('response => ', response)
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });
            })

            //BUTTON TAMBAH BARANG
            $('#createNew').click(function() {
                $('#receive_id').val("");
                $('#modealHeading').html("Membuat Penerimaan Baru");
                $('#receiveForm').trigger("reset");
                $('#ajaxModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            })

            //BUTTON EDIT BARANG
            $('body').on('click', '.editItemReceive', function() {
                alert("Edit Penerimaan Barang")
            });


            //BUAT ATAU UBAH BARANG
            $.validator.setDefaults({
                submitHandler: function() {
                    let isCreate = $('#receiveForm').serialize();
                    $.ajax({
                        data: $('#receiveForm').serialize(),
                        url: "{{ route('item-receives.store') }}",
                        type: "POST",
                        dataType: "json",
                        success: function(data) {

                            if (data.isError == false) {
                                $('#receiveForm').trigger("reset");
                                $('#ajaxModel').modal('hide');

                                let isCreate = $('#receiveForm').serialize();

                                if (isCreate.includes('receive_id=&')) {
                                    Swal.fire(
                                        'Sukses!',
                                        'Berhasil menyimpan penerimaan barang',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Sukses!',
                                        'Berhasil mengubah penerimaan barang',
                                        'success'
                                    )
                                }


                                table.draw();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    data.message,
                                    'error'
                                )
                            }

                        },
                        error: function(data) {
                            console.log('Error: ', data);
                            $('#saveBtn').html("Simpan Perubahan");
                        }
                    });
                }
            });

            $('#receiveForm').validate({
                rules: {
                    product_id: {
                        required: true,
                    },
                    group_id: {
                        required: true,
                    },
                    qty: {
                        required: true,
                    },
                },
                messages: {
                    product_id: {
                        required: "Silahkan masukan barang",
                    },
                    group_id: {
                        required: "Silahkan masukan jenis corak",
                    },
                    qty: {
                        required: "Silahkan masukan kuantitas barang",
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

            /*------------------------------------------
                --------------------------------------------
                Delete Code
                --------------------------------------------
                --------------------------------------------*/
            $('body').on('click', '.deleteItemReceive', function() {

                Swal.fire({
                    title: 'Anda yakin ?',
                    text: 'Data penerimaan barang ini akan dihapus jika menekan tombol hapus',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Kembali',
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: "#dc3545",
                }).then((result) => {
                    if (result.isConfirmed) {

                        var receive_id = $(this).data("id");

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('item-receives.store') }}" + '/' + receive_id,
                            success: function(data) {
                                if (data.isError == false) {
                                    Swal.fire(
                                        'Sukses!',
                                        data.message,
                                        'success'
                                    )
                                    table.draw();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Ada sesuatu yang salah',
                                        'error'
                                    )
                                    table.draw();
                                }
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
