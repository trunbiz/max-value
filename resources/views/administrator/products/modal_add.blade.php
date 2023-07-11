<div class="col-md-12">
    <div class ="row">

        <div class="col-6">
            <div class="form-group mt-3">
                <label>Tên sản phẩm @include('administrator.components.lable_require')</label>
                <input id="input_name" type="text" autocomplete="off" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="" required>
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Sku @include('administrator.components.lable_require')</label>
                <input id="input_sku" type="text" autocomplete="off" name="sku" class="form-control @error('sku') is-invalid @enderror"
                       value="" required>
                @error('sku')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Sku_ID</label>
                <input id="input_sku_id" type="text" autocomplete="off" name="sku_id" class="form-control @error('sku_id') is-invalid @enderror"
                       value="" required>
                @error('sku_id')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Bảo hành (tháng)</label>
                <input id="input_warranty" type="number" autocomplete="off" name="warranty" class="form-control @error('warranty') is-invalid @enderror"
                       value="" required>
                @error('warranty')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Seller_sku</label>
                <input id="input_seller_sku" type="text" autocomplete="off" name="seller_sku" class="form-control @error('seller_sku') is-invalid @enderror"
                       value="" required>
                @error('seller_sku')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Đơn vị (hộp, vỉ, ...) @include('administrator.components.lable_require')</label>
                <input id="input_uom_name" type="text" autocomplete="off" name="uom_name" class="form-control @error('uom_name') is-invalid @enderror"
                       value="" required>
                @error('uom_name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Barcode</label>
                <input id="input_barcode" type="text" autocomplete="off" name="barcode" class="form-control @error('barcode') is-invalid @enderror"
                       value="" required>
                @error('barcode')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Tồn kho</label>
                <input id="input_inventory" type="number" autocomplete="off" name="inventory" class="form-control @error('inventory') is-invalid @enderror"
                       value="" required>
                @error('inventory')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group mt-3 d-none">
                <label>Giá nhà cung cấp</label>
                <input id="input_supplier_retail_price" type="number" autocomplete="off" name="supplier_retail_price" class="form-control @error('supplier_retail_price') is-invalid @enderror"
                       value="" required>
                @error('supplier_retail_price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Giá giảm</label>
                <input id="input_terminal_price" type="number" autocomplete="off" name="terminal_price" class="form-control @error('terminal_price') is-invalid @enderror"
                       value="" required>
                @error('terminal_price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Giá mới nhất</label>
                <input id="input_latest_price" type="number" autocomplete="off" name="latest_price" class="form-control @error('latest_price') is-invalid @enderror"
                       value="" required>
                @error('latest_price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Số lượng giảm giá</label>
                <input id="input_discount_amount" type="number" autocomplete="off" name="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror"
                       value="" required>
                @error('discount_amount')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group mt-3 d-none">
                <label>Phần trăm giảm giá</label>
                <input id="input_discount_percent" type="number" autocomplete="off" name="discount_percent" class="form-control @error('discount_percent') is-invalid @enderror"
                       value="" required>
                @error('discount_percent')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Giá bán @include('administrator.components.lable_require')</label>
                <input id="input_sell_price" type="number" autocomplete="off" name="sell_price" class="form-control @error('sell_price') is-invalid @enderror"
                       value="" required>
                @error('sell_price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Giá bán thấp nhất</label>
                <input id="input_minLatest_price" type="number" autocomplete="off" name="minLatest_price" class="form-control @error('minLatest_price') is-invalid @enderror"
                       value="" required>
                @error('minLatest_price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3 d-none">
                <label>Giá bán cao nhất</label>
                <input id="input_maxLatest_price" type="number" autocomplete="off" name="maxLatest_price" class="form-control @error('maxLatest_price') is-invalid @enderror"
                       value="" required>
                @error('maxLatest_price')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Hình thức vận chuyển</label>
                <input id="input_shipping_type" type="text" autocomplete="off" name="shipping_type" class="form-control @error('shipping_type') is-invalid @enderror"
                       value="" required>
                @error('shipping_type')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label>Mã danh mục</label>
                <select id="input_category_id" class="form-control select2_init" name="category_id">
                    @foreach($categories as $itemCategory)
                        <option value="{{$itemCategory->id}}">{{$itemCategory->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group mt-3">
                <label>Mã nhân viên bán</label>
                <select id="input_seller_id" class="form-control select2_init" name="seller_id">
                    <option value="0">Chọn nhân viên </option>
                    @foreach($sellers as $itemSeller)
                        <option value="{{$itemSeller->id}}">{{$itemSeller->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label>Mã nhà cung cấp</label>
                <select id="input_provider_id" class="form-control select2_init" name="provider_id">
                    <option value="0">Chọn nhà cung cấp </option>
                    @foreach($providers as $itemProvider)
                        <option value="{{$itemProvider->id}}">{{$itemProvider->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3 d-none">
                <label>Mã chi nhánh</label>
                <select id="input_brand_id" class="form-control select2_init" name="brand_id">
                    <option value="0">Chọn chi nhánh </option>
                    @foreach($brands as $itemBrand)
                        <option value="{{$itemBrand->id}}">{{$itemBrand->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3 d-none">
                <label>Mã thuế</label>
                <select id="input_tax_id" class="form-control select2_init" name="tax_id">
                    <option value="0">Chọn chi nhánh </option>
                    @foreach($taxes as $itemTax)
                        <option value="{{$itemTax->id}}">{{$itemTax->taxOut}}</option>

                    @endforeach
                </select>
            </div>
        </div>
    </div>

    </div>



    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="onSubmitAddProduct()">Save</button>
    </div>


</div>
@section('js')

@endsection

