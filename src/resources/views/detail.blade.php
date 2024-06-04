@extends('commonWithSearchFunction')
@section('title')
<title>商品詳細-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/like.js') }}"></script>
@endsection
@section('content')

@if(Auth::check() && $item->transaction && $item->transaction->payment_method === 'customer_balance' && $item->transaction->transaction_type === 'waiting_payment' && $item->transaction->buyer_id === Auth::user()->id )
<div>
    購入を受け付けました。以下の口座に入金してください。
    <br>
    （こちらに口座情報を表示）
    <br>
    <button>入金完了</button>
</div>
@elseif(Auth::check() && Auth::user()->id == $item->seller_id && $item->transaction->transaction_type == 'waiting_shipping')
<div class="message__update-status">
    商品が購入されました。発送しましたら以下のボタンを押してください。
    <form class="form__wrapper" action="{{ route('StatusCurrently', ['id' => $item->id] ) }}" method="POST">
        @csrf
        <button type="submit">発送しました</button>
    </form>
</div>
@elseif(Auth::check() && Auth::id() == $item->buyer_id && $item->transaction->transaction_type == 'waiting_arrival')
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
        <div @if($item->transaction->transaction_type === 'listed') class="card" @else class="card__sold" @endif>
            <img class="card__background-image" src="{{ asset('img/grayBack.png') }}" alt="グレーの背景">
            <img class="card__item-image" src="{{ asset($itemImage->image) }}" alt="イメージ画像">
        </div>
        @endforeach
    </div>

    <div class="detail__item-info">

        <div class="detail__item-info--item">

            <div class="detail__item-info--title">
                <h2>{{ $item->item_name }}</h2>
            </div>
            <div class="detail__item-info--brand-name">
                <p>{{ $item->brand_name }}</p>
            </div>
            <div class="detail__item-info--price">
                <p>￥{{ number_format($item->price, 0, '.', ',') }}</p>
            </div>

            <div class="detail__item-info--icon-wrapper">
                <div class="detail__item-info--icon">
                    <div class="detail__item-info--star">
                        @if(Auth::check() && Auth::user()->is_like($item->id))
                        <form action="{{ route('deleteLike', ['item_id' => $item->id] ) }}" method="POST" class="like-form mb-4">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                            <button type="submit" class="like-button">
                                <i class="fa fa-star fa-xl" style="color: #ff5555;"></i>
                            </button>
                            <div class="detail__item-info--number">{{ $likes->count() }}</div>
                        </form>
                        @else
                        <form action="{{ route('like', ['item_id' => $item->id]) }}" method="POST" class="like-form mb-4">
                            @csrf
                            <input type="hidden" name="item_id" value="{{$item->id}}">
                            <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                            <button type="button" class="like-button">
                                <i class="fa fa-star-o fa-xl"></i>
                            </button>
                            <div class="detail__item-info--number">{{ $likes->count() }}</div>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="detail__item-info--icon">
                    <form action="{{ route('commentView', ['item_id' => $item->id])  }}" method="GET" class="mb-4">
                        @csrf
                        <button type="submit">
                            <i class="fa-regular fa-comment fa-xl"></i>
                        </button>
                        <div class=" detail__item-info--number">{{ $comments->count() }}
                        </div>
                    </form>
                </div>
            </div>
            <div class="detail__item-info--button-to-buy">
                @if(!Auth::check())
                <a href="{{ Auth::check() ? route('confirmPurchaseView', ['item_id' => $item->id]) : '#' }}" title="{{ Auth::check() ? '' : '購入するにはログインが必要です' }}">
                    <button {{ Auth::check() ? '' : 'disabled' }}>
                        購入するにはログインが必要です。
                    </button>
                </a>
                @elseif($item->transaction->transaction_type === 'listed')
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
                <h2>商品説明</h2>
            </div>
            <div class="detail__item-info--comment">
                <p>{{ $item->description }}</p>
            </div>
        </div>

        <div class="detail__item-info--item">
            <div class="detail__item-info--title">
                <h2>商品の情報</h2>
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

<div>
    <div>
        出品者情報
    </div>
    <div>
        <img src=" {{ asset($seller_information->img)}}" alt="イメージ画像">
    </div>
    <div>
        {{ $seller_information->user_name }}
    </div>
    <div>
        <a href="{{ route('showReviews', ['seller_id' => $seller_information->id]) }}">
            レビュー一覧ページ
        </a>
    </div>
</div>

<script>
    const routes = {
        like: <?php echo json_encode(route('like', ['item_id' => 'ITEM_ID_PLACEHOLDER'])); ?>,
        deleteLike: <?php echo json_encode(route('deleteLike', ['item_id' => 'ITEM_ID_PLACEHOLDER'])); ?>
    };
</script>


@endsection