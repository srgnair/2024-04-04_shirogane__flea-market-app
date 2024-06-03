@extends('commonWithSearchFunction')
@section('title')
<title>商品名-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirmPurchase.css') }}">
<script src="{{ asset('/js/payment.js') }}"></script>
@endsection
@section('content')
<div class="form__submit">
    {{ session('message') }}
</div>
<div class="form__submit">
    {{ session('error') }}
</div>
@if($item->transaction && $item->transaction->payment_method === 'customer_balance' && $item->transaction->transaction_type === 'waiting_payment' && $item->transaction->buyer_id === Auth::user()->id )
<div>
    購入を受け付けました。以下の口座に入金してください。
    <br>
    (口座情報をこちらに表示)
</div>
@endif

<form id="card-form" class="form__wrapper" action="{{ route('purchase', ['item_id' => $item->id] ) }}" method="POST">
    @csrf
    <div class="confirm-purchase__container">

        <div class="container__left">

            <div class="container__img--wrapper">
                <div class="comment__img">
                    @foreach($itemImages as $itemImage)
                    <div class="card__image-container">
                        <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
                        <img class="card__item-image" src="{{ asset($itemImage->image) }}" alt="イメージ画像">
                    </div>
                    @endforeach
                </div>

                <div class="container__item-name--wrapper">
                    <div class="container__item-name">
                        {{ $item->item_name }}
                    </div>
                    <div class="container__item-price">
                        ￥{{ number_format($item->price, 0, '.', ',') }}
                    </div>
                </div>
            </div>

            <div class="container__payment-method--wrapper">
                <div class="container__payment-method">
                    <div class="payment-method__title">
                        支払い方法
                    </div>

                    <div class="paymentMethod">
                        @if($item->transaction->payment_method === 'card')
                        <div id="foodList">
                            <label>
                                <input type="hidden" name="payment_method" value="{{$item->transaction->payment_method}}"> クレジットカード決済
                            </label><br>
                            <label for="card-number">カード番号</label>
                            <div id="card-number" class="form-control"></div>

                            <div>
                                <label for="card_expiry">有効期限</label>
                                <div id="card-expiry" class="form-control"></div>
                            </div>

                            <div>
                                <label for="card-cvc">セキュリティコード</label>
                                <div id="card-cvc" class="form-control"></div>
                            </div>

                            <div id="card-errors" class="text-danger"></div>
                        </div>
                        @elseif($item->transaction->payment_method ==='customer_balance')
                        <label>
                            <input type="hidden" name="payment_method_types" value="{{$item->transaction->payment_method}}">
                        </label>銀行振込
                        @else
                        支払い方法を設定してください
                        @endif
                    </div>
                </div>
                <div class="container__shipping-address--change-button">
                    <a href="{{ route('paymentMethodView', ['item_id' => $item->id]) }}">
                        変更する
                    </a>
                </div>
            </div>

            <div class="container__shipping-address--wrapper">

                <div class="container__shipping-address">

                    <div class="container__shipping-address--title">
                        配送先
                    </div>

                    <div class="container__shipping-address--address">
                        <!-- エラー確認 -->
                        @if( $user->deliveryAddresses()->exists() )
                        {{ substr($user->deliveryAddresses()->first()->post_code, 0, 3) . '-' . substr($user->deliveryAddresses()->first()->post_code, 3) }}
                        {{ $user->deliveryAddresses()->first()->address }}
                        {{ $user->deliveryAddresses()->first()->building_name }}
                        @else
                        配送先を登録してください
                        @endif
                    </div>
                </div>

                <div class="container__shipping-address--change-button">

                    <a href="{{ route('shippingChangeView', ['item_id' => $item->id]) }}">
                        変更する
                    </a>

                </div>
            </div>

        </div>
        <div class="container__right">

            <div class="confirm-purchase__payment-info--table">
                <table>
                    <tbody>
                        <tr>
                            <th>商品代金</th>
                            <td>￥{{ number_format($item->price, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <th>支払い金額</th>
                            <td>￥{{ number_format($item->price, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <th>支払い方法</th>
                            <td>
                                @if($item->transaction->payment_method)
                                {{ $item->transaction->payment_method}}
                                @else
                                支払い方法を設定してください
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="confirm-purchase__payment-info--button">

                @if($transaction->transaction_type == 'listed')
                <button type="submit">購入する</button>
                @endif
                @if (session('flash_alert'))
                <div class="alert alert-danger">{{ session('flash_alert') }}</div>
                @elseif(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <!-- <p>{{ config('services.stripe.secret.key') }}</p> -->
            </div>
        </div>

    </div>

</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    /* 基本設定*/
    const stripe_public_key = "{{ config('services.stripe.public.key') }}"
    const stripe = Stripe(stripe_public_key);
    const elements = stripe.elements();

    var cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card-number');
    cardNumber.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');
    cardExpiry.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');
    cardCvc.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('card-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var errorElement = document.getElementById('card-errors');
        if (event.error) {
            errorElement.textContent = event.error.message;
        } else {
            errorElement.textContent = '';
        }

        stripe.createToken(cardNumber).then(function(result) {
            if (result.error) {
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('card-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput); // トークンをフォームに追加
        form.submit(); // フォームを送信
    }
</script>

@endsection