@extends('commonWithSearchFunction')
@section('title')
<title>決済ページ</title>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="container">
    @if (session('flash_alert'))
    <div class="alert alert-danger">{{ session('flash_alert') }}</div>
    @elseif(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="p-5">
        <div class="payment">
            <div class="payment__title">
                決済
            </div>
            <div class="payment__content">
                <form id="card-form" action="{{ route('payment.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="card_number">カード番号</label>
                        <input type="text" class="form-control" id="card_number" name="card_number">
                    </div>

                    <div>
                        <label for="card_expiry">有効期限</label>
                        <input type="text" class="form-control" id="card-expiry" name="card-expiry">
                    </div>

                    <div>
                        <label for="card-cvc">セキュリティコード</label>
                        <input type="text" class="form-control" id="card-cvc" name="card-cvc">
                    </div>

                    <div id="card-errors" class="text-danger"></div>

                    <button class="mt-3 btn btn-primary">支払い</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    /* 基本設定*/
    const stripe_public_key = "{{ config('stripe.pk_key') }}";
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
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>

@endsection