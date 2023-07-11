<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addressModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="payment__info-customer">
                <div class="payment__info-group mb-4">
                    <label for="NameInput" class="form-label">Họ tên <sup>*</sup></label>
                    <input type="text" class="form-control" id="NameInput" placeholder="Họ và tên">
                </div>
                <div class="payment__info-group mb-4">
                    <label for="PhoneInput" class="form-label">Số điện thoại <sup>*</sup></label>
                    <div class="input-group">
                        <input type="text" id="PhoneInput" class="form-control" placeholder="Nhập số điện thoại"
                               aria-describedby="basic-addon2">
                    </div>
                </div>
                <div class="payment__info-group mb-4">
                    <label for="EmailInput" class="form-label">Email <sup>*</sup></label>
                    <input type="email" class="form-control" id="EmailInput" placeholder="Nhập email">
                </div>
                <div class="payment__info-group mb-4">
                    <label for="addressInput" class="form-label">Địa chỉ <sup>*</sup></label>
                    <input type="text" class="form-control" id="addressInput"
                           placeholder="Nhập địa chỉ của bạn">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-primary">Lưu địa chỉ</button>
        </div>
    </div>
</div>
