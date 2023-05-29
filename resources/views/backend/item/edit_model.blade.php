@extends('backend.admin_master')
@section('backend_content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <a href="{{ route('item.index') }}" class="btn btn-primary btn-sm">Go Back</a><br><br>
                <div class="card">
                    <div class="card-header">
                        <h4>Update Item Data</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('item.update',$item_data->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" class="form-control" id="brand">
                                    @foreach ($brand_data as $brand)
                                        <option value="{{ $brand->id }}" {{ ($brand->id == $item_data->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Model <span class="text-danger">*</span></label>
                                <select name="model_id" class="form-control" id="model">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Item <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $item_data->name }}" class="form-control" >
                            </div>
                            <button type="submit" class="btn btn-primary">Update Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        $(document).ready(function(){
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

        });
    </script>
@endsection
@endsection
