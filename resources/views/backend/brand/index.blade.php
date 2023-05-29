@extends('backend.admin_master')
@section('backend_content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">
        <a href="" data-toggle="modal" data-target="#add_brand_modal" class="btn btn-primary btn-sm">Add Brand</a><br><br>
        <div class="card mb-4">
            <!--------- Success Message Show--------->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            @endif


            <div class="table-responsive">
                <table class="table table-hover px-3 py-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand_data as $data)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ date('M-d, Y', strtotime($data->entry_date)) }}</td>
                                <td class="d-flex">
                                    <a href="#" id="edit_btn" brand_id="{{ $data->id }}" class="btn btn-warning btn-sm mr-2">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" id="delete_btn" delete_id="{{ $data->id }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                
                {{ $brand_data->links() }}
            </div>

            
            @include('backend.brand.add_modal')
            @include('backend.brand.update_modal')

        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function(){

            //store brand data
            $(document).on('click', '.add_brand', function(e){
                e.preventDefault();

                let name = $('form#addBrandForm input[name="name"]').val();
                
                if( name = ''){
                    $('.message').html('<p>All fields are required<button class="close" data-dismiss="alert">&times;</button></p>');
                }else{
                    $.ajax({
                        url: "{{ route('brand.add') }}",
                        method: "post",
                        data: $('#addBrandForm').serialize(),
                        success: function(res){
                            if(res.status = 'success'){
                                $('#add_brand_modal').modal('hide');
                                $('#addBrandForm')[0].reset();
                                $('table').load(location.href+' .table');
                                //toaster msg
                                Command: toastr["success"]("Brand Added Successfully!")
                                toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
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
                                }
                            }
                        },error:function(err){
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value){
                                $('.message').append('<span class="text-danger">'+value+'</span>' + '<br>' );
                            })
                        }
                    });
                }
                

            });

            // show brand value in update form
            $(document).on('click', '#edit_btn', function(e){
                e.preventDefault();
                $('#update_brand_modal').modal('show');

                let id = $(this).attr('brand_id');
                
                $.ajax({
                    url: '/brand/edit/' + id,
                    dataType: "json",
                    success: function(data){
                        $('#update_brand_modal input[name="name"]').val(data.name);
                        $('#update_brand_modal input[name="update_id"]').val(data.id);
                    }
                });

            });

            //update brand data
            $(document).on('submit', 'form#updateBrandForm', function(e){
                e.preventDefault();

                let name = $('form#updateBrandForm input[name="name"]').val();
                let id = $('form#updateBrandForm input[name="update_id"]').val();
                
                if( name = ''){
                    $('.message').html('<p>All fields are required<button class="close" data-dismiss="alert">&times;</button></p>');
                }else{
                    $.ajax({
                        url: "/brand/update/" + id,
                        method: "post",
                        data: $('#updateBrandForm').serialize(),
                        success: function(res){
                            if(res.status = 'success'){
                                $('#update_brand_modal').modal('hide');
                                $('#updateBrandForm')[0].reset();
                                $('table').load(location.href+' .table');
                                //toaster msg
                                Command: toastr["success"]("Brand Updated Successfully!")
                                toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
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
                                }
                            }
                        },error:function(err){
                            let error = err.responseJSON;
                            $.each(error.errors, function(index, value){
                                $('.message').append('<span class="text-danger">'+value+'</span>' + '<br>' );
                            })
                        }
                    });
                }
                

            });

            //delete brand data
            $(document).on('click', '#delete_btn', function(e){
                e.preventDefault();
                
                let id = $(this).attr('delete_id');

                if( confirm('Are You sure to delete the selected brand?') ){
                    $.ajax({
                        url: '/brand/delete/' + id,
                        dataType: "json",
                        success: function(data){
                            $('.table').load(location.href+' .table');
                            Command: toastr["success"]("Data Deleted Successfully!")
                            toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
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
                            }
                        }
                    });
                }
                
                

            });

        });
    </script>
@endsection

@endsection
