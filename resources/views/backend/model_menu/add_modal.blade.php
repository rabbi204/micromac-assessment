
<!-- Modal -->
<div class="modal fade" id="add_model_modal" tabindex="-1" role="dialog" aria-labelledby="add_model_modal1" aria-hidden="true">
    
    <form action="" method="POST" id="addModelForm">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_model_modal1">Add Model</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="message mb-2">
                        
                    </div>

                    <div class="form-group">
                        <label for="brand_id">Brand<span class="text-danger">*</span></label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">--- select brand ---</option>
                            @foreach ($brand_data as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Model Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_model">Save Model</button>
                </div>
            </div>
        </div>
    </form>
</div>
