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
                    <h3 class="card-title">Data Penjualan</h3>

                    <div class="card-tools">
                        <a class="btn btn-secondary" href="javascript:void(0)" id="createNew">
                            Tambah Data Penjualan
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Penjualan</th>
                                <th>Sales</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat Pelanggan</th>
                                <th>No.HP Pelanggan</th>
                                <th>Total Qty</th>
                                <th>Total Harga</th>
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
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading">Tambah Data Penjualan</h4>
                        </div>
                        <form id="orderForm" name="orderForm" class="form-horizontal">
                            <div class="modal-body">

                                <input type="hidden" name="order_id" id="order_id">

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Kode Penjualan</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="code" name="code" readonly />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Sales</label>
                                    <div class="col-sm-12">
                                        <select id='select-sales' class="form-control select2" style="width: 100%;"
                                            name="sale_id">
                                            <option value='' disabled selected>Pilih Sales</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Nama Pelanggan</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                                            placeholder="Masukan nama pelanggan" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">No. HP Pelanggan</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                                            placeholder="Masukan No.HP Pelanggan" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Alamat Pelanggan</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" rows="3" placeholder="Masukan Alamat Pelanggan" id="customer_address"
                                            name="customer_address"></textarea>
                                    </div>
                                </div>

                                <table class="table table-bordered" id="dynamicTable">
                                    <hr />
                                    <h6>Detail Barang</h6>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr class="tr-body-0 table-group-product">
                                        <td style="width: 20%">
                                            <select onchange="setProduct(this, 0)"
                                                class="form-control select2 select-product select-product-0"
                                                style="width: 100%;" name="order_details[0][product_id]">
                                                <option value='0'>Pilih Barang</option>
                                            </select>
                                        </td>
                                        <td style="width: 20%">
                                            <select onchange="setPrice(this,0)" id="select-group-0"
                                                class="form-control select2 select-group select-group-0"
                                                style="width: 100%;" name="order_details[0][group_id]">
                                                <option value='0'>Pilih Jenis Corak</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="order_details[0][price]" id="price-0"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" onkeyup="setTotal(this,0)" name="order_details[0][qty]"
                                                class="form-control" placeholder="Masukan qty barang" id="qty-0">
                                        </td>
                                        <td>
                                            <input type="number" name="order_details[0][total]" id="total-0"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <button type="button" name="add" id="add"
                                                class="btn btn-primary">+</button>
                                        </td>
                                    </tr>
                                </table>

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


            {{-- MODAL CHECK STOCK --}}
            {{-- <div class="modal fade" id="checkStock">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeadingcheckStock">Cek Stok/Kuantitas Barang</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Jenis Corak</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body-quantities">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div> --}}
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

        /* Fungsi formatRupiah */
        let formatRupiah = (angka, prefix) => {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }


        $("#add").click(function() {
            ++i;

            $("#dynamicTable").append(`<tr class="tr-body-${i} table-group-product">
                <td style="width: 20%">
                    <input type="hidden" name="order_details[${indexAddEditRowDetail}][id]" value="">
                    <select onchange="setProduct(this, ${i})"
                        class="form-control select2 select-product select-product-${i}"
                        style="width: 100%;" name="order_details[${i}][product_id]">
                        <option value='0'>Pilih Barang</option>
                    </select>
                </td>
                <td style="width: 20%">
                    <select onchange="setPrice(this,${i})" id="select-group-${i}"
                        class="form-control select2 select-group select-group-${i}"
                        style="width: 100%;" name="order_details[${i}][group_id]">
                        <option value='0'>Pilih Jenis Corak</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="order_details[${i}][price]" id="price-${i}"
                        class="form-control" readonly>
                </td>
                <td>
                    <input type="number" onkeyup="setTotal(this,${i})" name="order_details[${i}][qty]"
                        class="form-control" placeholder="Masukan qty barang" id="qty-${i}">
                </td>
                <td>
                    <input type="number" name="order_details[${i}][total]" id="total-${i}"
                        class="form-control" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-tr">Remove</button>
                </td>
            </tr>`);

            select2Product(i);
        });


        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        })

        function setProduct(e, index) {
            let product_id = e.value;

            $(`.select-group-${index}`).prop('disabled', false);

            //Remove Option Select Type
            $(`.select-group-${index}`)
                .find('option')
                .remove()
                .end();

            $(`.select-group-${index}`).append(
                `<option value='' disabled selected>Pilih Jenis Corak</option>`);

            $(`.select-group-${index}`).val("");

            $(`.select-group-${index}`).select2({
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

            $(`#price-${index}`).val("");
            $(`#qty-${index}`).val("");
            $(`#total-${index}`).val("");
        }

        function select2Product(index) {
            console.log('masuk ke select product');
            $(`.select-product`).select2({
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
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }

        let addRowDetail = (i, type = null) => {
            console.log('i => ', i)
            console.log('type => ', type)
            if (type == "NEW") {
                indexAddEditRowDetail++;
            }

            if (type == "EDIT") {
                console.log('masuk ke edit')
                if (indexAddEditRowDetail == 0) {
                    indexAddEditRowDetail = i;
                    console.log('0 => ', indexAddEditRowDetail)
                } else {
                    indexAddEditRowDetail++;
                    console.log('++ => ', indexAddEditRowDetail)
                }
            }

            $("#dynamicTable").append(`
                <tr class="tr-body-${indexAddEditRowDetail} table-group-product">
                    <td style="width: 20%">
                        <input type="hidden" name="order_details[${indexAddEditRowDetail}][id]" value="">
                        <select onchange="setProduct(this, ${indexAddEditRowDetail})"
                            class="form-control select2 select-product select-product-${indexAddEditRowDetail}"
                            style="width: 100%;" name="order_details[${indexAddEditRowDetail}][product_id]">
                            <option value='0'>Pilih Barang</option>
                        </select>
                    </td>
                    <td style="width: 20%">
                        <select onchange="setPrice(this,${indexAddEditRowDetail})" id="select-group-${indexAddEditRowDetail}"
                            class="form-control select2 select-group select-group-${indexAddEditRowDetail}"
                            style="width: 100%;" name="order_details[${indexAddEditRowDetail}][group_id]">
                            <option value='0'>Pilih Jenis Corak</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="order_details[${indexAddEditRowDetail}][price]" id="price-${indexAddEditRowDetail}"
                            class="form-control" readonly>
                    </td>
                    <td>
                        <input type="number" onkeyup="setTotal(this,${indexAddEditRowDetail})" name="order_details[${indexAddEditRowDetail}][qty]"
                            class="form-control" placeholder="Masukan qty barang" id="qty-${indexAddEditRowDetail}">
                    </td>
                    <td>
                        <input type="number" name="order_details[${indexAddEditRowDetail}][total]" id="total-${indexAddEditRowDetail}"
                            class="form-control" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-tr">Remove</button>
                    </td>
                </tr>
            `)

            select2Product(indexAddEditRowDetail);
        }

        function setTotal(e, index) {
            console.log('masuk ke set total')
            const price = $(`#price-${index}`).val();
            const qty = e.value == '' ? 0 : e.value;

            console.log('price ==> ', price)
            console.log('qty ==> ', qty)

            const result = price * qty;

            console.log('result ==> ', result)
            $(`#total-${index}`).val(result);
        }

        function setPrice(e, index) {
            console.log('masuk ke set price');
            const group_id = e.value;
            const product_id = $(`.select-product-${index}`).val();
            console.log(group_id)
            console.log(product_id)


            $.get("{{ route('groups.index') }}" + '/' + product_id + '/' + group_id + '/price', function(data) {
                console.log('bismillah => ', data)
                $(`#price-${index}`).val(data.data);
            })
        }


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
                ajax: "{{ route('orders.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'sale_id',
                        name: 'sale_id'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'customer_address',
                        name: 'customer_address'
                    },
                    {
                        data: 'customer_phone',
                        name: 'customer_phone'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'total_qty',
                        name: 'total_qty'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            //Search Sales
            $("#select-sales").select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('sales.select-sales') }}",
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
                        console.log(response)
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            //BUTTON TAMBAH BARANG
            $('#createNew').click(function() {
                indexAddEditRowDetail = 0;
                $('.table-group-product').remove();

                $("#dynamicTable").append(`<tr class="tr-body-${indexAddEditRowDetail} table-group-product">
                <td style="width: 20%">
                    <input type="hidden" name="order_details[${indexAddEditRowDetail}][id]" value="">
                    <select onchange="setProduct(this, ${indexAddEditRowDetail})"
                        class="form-control select2 select-product select-product-${indexAddEditRowDetail}"
                        style="width: 100%;" name="order_details[${indexAddEditRowDetail}][product_id]">
                        <option value='0'>Pilih Barang</option>
                    </select>
                </td>
                <td style="width: 20%">
                    <select onchange="setPrice(this,${indexAddEditRowDetail})" id="select-group-${indexAddEditRowDetail}"
                        class="form-control select2 select-group select-group-${indexAddEditRowDetail}"
                        style="width: 100%;" name="order_details[${indexAddEditRowDetail}][group_id]">
                        <option value='0'>Pilih Jenis Corak</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="order_details[${indexAddEditRowDetail}][price]" id="price-${indexAddEditRowDetail}"
                        class="form-control" readonly>
                </td>
                <td>
                    <input type="number" onkeyup="setTotal(this,${indexAddEditRowDetail})" name="order_details[${indexAddEditRowDetail}][qty]"
                        class="form-control" placeholder="Masukan qty barang" id="qty-${indexAddEditRowDetail}">
                </td>
                <td>
                    <input type="number" name="order_details[${indexAddEditRowDetail}][total]" id="total-${indexAddEditRowDetail}"
                        class="form-control" readonly>
                </td>
                <td>
                    <button type="button" onclick=addRowDetail(${indexAddEditRowDetail},'NEW') name="addDetail" id="addDetail"
                        class="btn btn-primary">Tambah</button>
                </td>
            </tr>`);

                select2Product(indexAddEditRowDetail);


                //Remove Option Select Type
                $('#select-sales')
                    .find('option')
                    .remove()
                    .end();

                $('#select-sales').append(
                    `<option value='' selected>Pilih Sales</option>`);

                //Remove validation class
                $('.is-invalid').removeClass("is-invalid");
                $('span.error').remove();


                $.ajax({
                    type: "GET",
                    url: "{{ route('orders.code') }}",
                    success: function(data) {
                        $('#code').val(data.data);
                    }
                });

                $('#saveBtn').val("create-orders");
                $('#order_id').val("");

                $('#sale_id').val("");
                $('#modelHeading').html("Membuat Penjualan Baru");
                $('#orderForm').trigger("reset");
                $('#ajaxModel').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                select2Product(0);

            });

            // BUTTON EDIT PENJUALAN
            $('body').on('click', '.editOrder', function() {
                indexAddEditRowDetail = 0;
                let i = 0;

                //Remove validation class
                $('.is-invalid').removeClass("is-invalid");
                $('span.error').remove();

                var order_id = $(this).data('id');
                $.get("{{ route('orders.index') }}" + '/' + order_id + '/edit', function(data) {
                    $('#modelHeading').html("Mengubah Penjualan");
                    $('#saveBtn').val("edit-order");
                    $('#ajaxModel').modal('show');

                    $('#order_id').val(data.id);
                    $('#code').val(data.code);
                    $('#select-sales').val(data.sale_id);
                    $('#customer_name').val(data.customer_name);
                    $('#customer_phone').val(data.customer_phone);
                    $('#customer_address').val(data.customer_address);

                    $('#select-sales').append(
                        `<option value="${data.sale_id}" selected>${data.sale.name}</option>`);



                    $('.table-group-product').remove();

                    console.log(data);

                    data.orderdetails.forEach(detail => {
                        console.log('detail => ', detail)
                    });

                    data.orderdetails.forEach(detail => {
                        console.log('orderdetials edit => ', detail)
                        console.log('i ==>', i)
                        if (i == 0) {
                            $("#dynamicTable").append(`
                                <tr class="tr-body-${i} table-group-product">
                                    <td style="width: 20%">
                                        <input type="hidden" name="order_details[${i}][id]" value=${detail.id}>
                                        <select onchange="setProduct(this, ${i})"
                                            class="form-control select2 select-product select-product-${i}"
                                            style="width: 100%;" name="order_details[${i}][product_id]">
                                            <option value=${detail.product.id}>${detail.product.name}</option>
                                        </select>
                                    </td>
                                    <td style="width: 20%">
                                        <select onchange="setPrice(this,${i})" id="select-group-${i}"
                                            class="form-control select2 select-group select-group-${i}"
                                            style="width: 100%;" name="order_details[${i}][group_id]">
                                            <option value=${detail.group.id}>${detail.group.name}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="order_details[${i}][price]" id="price-${i}"
                                            class="form-control" value=${detail.price} readonly>
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="setTotal(this,${i})" name="order_details[${i}][qty]"
                                            class="form-control" placeholder="Masukan qty barang" id="qty-${i}" value=${detail.qty}>
                                    </td>
                                    <td>
                                        <input type="number" name="order_details[${i}][total]" id="total-${i}"
                                            class="form-control" value=${detail.total} readonly>
                                    </td>
                                    <td>
                                        <button type="button" name="addEdit" id="addEdit" onclick="addRowDetail(${data.orderdetails.length},'EDIT')"
                                        class="btn btn-primary">Tambah</button>
                                    </td>
                                </tr>
                        `);
                        } else {
                            $("#dynamicTable").append(`
                                <tr class="tr-body-${i} table-group-product">
                                    <td style="width: 20%">
                                        <input type="hidden" name="order_details[${i}][id]" value=${detail.id}>
                                        <select onchange="setProduct(this, ${i})"
                                            class="form-control select2 select-product select-product-${i}"
                                            style="width: 100%;" name="order_details[${i}][product_id]">
                                            <option value=${detail.product.id}>${detail.product.name}</option>
                                        </select>
                                    </td>
                                    <td style="width: 20%">
                                        <select onchange="setPrice(this,${i})" id="select-group-${i}"
                                            class="form-control select2 select-group select-group-${i}"
                                            style="width: 100%;" name="order_details[${i}][group_id]">
                                            <option value=${detail.group.id}>${detail.group.name}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="order_details[${i}][price]" id="price-${i}"
                                            class="form-control" value=${detail.price} readonly>
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="setTotal(this,${i})" name="order_details[${i}][qty]"
                                            class="form-control" placeholder="Masukan qty barang" id="qty-${i}" value=${detail.qty}>
                                    </td>
                                    <td>
                                        <input type="number" name="order_details[${i}][total]" id="total-${i}"
                                            class="form-control" value=${detail.total} readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                    </td>
                                </tr>
                        `);
                        }

                        select2Product(i);
                        i++;
                    });

                })
            });


            //BUAT ATAU UBAH BARANG
            $.validator.setDefaults({
                submitHandler: function() {
                    let isCreate = $('#orderForm').serialize();


                    if (isCreate.includes('order_id=&')) {

                        $.ajax({
                            data: $('#orderForm').serialize(),
                            url: "{{ route('orders.store') }}",
                            type: "POST",
                            dataType: "json",
                            success: function(data) {
                                console.log('response data => ', data)
                                if (data.isError == false) {
                                    $('#orderForm').trigger("reset");
                                    $('#ajaxModel').modal('hide');


                                    Swal.fire(
                                        'Sukses!',
                                        'Berhasil menyimpan barang',
                                        'success'
                                    )

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
                    } else {
                        const order_id = $(".editOrder").data("id");

                        // console.log($('#orderForm').serialize())
                        // alert(order_id)

                        $.ajax({
                            data: $('#orderForm').serialize(),
                            url: "{{ route('orders.store') }}" + '/' + order_id,
                            type: "PUT",
                            dataType: "json",
                            success: function(data) {
                                console.log('response data => ', data)
                                if (data.isError == false) {
                                    $('#orderForm').trigger("reset");
                                    $('#ajaxModel').modal('hide');


                                    Swal.fire(
                                        'Sukses!',
                                        'Berhasil mengubah barang',
                                        'success'
                                    )

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


                }
            });

            $('#orderForm').validate({
                rules: {
                    sale_id: {
                        required: true,
                    },
                    customer_name: {
                        required: true,
                    },
                    customer_phone: {
                        required: true,
                    },
                    customer_address: {
                        required: true,
                    },
                },
                messages: {
                    sale_id: {
                        required: "Silahkan masukan nama sales",
                    },
                    customer_name: {
                        required: "Silahkan masukan nama pelanggan",
                    },
                    customer_phone: {
                        required: "Silahkan masukan telepon pelanggan",
                    },
                    customer_address: {
                        required: "Silahkan masukan alamat pelanggan",
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
            $('body').on('click', '.deleteOrder', function() {

                Swal.fire({
                    title: 'Anda yakin ?',
                    text: 'Data penjualan ini akan dihapus jika menekan tombol hapus',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Kembali',
                    confirmButtonText: 'Hapus',
                    confirmButtonColor: "#dc3545",
                }).then((result) => {
                    if (result.isConfirmed) {

                        var order_id = $(this).data("id");

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('orders.store') }}" + '/' + order_id,
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
