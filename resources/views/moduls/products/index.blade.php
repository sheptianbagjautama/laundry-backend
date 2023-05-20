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
                    <h3 class="card-title">Data Barang</h3>

                    <div class="card-tools">
                        <a class="btn btn-secondary" href="javascript:void(0)" id="createNew">
                            Tambah Data Barang
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
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
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading">Tambah Data Barang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="productForm" name="productForm" class="form-horizontal">
                            <div class="modal-body">

                                <input type="hidden" name="product_id" id="product_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukan nama barang" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Tipe</label>
                                    <div class="col-sm-12">
                                        <select id='select-types' class="form-control select2" style="width: 100%;"
                                            name="type_id">
                                            <option value='' disabled selected>Pilih Tipe</option>
                                        </select>
                                    </div>
                                </div>

                                <table class="table table-bordered" id="dynamicTable">
                                    <hr />
                                    <h6>Detail Jenis Corak</h6>
                                    <tr>
                                        <th>Jenis Corak</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr class="tr-body-0 table-group-product">
                                        <td style="width: 30%">
                                            <select class="form-control select2 select-groups select-groups-0"
                                                style="width: 100%;" name="group_product[0][group_id]">
                                                <option value='0'>Pilih Jenis Corak</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="group_product[0][qty]"
                                                placeholder="Masukan Kuantitas" class="form-control">

                                        </td>
                                        <td>
                                            <input type="number" name="group_product[0][price]" placeholder="Masukan Harga"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" name="add" id="add"
                                                class="btn btn-primary">Tambah Lagi</button>
                                        </td>
                                    </tr>
                                </table>

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

        let addRowDetail = (i, type = null) => {
            if (indexAddEditRowDetail == 0) {
                if (type == "NEW") {
                    console.log("masuk new")
                    indexAddEditRowDetail = i;
                } else {
                    console.log('cek i edit = ', i)
                    indexAddEditRowDetail = i - 1;
                }
                console.log('index 0', indexAddEditRowDetail)
            } else {
                indexAddEditRowDetail++;
                console.log('index != 0', indexAddEditRowDetail)
            }

            // alert(`Testing ${indexAddEditRowDetail}`)


            $("#dynamicTable").append(`<tr class="tr-body-${indexAddEditRowDetail} table-group-product">
                                        <td style="width: 30%">
                                            <select  class="form-control select2 select-groups select-groups-${indexAddEditRowDetail}" style="width: 100%;"
                                                name="group_product[${indexAddEditRowDetail}][group_id]">
                                                <option value='0'>Pilih Jenis Corak</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${indexAddEditRowDetail}][qty]" placeholder="Masukan Kuantitas"
                                                class="form-control">

                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${indexAddEditRowDetail}][price]" placeholder="Masukan Harga"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                        </td>
                                    </tr>`)

            select2(i);
        }

        $("#add").click(function() {
            ++i;

            $("#dynamicTable").append(`<tr class="tr-body-${i} table-group-product">
                                        <td style="width: 30%">
                                            <select  class="form-control select2 select-groups select-groups-${i}" style="width: 100%;"
                                                name="group_product[${i}][group_id]">
                                                <option value='0'>Pilih Jenis Corak</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${i}][qty]" placeholder="Masukan Kuantitas"
                                                class="form-control">

                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${i}][price]" placeholder="Masukan Harga"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                        </td>
                                    </tr>`)

            select2(i);
        });


        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        })

        function select2(index) {
            $(`.select-groups`).select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('groups.select') }}",
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
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }
        // function select2(index) {
        //     $(`.select-groups-${index}`).select2({
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
                ajax: "{{ route('products.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type.name',
                        name: 'type.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            //Search Types
            $("#select-types").select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('types.select') }}",
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
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            select2(0);


            /*------------------------------------------
                --------------------------------------------
                Click to Button
                --------------------------------------------
                --------------------------------------------*/
            $('#createNew').click(function() {
                indexAddEditRowDetail = 0;
                $('.table-group-product').remove();

                $("#dynamicTable").append(`<tr class="tr-body-${0} table-group-product">
                <td style="width: 30%">
                    <select class="form-control select2 select-groups select-groups-${0}" style="width: 100%;"
                        name="group_product[${0}][group_id]">
                        <option value='0'>Pilih Jenis Corak</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="group_product[${0}][qty]" placeholder="Masukan Kuantitas"
                        class="form-control">

                </td>
                <td>
                    <input type="number" name="group_product[${0}][price]" placeholder="Masukan Harga"
                        class="form-control">
                </td>
                <td>
                    <button type="button" onclick=addRowDetail(${0},'NEW') name="addDetail" id="addDetail"
                        class="btn btn-primary">Tambah Lagi</button>
                </td>
            </tr>`);

                //Remove Option Select Type
                $('#select-types')
                    .find('option')
                    .remove()
                    .end();

                $('#select-types').append(
                    `<option value='' disabled selected>Pilih Tipe</option>`);

                select2(0);

                //Remove validation class
                $('.is-invalid').removeClass("is-invalid");
                $('span.error').remove();



                $('#saveBtn').val("create-products");
                $('#type_id').val("");
                $('#modelHeading').html("Membuat Barang Baru");
                $('#productForm').trigger("reset");
                $('#ajaxModel').modal("show");

            })

            /*------------------------------------------
                --------------------------------------------
                Click to Edit Button
                --------------------------------------------
                --------------------------------------------*/
            $('body').on('click', '.editProduct', function() {
                indexAddEditRowDetail = 0;
                var product_id = $(this).data('id');
                console.log('product id => ', product_id)
                $.get("{{ route('products.index') }}" + '/' + product_id + '/edit', function(data) {
                    console.log('data ==> ', data);
                    $('#modelHeading').html("Mengubah Barang");
                    $('#saveBtn').val("edit-product");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.name);
                    $('#type_id').val(data.type.id);

                    $('#select-types').append(
                        `<option value="${data.type.id}" selected>${data.type.name}</option>`);


                    let i = 0;
                    // document.querySelectorAll(".table-group-product").remove();
                    $('.table-group-product').remove();


                    data.groups.forEach(detail => {
                        if (i == 0) {
                            $("#dynamicTable").append(`<tr class="tr-body-${i} table-group-product">
                                        <td style="width: 30%">
                                            <select  class="form-control select2 select-groups select-groups-${i}" style="width: 100%;"
                                                name="group_product[${i}][group_id]">
                                                <option value='${detail.id}' selected>${detail.name}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${i}][qty]" value=${detail.pivot.qty} placeholder="Masukan Kuantitas"
                                                class="form-control">

                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${i}][price]" value=${detail.pivot.price} placeholder="Masukan Harga"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" onclick=addRowDetail(${data.groups.length}) name="addEdit" id="addEdit"
                                                class="btn btn-primary">Tambah Lagi</button>
                                        </td>
                                    </tr>`)

                        } else {
                            $("#dynamicTable").append(`<tr class="tr-body-${i} table-group-product">
                                        <td style="width: 30%">
                                            <select  class="form-control select2 select-groups select-groups-${i}" style="width: 100%;"
                                                name="group_product[${i}][group_id]">
                                                <option value='${detail.id}' selected>${detail.name}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${i}][qty]" value=${detail.pivot.qty} placeholder="Masukan Kuantitas"
                                                class="form-control">

                                        </td>
                                        <td>
                                            <input type="number" name="group_product[${i}][price]" value=${detail.pivot.price} placeholder="Masukan Harga"
                                                class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                        </td>
                                    </tr>`)
                        }


                        select2(i);
                        i++;
                    });

                })
            });

            /*------------------------------------------
                --------------------------------------------
                Create Code
                --------------------------------------------
                --------------------------------------------*/

            $.validator.setDefaults({
                submitHandler: function() {
                    let isCreate = $('#productForm').serialize();

                    if (isCreate.includes('product_id=&')) {
                        alert('create barang');
                    } else {
                        alert('edit barang');
                    }

                    // $.ajax({
                    //     data: $('#productForm').serialize(),
                    //     url: "{{ route('products.store') }}",
                    //     type: "POST",
                    //     dataType: "json",
                    //     success: function(data) {
                    //         console.log('data => ', data);

                    //         if (data.isError == false) {
                    //             $('#productForm').trigger("reset");
                    //             $('#ajaxModel').modal('hide');

                    //             let isCreate = $('#productForm').serialize();
                    //             console.log("isCreate : ", isCreate)

                    //             if (isCreate.includes('product_id=&')) {
                    //                 console.log('create')
                    //                 Swal.fire(
                    //                     'Sukses!',
                    //                     'Berhasil menyimpan barang',
                    //                     'success'
                    //                 )
                    //             } else {
                    //                 Swal.fire(
                    //                     'Sukses!',
                    //                     'Berhasil mengubah barang',
                    //                     'success'
                    //                 )
                    //             }


                    //             table.draw();
                    //         } else {
                    //             Swal.fire(
                    //                 'Gagal!',
                    //                 data.message,
                    //                 'error'
                    //             )
                    //         }

                    //     },
                    //     error: function(data) {
                    //         console.log('Error: ', data);
                    //         $('#saveBtn').html("Simpan Perubahan");
                    //     }
                    // });
                }
            });

            $('#productForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    type_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Silahkan masukan nama barang",
                    },
                    type_id: {
                        requi$red: "Silahkan masukan tipe barang",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    console.log('highlight => ', element)
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    console.log('unhighlight => ', element)
                    $(element).removeClass('is-invalid');
                }
            });

            /*------------------------------------------
                --------------------------------------------
                Delete Code
                --------------------------------------------
                --------------------------------------------*/
            $('body').on('click', '.deleteProduct', function() {

                Swal.fire({
                    title: 'Anda yakin ?',
                    text: 'Data barang ini akan dihapus jika menekan tombol hapus',
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
                            url: "{{ route('products.store') }}" + '/' + type_id,
                            success: function(data) {
                                Swal.fire(
                                    'Sukses!',
                                    'Berhasil menghapus barang',
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
