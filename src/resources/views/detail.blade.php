@extends('commonWithSearchFunction')
@section('title')
<title>商品詳細-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
@endsection
@section('content')

<!-- AuthIdがseller_idでかつ表示中アイテムのtransaction_typeがpurchasedの場合にボタンを表示 -->

@if($item->transaction && $item->transaction->payment_method === 'customer_balance' && $item->transaction->transaction_type === 'waiting_payment' && $item->transaction->buyer_id === Auth::user()->id )
<div>
    購入を受け付けました。以下の口座に入金してください。
    <br>
    ×××
    <br>
    <button>入金完了</button>
    <!-- 振込完了ボタンを押すとステータスが変わる -->
</div>
@elseif(Auth::user()->id == $item->seller_id && $item->transaction->transaction_type == 'waiting_shipping')
<div class="message__update-status">
    商品が購入されました。発送しましたら以下のボタンを押してください。
    <form class="form__wrapper" action="{{ route('StatusCurrently', ['id' => $item->id] ) }}" method="POST">
        @csrf
        <button type="submit">発送しました</button>
    </form>
</div>
@elseif(Auth::id() == $item->buyer_id && $item->transaction->transaction_type == 'waiting_arrival')
<div>
    商品が発送されました。商品を受け取りましたら以下のボタンを押してください。
    <form class="form__wrapper" action="{{ route('StatusComplete', ['id' => $item->id] ) }}" method="POST">
        @csrf
        <button type="submit">商品を受け取りました</button>
    </form>
</div>
@elseif(Auth::id() == $item->buyer_id && $item->transaction->transaction_type == 'waiting_review_buyer')
<div class="review">
    以下のボタンから販売者の評価を完了させてください。
    <div class="admin__link">
        <a href="{{ route('reviewView',['id'=>$item->id]) }}">評価をする</a>
    </div>
</div>
@elseif(Auth::id() == $item->seller_id && $item->transaction->transaction_type == 'waiting_review_seller')
<div class="review">
    以下のボタンから購入者の評価を完了させてください。
    <div class="admin__link">
        <a href="{{ route('reviewView',['id'=>$item->id]) }}">評価をする</a>
    </div>
</div>
@endif

<div class="detail">

    <div class="detail__img">
        @foreach($itemImages as $itemImage)
        <!-- <img src="{{ asset('img/itemImage.png') }}" alt="イメージ画像"> -->
        <!-- <div class="card__image-container"> -->
        <div @if($item->transaction->transaction_type === 'listed') class="card" @else class="card__sold" @endif>
            <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
            <img class="card__item-image" src="{{ asset($itemImage->image) }}" alt="イメージ画像">
        </div>
        @endforeach
    </div>

    <div class="detail__item-info">

        <div class="detail__item-info--item">

            <div class="detail__item-info--title">
                {{ $item->item_name }}
            </div>
            <div class="detail__item-info--brand-name">
                {{ $item->brand_name }}
            </div>
            <div class="detail__item-info--price">
                ￥{{ number_format($item->price, 0, '.', ',') }}
            </div>

            <div class="detail__item-info--icon-wrapper">
                <div class="detail__item-info--icon">
                    <div class="detail__item-info--star">

                        @if(Auth::check() && Auth::user()->is_like($item->id))
                        <form action="{{ route('deleteLike', ['item_id' => $item->id] ) }}" method="POST" class="mb-4">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <button type="submit">
                                <i class="fa-regular fa-star fa-xl" style="color: #ff5555;"></i>
                            </button>
                            <div class=" detail__item-info--number">{{ $likes->count() }}
                            </div>
                        </form>
                        @else
                        <form action="{{ route('like', ['item_id' => $item->id])  }}" method="POST" class="mb-4">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <button type="submit">
                                <i class="fa-regular fa-star fa-xl"></i>
                            </button>
                            <div class=" detail__item-info--number">{{ $likes->count() }}
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="detail__item-info--icon">
                    <form action="{{ route('commentView', ['item_id' => $item->id])  }}" method="GET" class="mb-4">
                        @csrf
                        <!-- <input type="hidden" name="item_id" value="{{$item->id}}"> -->
                        <button type="submit">
                            <i class="fa-regular fa-comment fa-xl"></i>
                        </button>
                        <div class=" detail__item-info--number">{{ $comments->count() }}
                        </div>
                    </form>
                </div>
            </div>
            <div class="detail__item-info--button-to-buy">
                <!-- 購入確認ページへ遷移 -->
                <!-- item_idを渡す -->
                @if($item->transaction->transaction_type === 'listed')
                <a href="{{ route('confirmPurchaseView', ['item_id' => $item->id]) }}">
                    <button>
                        購入する
                    </button>
                </a>
                @else
                <button>
                    こちらの商品は購入済みです
                </button>
                @endif
            </div>

        </div>

        <div class="detail__item-info--item">
            <div class="detail__item-info--title">
                商品説明
            </div>
            <div class="detail__item-info--comment">
                {{ $item->description }}
            </div>
        </div>

        <div class="detail__item-info--item">
            <div class="detail__item-info--title">
                商品の情報
            </div>
            <div class="detail__item-info--item-wrapper">
                <div class="category__title">
                    カテゴリー
                </div>
                @foreach($itemCategories as $itemCategory)
                <div class="category__item">
                    {{ $itemCategory->category }}
                </div>
                @endforeach
            </div>
            <div class="detail__item-info--item-condition-wrapper">
                <div class="condition__title">
                    商品の状態
                </div>
                <div class="condition__item">
                    {{ $item->condition }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection