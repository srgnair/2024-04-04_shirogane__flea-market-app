@extends('commonWithSearchFunction')
@section('title')
<title>支払い方法設定-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/confirmPurchase.css') }}">
@endsection
@section('content')

<div class="payment-method">
    <form id="updatePaymentMethod" action="{{ route('updatePaymentMethod', ['item_id' => $item_id] ) }}" method="POST">
        @csrf
        <div class="payment-method__radio">
            <label>
                <input type="radio" name="payment_method" value="card" checked> クレジットカード決済
            </label><br>
            <label>
                <input type="radio" name="payment_method" value="customer_balance"> 銀行振込
            </label><br>
        </div>
        <div class="payment-method__submit">
            <button type="submit" id="updatePaymentMethod">変更する</button>
        </div>
    </form>

    @endsection