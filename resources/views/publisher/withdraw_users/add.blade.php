@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-xxl-6">

                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label>
                                Your amount: ${{$user->money}}
                            </label>

                            @include('user.components.require_input_money' , ['name' => 'amount' , 'label' => 'Amount ($)'])


                            <div class="form-group mt-3">
                                <label>Wallet @include('user.components.lable_require')</label>
                                <select id="wallet_id"
                                        class="form-control choose_value select2_init @error('wallet_id') is-invalid @enderror"
                                        required
                                        name="wallet_id">
                                    @foreach($user->wallets as $wallet)
                                        <option value="{{$wallet->id}}">
                                            <strong>{{ optional($wallet->withdrawType)->name}}</strong> -
                                            Min: {{ optional($wallet->withdrawType)->min}} -
                                            Fee: {{ optional($wallet->withdrawType)->fee}}</option>
                                    @endforeach
                                </select>
                                @error('wallet_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            @include('user.components.button_save')
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@section('js')


@endsection

