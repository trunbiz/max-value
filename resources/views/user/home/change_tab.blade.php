@if(count($orders) > 1)
    <div class="infoAcc-content__wapper">
        <div class="infoAcc-content__cover waitConfirm">
            <div class="infoAcc-content__list">
                @foreach($orders as $order)
                    <div class="infoAcc-content__item">
                        <div class="infoAcc-content__product">
                            <a href="#" class="infoAcc-content__img">
                                <img src="{{ optional($order->products)->product_image }}"
                                     alt="{{ optional($order->products)->name }}">
                            </a>
                            <div class="infoAcc-content__info">
                                <h4 class="infoAcc-content__title">
                                    <a href="#">{{ optional($order->products)->name }}</a>
                                </h4>
                                <p class="infoAcc-content__quantity">
                                    Số lượng: {{ optional($order->products)->quantity }}
                                </p>
                                <div class="infoAcc-content__money">
                                    <span class="money-name">Giá tiền:</span>
                                    <span class="money-new color-red">
                                                                        {{ number_format(optional($order->products)->price, '0', '', '.') }}₫
                                                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="infoAcc-content__status">
                {{ optional($order->status)->name }}
            </p>

            <!-- Total Price -->
            <div class="infoAcc-content__price">
                <div class="infoAcc-content__total">
                    <p>Thành tiền:</p>

                    <span class="number-total color-red">
                                                        1.319.000₫
                                                    </span>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="info-manage__body">
        <div height="200" width="200" class="info-manage__body-img">
            <img class="css-jdz5ak"
                 src="https://firebasestorage.googleapis.com/v0/b/mongcaifood.appspot.com/o/no-products-found.png?alt=media&amp;token=2f22ae28-6d48-49a7-a36b-e1a696618f9c"
                 loading="lazy" decoding="async">
        </div>
        <div class="info-manage__body-text">Bạn không có đơn hàng nào</div>
    </div>
@endif
