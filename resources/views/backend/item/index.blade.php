@extends('backend.admin_master')
@section('backend_content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">
        <a href="" data-toggle="modal" data-target="#add_item_modal" class="btn btn-primary btn-sm">Add Item</a><br><br>
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
                            <th scope="col">Item</th>
                            <th scope="col">Model Name</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item_data as $data)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->brand->name }}</td>
                                <td>{{ $data->model->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($data->entry_date)) }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('item.edit', $data->id) }}" class="btn btn-warning btn-sm mr-2">
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

                
                {{ $item_data->links() }}
            </div>

            
            @include('backend.item.add_modal')

        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function(){

            //store brand data
            $(document).on('click', '.add_item', function(e){
                // e.preventDefault();
                
                    $.ajax({
                        url: "/item/add/",
                        method: "post",
                        data: $('#addItemForm').serialize(),
                        success: function(res){
                            if(res.status = 'success'){
                                $('#add_item_modal').modal('hide');
                                $('#addItemForm')[0].reset();
                                $('table').load(location.href+' .table');
                                //toaster msg
                                Command: toastr["success"]("Item Added Successfully!")
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
                

            });

            // dependency dropdown when brand name change then related model name show
            $('#brand').on('change', function(){
                let id = $(this).val();
                // alert(name);
                $('#model').empty();
                $('#model').append(`<option value="" selected disabled>Loading...</option>`);
                $.ajax({
                    url : '/item/model/' + id,
                    dataType: 'json',
                    success: function(response){
                        $('#model').empty();
                        $('#model').append(`<option value="" selected disabled>--select product--</option>`);
                        $.each(response.data, function(index, row){
                            $('#model').append(`<option value="${row.id}">${row.name}</option>`);
                        });
                    },
                });
            });

            //delete brand data
            $(document).on('click', '#delete_btn', function(e){
                e.preventDefault();
                
                let id = $(this).attr('delete_id');

                if( confirm('Are You sure to delete the selected Item?') ){
                    $.ajax({
                        url: '/item/delete/' + id,
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
