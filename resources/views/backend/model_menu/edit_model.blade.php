@extends('backend.admin_master')
@section('backend_content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <a href="{{ route('model.index') }}" class="btn btn-primary btn-sm">Go Back</a><br><br>
                <div class="card">
                    <div class="card-header">
                        <h4>Update Model Data</h4>
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
                        <form action="{{ route('model.update', $model_data->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="">Brand</label>
                                <select name="brand_id" class="form-control" id="">
                                    @foreach ($brand_data as $brand)
                                        <option value="{{ $brand->id }}" {{ ($brand->id == $model_data->brand_id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Model</label>
                                <input type="text" name="name" value="{{ $model_data->name }}" class="form-control" >
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
