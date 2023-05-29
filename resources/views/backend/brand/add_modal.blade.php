
<!-- Modal -->
<div class="modal fade" id="add_brand_modal" tabindex="-1" role="dialog" aria-labelledby="add_brand_model1" aria-hidden="true">
    
    <form action="" method="POST" id="addBrandForm">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_brand_model1">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="message mb-2">
                        
                    </div>

                    <div class="form-group">
                        <label for="name">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" required name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary add_brand">Save Brand</button>
                </div>
            </div>
        </div>
    </form>
</div>
