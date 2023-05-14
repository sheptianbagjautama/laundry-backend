@extends('layouts.main')

@section('links')
    <!-- SweetAlert2 -->
    {{-- <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}
    {{-- <link href="{{ asset('lte/plugins/sweetalert/sweetalert2.min.css') }}" rel="stylesheet"> --}}
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
                    <h3 class="card-title">{{ $subtitle }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Grup</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Silahkan masukan nama grup" name="name">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    {{-- <script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }} "></script> --}}
    <!-- jquery-validation -->
    <script src="{{ asset('lte/plugins/jquery-validation/jquery.validate.min.js') }} "></script>
    <script src="{{ asset('lte/plugins/jquery-validation/additional-methods.min.js') }} "></script>
    <!-- SweetAlert2 -->
    {{-- <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --}}
    {{-- <script src=" {{ asset('lte/plugins/sweetalert/sweetalert2.all.min.js') }}"></script> --}}

    {{-- <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            $.validator.setDefaults({
                submitHandler: function() {
                    var name = $("input[name=name]").val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('groups.store') }}",
                        data: {
                            name: name,
                        },
                        success: function(data) {

                            Toast.fire({
                                icon: 'success',
                                title: 'Signed in successfully'
                            })

                            window.location.href = "{{ route('groups.index') }}";

                            var name = $("input[name=name]").val("");
                        }
                    });
                }
            });
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Silakan masukkan nama grup",
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


        });
    </script> --}}
@endsection
