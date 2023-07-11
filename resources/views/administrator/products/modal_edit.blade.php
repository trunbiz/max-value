<div class="col-md-12">
    <div>
        <div class="row">
            <div class="col-6">
                <div class="form-group mt-3">
                    <label>Tên sản phẩm @include('administrator.components.lable_require')</label>
                    <input id="input_name" type="text" autocomplete="off" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{$item->name}}" required>
                    @error('name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Sku_ID</label>
                    <input id="input_sku_id" type="text" autocomplete="off" name="sku_id"
                           class="form-control @error('sku_id') is-invalid @enderror"
                           value="{{$item->sku_id}}" required>
                    @error('sku_id')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Bảo hành (tháng)</label>
                    <input id="input_warranty" type="text" autocomplete="off" name="warranty"
                           class="form-control @error('warranty') is-invalid @enderror"
                           value="{{$item->warranty}}" required>
                    @error('warranty')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Seller_sku</label>
                    <input id="input_seller_sku" type="text" autocomplete="off" name="seller_sku"
                           class="form-control @error('seller_sku') is-invalid @enderror"
                           value="{{$item->seller_sku}}" required>
                    @error('seller_sku')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Đơn vị (Hộp, vỉ, ...)</label>
                    <input id="input_uom_name" type="text" autocomplete="off" name="uom_name"
                           class="form-control @error('uom_name') is-invalid @enderror"
                           value="{{$item->uom_name}}" required>
                    @error('uom_name')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Barcode</label>
                    <input id="input_barcode" type="text" autocomplete="off" name="barcode"
                           class="form-control @error('barcode') is-invalid @enderror"
                           value="{{$item->barcode}}" required>
                    @error('barcode')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Tồn kho</label>
                    <input id="input_inventory" type="number" autocomplete="off" name="inventory" class="form-control @error('inventory') is-invalid @enderror"
                           value="{{$item->inventory}}" required>
                    @error('inventory')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Giá nhà cung cấp</label>
                    <input id="input_supplier_retail_price" type="text" autocomplete="off" name="supplier_retail_price"
                           class="form-control @error('supplier_retail_price') is-invalid @enderror"
                           value="{{$item->supplier_retail_price}}" required>
                    @error('supplier_retail_price')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Giá giảm</label>
                    <input id="input_terminal_price" type="text" autocomplete="off" name="terminal_price"
                           class="form-control @error('terminal_price') is-invalid @enderror"
                           value="{{$item->terminal_price}}" required>
                    @error('terminal_price')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Giá mới nhất</label>
                    <input id="input_latest_price" type="text" autocomplete="off" name="latest_price"
                           class="form-control @error('latest_price') is-invalid @enderror"
                           value="{{$item->latest_price}}" required>
                    @error('latest_price')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Số lượng giảm giá</label>
                    <input id="input_discount_amount" type="text" autocomplete="off" name="discount_amount"
                           class="form-control @error('discount_amount') is-invalid @enderror"
                           value="{{$item->discount_amount}}" required>
                    @error('discount_amount')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="form-group mt-3 d-none">
                    <label>Sku</label>
                    <input id="input_sku" type="text" autocomplete="off" name="sku"
                           class="form-control @error('sku') is-invalid @enderror"
                           value="{{$item->sku}}" required>
                    @error('sku')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Phần trăm giảm giá</label>
                    <input id="input_discount_percent" type="text" autocomplete="off" name="discount_percent"
                           class="form-control @error('discount_percent') is-invalid @enderror"
                           value="{{$item->discount_percent}}" required>
                    @error('discount_percent')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Giá bán</label>
                    <input id="input_sell_price" type="text" autocomplete="off" name="sell_price"
                           class="form-control @error('sell_price') is-invalid @enderror"
                           value="{{$item->sell_price}}" required>
                    @error('sell_price')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Giá bán thấp nhất</label>
                    <input id="input_minLatest_price" type="text" autocomplete="off" name="minLatest_price"
                           class="form-control @error('minLatest_price') is-invalid @enderror"
                           value="{{$item->minLatest_price}}" required>
                    @error('minLatest_price')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Giá bán cao nhất</label>
                    <input id="input_maxLatest_price" type="text" autocomplete="off" name="maxLatest_price"
                           class="form-control @error('maxLatest_price') is-invalid @enderror"
                           value="{{$item->maxLatest_price}}" required>
                    @error('maxLatest_price')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Hình thức vận chuyển</label>
                    <input id="input_shipping_type" type="text" autocomplete="off" name="shipping_type"
                           class="form-control @error('shipping_type') is-invalid @enderror"
                           value="{{$item->shipping_type}}" required>
                    @error('shipping_type')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label>Mã danh mục</label>
                    <select id="input_category_id" class="form-control select2_init" name="category_id">
                        <option value="0">Chọn danh mục</option>
                        @foreach(\App\Models\Category::all() as $itemCategory)
                            <option
                                value="{{$itemCategory->id}}" {{$itemCategory->id == $item->category_id ? 'selected' : ''}}>{{$itemCategory->name}}</option>

                        @endforeach

                    </select>

                </div>
                <div class="form-group mt-3">
                    <label>Mã nhân viên bán</label>
                    <select id="input_seller_id" class="form-control select2_init" name="seller_id">
                        <option value="0">Chọn nhân viên</option>
                        @foreach(\App\Models\Seller::all() as $itemSeller)
                            <option
                                value="{{$itemSeller->id}}" {{$itemSeller->id== $item->seller_id ? 'selected':''}}>{{$itemSeller->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label>Mã nhà cung cấp</label>
                    <select id="input_provider_id" class="form-control select2_init" name="provider_id">
                        <option value="0">Chọn nhà cung cấp</option>
                        @foreach(\App\Models\Provider::all() as $itemProvider)
                            <option
                                value="{{$itemProvider->id}}" {{$itemProvider->id == $item->prodiver_id ? 'selected' : ''}}>{{$itemProvider->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label>Mã chi nhánh</label>
                    <select id="input_brand_id" class="form-control select2_init" name="brand_id">
                        <option value="0">Chọn chi nhánh</option>
                        @foreach(\App\Models\Brand::all() as $itemBrand)
                            <option
                                value="{{$itemBrand->id}}" {{$itemBrand->id==$item->brand_id ? 'selected' :''}}>{{$itemBrand->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3 d-none">
                    <label>Mã thuế</label>
                    <select id="input_tax_id" class="form-control select2_init" name="tax_id">
                        <option value="0">Chọn chi nhánh</option>
                        @foreach(\App\Models\Tax::all() as $itemTax)
                            <option
                                value="{{$itemTax->id}}" {{$itemTax->id==$item->tax_id ?'selected':''}}>{{$itemTax->taxOut}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
        </div>



    </div>




    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="onSubmitEditProduct({{$item->id}})">Save</button>
    </div>


</div>

@section('js')
@endsection
