@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    {{--    <div class="container-fluid list-products">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-12">--}}

    {{--                <div class="card">--}}

    {{--                    <div class="card-body">--}}

    {{--                        @include('user.components.checkbox_delete_table')--}}

    {{--                        <div class="table-responsive product-table">--}}
    {{--                            <table class="table table-hover ">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th>Amount</th>--}}
    {{--                                    <th>Description</th>--}}
    {{--                                    <th>Created</th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody>--}}
    {{--                                @foreach($items as $item)--}}
    {{--                                    <tr>--}}
    {{--                                        <td>--}}
    {{--                                            {!! (float) $item->amount < 0 ? "<p class='text-danger'>".$item->amount."$</p>" : "<p class='text-success'>".$item->amount."$</p>"!!}--}}
    {{--                                        </td>--}}
    {{--                                        <td>--}}
    {{--                                            {{ $item->description}}--}}
    {{--                                        </td>--}}
    {{--                                        <td>{{$item->created_at}}</td>--}}
    {{--                                    </tr>--}}
    {{--                                @endforeach--}}

    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                        </div>--}}
    {{--                        <div>--}}
    {{--                            @include('user.components.footer_table')--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--            </div>--}}

    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <style>--}}
    {{--        .product-table span, .product-table p {--}}
    {{--            color: #fff;--}}
    {{--        }--}}
    {{--    </style>--}}

    <div class="content-main">
        <div class="list__payment">
            <a href="{{ route('user.wallet_users.index') }}" class="list__payment--item">
                <img src="{{ asset('assets/user/images/dashboard.svg') }}" alt="">
                Overview
            </a>
            <a href="{{ route('user.withdraw_users.index') }}" class="list__payment--item">
                <img src="{{ asset('assets/user/images/order.svg') }}" alt="">
                Payment Orders
            </a>
            <a href="{{ route('user.transection_users.index') }}" class="list__payment--item">
                <img src="{{ asset('assets/user/images/transaction.svg') }}" alt="">
                Transactions
            </a>
            <a href="{{ route('user.preferences_users.index') }}" class="list__payment--item active">
                <img src="{{ asset('assets/user/images/payment.svg') }}" alt="">
                Payment Preferences
            </a>
        </div>
        <div class="row">
            <div id="payment">
                <ul>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2>Billing Information</h2>
                        <form action="" autocomplete="off" class="payment__method">
                            <h3 class="form__title text-primary">Billing Address</h3>
                            <div class="form-billind-address row">
                                <div class="col-md-6 col-12">
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="billFrom">Bill from</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="billFrom" placeholder="Bill from *" class="form-control" name="billfrom">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="addressFirst">Address / First line</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="addressFirst" placeholder="Address / First line *" class="form-control" name="address_first">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label for="addressSecond">Address / Second line</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="addressSecond" placeholder="Address / Second line" class="form-control" name="address_second">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label for="VAT">VAT number</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="VAT" placeholder="VAT number" class="form-control" name="vat">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="city">City</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="city" placeholder="City *" class="form-control" name="city">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="zipCode">Zip / Post Code</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="zipCode" placeholder="Zip / Post Code *" class="form-control" name="zip_code">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label for="state">State</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="state" placeholder="State" class="form-control" name="state">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="country">Country</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="country" placeholder="Country *" class="form-control" name="country">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <h3 class="form__title text-primary">Billing Contact Detail</h3>
                            <div class="form-billind-address row">
                                <div class="col-md-6 col-12">
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="firstName">First name</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="firstName" placeholder="First name *" class="form-control" name="first_name">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label for="lastName">Last name</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="lastName" placeholder="Last name" class="form-control" name="last_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label class="required__item" for="email">Email</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="text" id="email" placeholder="Email *" class="form-control" name="email">
                                        </div>
                                    </div>
                                    <div class="form-item row">
                                        <div class="col-md-4 col-12">
                                            <label for="phoneNumber">Phone number</label>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <input type="number" id="phoneNumber" placeholder="Phone number" class="form-control" name="phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <button class="filter__button">
                                Update now
                            </button>
                        </form>

                    </li>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2>Payment Methods</h2>
                        <form class="row payment__method">
                            <div class="col-md-6 col-12" id="list_method">
                                <div class="table__list">
                                    <div class="title__list-method">
                                        <h2>Default / Primary method</h2>
                                        <div class="payment__info">
                                            <div class="payment__info--payment">
                                                <div class="general__info--payment-icon">
                                                    <img src="./images/Payoneer-1.png" alt="">
                                                </div>
                                                <div class="payment__infoo--content">
                                                    <p class="name__payment">Payoneer</p>
                                                    <a href="mailto:demo123@gmail.com">demo123@gmail.com</a>
                                                </div>
                                            </div>
                                            <div class="btn__action-payment">
                                                <div class="payment__info--action">
                                                    <a href="/payment.html" class="btn__payment">Update information</a>
                                                </div>
                                                <div class="payment__info--action">
                                                    <a href="/payment.html" class="btn__payment">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <a class="card__add" data-bs-toggle="modal" data-bs-target="#addMethod">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.00183 17.3334C13.6042 17.3334 17.3352 13.6024 17.3352 9.00008C17.3352 4.39771 13.6042 0.666748 9.00183 0.666748C4.39942 0.666748 0.668457 4.39771 0.668457 9.00008C0.668457 13.6024 4.39942 17.3334 9.00183 17.3334ZM8.37683 12.1251C8.37683 12.4702 8.65658 12.7501 9.00183 12.7501C9.347 12.7501 9.62683 12.4702 9.62683 12.1251V9.62508H12.1268C12.472 9.62508 12.7518 9.34525 12.7518 9.00008C12.7518 8.65491 12.472 8.37508 12.1268 8.37508H9.62683V5.87508C9.62683 5.52991 9.347 5.25008 9.00183 5.25008C8.65658 5.25008 8.37683 5.52991 8.37683 5.87508V8.37508H5.87679C5.53162 8.37508 5.25179 8.65491 5.25179 9.00008C5.25179 9.34525 5.53162 9.62508 5.87679 9.62508H8.37683V12.1251Z" fill="#2FAFF8"></path></svg>
                                    <p>Add payment method</p>
                                </a>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="addMethod">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-payment__title">
                        Add payment method
                    </div>
                    <div class="modal-payment__choose">Choose Paymend Method</div>
                    <div class="modal-payment__group">
                        <div class="modal-payment__group--icons">
                            <img src="/images/Payoneer-1.png" alt="">
                        </div>
                        <div class="modal-payment__select">
                            <select class="form-select form-control" aria-label="Default select example">
                                <option value="">Choose</option>
                                <option value="1">Paypal</option>
                                <option value="2">Payoneer</option>
                                <option value="3">Ethereum</option>
                                <option value="4">Bitcoin</option>
                                <option value="5">Wire Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-payment__group">
                        <div class="modal-payment__group--box"></div>
                        <p class="content__threshold">(Minimum Payment Threshold: 50 USD)</p>
                    </div>
                    <div class="divider"></div>
                    <p class="text-danger">
                        Fields mark with <span>*</span> are required
                    </p>
                    <form action="" id="myFomr" autocomplete="off">
                        <div class="row form-group">
                            <div class="col-md-12 col-12">
                                <label for="emailMethod" class="required__item">Paypal Email</label>
                                <input type="email" name="form[email]" class="formInput form-control" placeholder="Paypal Email" id="emailMethod" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-cancel filter__button" id="submit" disabled>Add now</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection

