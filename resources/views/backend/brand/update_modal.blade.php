
<!-- Modal -->
<div class="modal fade" id="update_brand_modal" tabindex="-1" role="dialog" aria-labelledby="update_brand_model1" aria-hidden="true">
    
    <form action="" method="POST" id="updateBrandForm">
        @csrf

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update_brand_model1">Update Brand</h5>
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
                        <input type="hidden" name="update_id" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Brand</button>
                </div>
            </div>
        </div>
    </form>
</div>
