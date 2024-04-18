@extends('commonWithSearchFunction')
@section('title')
<title>商品詳細-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="detail">

    <div class="detail__img">
        @foreach($itemImages as $itemImage)
        <img src="{{ asset('img/itemImage.png') }}" alt="イメージ画像">
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
                        @if(Auth::check() && Auth::user()->is_like($item->item_id))
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
                        <input type="hidden" name="item_id" value="{{$item->id}}">
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
                <a href="{{ route('confirmPurchaseView', ['item_id' => $item->id]) }}">
                    <button>
                        購入する
                    </button>
                </a>
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
            <div class="detail__item-info--item-wrapper">
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