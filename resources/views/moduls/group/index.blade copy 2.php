<!DOCTYPE html>
<html>

<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert/sweetalert2.min.css') }}">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Laravel 7|8 Yajra Datatables Example</h2>
        <table class="table table-bordered yajra-datatable">
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

</body>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}

<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }} "></script>
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
<script src="{{ asset('lte/dist/js/adminlte.js') }} "></script>


<script src="{{ asset('lte/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
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

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('groups.list') }}",
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

    });
</script>

</html>