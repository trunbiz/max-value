{{--@extends('user.layouts.master')--}}

{{--@include('user.'.$prefixView.'.header')--}}

{{--@section('css')--}}


{{--@endsection--}}

{{--@section('content')--}}

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xxl-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{route('user.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            @include('user.components.require_input_text' , ['name' => 'email' , 'label' => 'Email'])--}}

{{--                            @include('user.components.select_category' , ['label' => 'Type', 'name' => 'withdraw_type_id' ,'html_category' => \App\Models\WithdrawType::getCategory(isset($item) ? optional($item)->withdraw_type_id : ''),'isDefaultFirst' => true])--}}

{{--                            @include('user.components.button_save')--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--@endsection--}}

{{--@section('js')--}}


{{--@endsection--}}


<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <form autocomplete="off">
            <div class="modal-body">
                <div class="modal-payment__title">
                    Add payment method
                </div>
                <div class="modal-payment__choose">Choose Paymend Method&nbsp<span class="text-danger">*</span></div>
                <div class="modal-payment__group">
                    <div class="modal-payment__group--icons"></div>
                    <div class="modal-payment__select">
                        <select class="form-select form-control" name="method" aria-label="Default select example" onchange="chooseMethod()">
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="infoMethod"></div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-cancel filter__button" id="submit" onclick="storeMethod()">Add now</button>
            </div>
        </form>
    </div>
</div>

<script>
    chooseMethod()
</script>

