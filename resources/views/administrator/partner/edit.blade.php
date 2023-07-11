<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Partner</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form autocomplete="off">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Email<span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{ $item->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                </div>
                <div class="mb-3">
                    <label>Mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" value="{{ $item->url }}">
                </div>
                @include('administrator.components.normal_textarea', ['label' => 'Ads.txt', 'name' => 'partner_code'])
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="update({{ $item->api_publisher_id }})">Save</button>
            </div>
        </form>
    </div>
</div>

<script>

    $('#edit_select_idcategory_site').select2({
        //dropdownParent: $('#editWebsiteModal')
    });
</script>
