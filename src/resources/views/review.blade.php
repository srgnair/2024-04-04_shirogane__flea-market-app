@extends('commonWithSearchFunction')
@section('title')
<title>マイページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="review">
    <div class="review__form-submit">
        {{ session('message') }}
    </div>
    <div class="review__form-submit">
        {{ session('error') }}
    </div>
    <div class="review__title">
        レビュー投稿
    </div>
    <div class="review__form">

        @if(Auth::id() === $transaction->buyer_id)
        <form class="review__form--form-wrapper" action="{{ route('postReviewBuyer', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="review__form--form">

                <div class="review__form--form-item">

                    <label for="rating5">
                        <input type="radio" name="rating" value="5" id="rating5" class="review__form--item--control">
                        @for($i=0; $i<5; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating4">
                        <input type="radio" name="rating" value="4" id="rating4" class="review__form--item--control">
                        @for($i=0; $i<4; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating3">
                        <input type="radio" name="rating" value="3" id="rating3" class="review__form--item--control">
                        @for($i=0; $i<3; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating2">
                        <input type="radio" name="rating" value="2" id="rating2" class="review__form--item--control">
                        @for($i=0; $i<2; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating1">
                        <input type="radio" name="rating" value="1" id="rating1" class="review__form--item--control">
                        @for($i=0; $i<1; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                </div>

                <div class="review__form--textarea">
                    <textarea id="inputDate" type="text" name="comment" value="{{ old('email') }}" placeholder="こちらにレビューを入力してください"></textarea>
                </div>
            </div>
            <div class="review__form--submit">
                <button type="submit">投稿する</button>
            </div>

        </form>
        @elseif(Auth::id() === $transaction->seller_id)
        <form class="review__form--form-wrapper" action="{{ route('postReviewSeller', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="review__form--form">

                <div class="review__form--form-item">

                    <label for="rating5">
                        <input type="radio" name="rating" value="5" id="rating5" class="review__form--item--control">
                        @for($i=0; $i<5; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating4">
                        <input type="radio" name="rating" value="4" id="rating4" class="review__form--item--control">
                        @for($i=0; $i<4; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating3">
                        <input type="radio" name="rating" value="3" id="rating3" class="review__form--item--control">
                        @for($i=0; $i<3; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating2">
                        <input type="radio" name="rating" value="2" id="rating2" class="review__form--item--control">
                        @for($i=0; $i<2; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating1">
                        <input type="radio" name="rating" value="1" id="rating1" class="review__form--item--control">
                        @for($i=0; $i<1; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                </div>

                <div class="form__item--textarea">
                    <textarea id="inputDate" class="radioform__item--comment" type="text" name="comment" value="{{ old('email') }}" placeholder="こちらにレビューを入力してください"></textarea>
                </div>
            </div>
            <div class="form__submit">
                <button type="submit">投稿する</button>
            </div>

        </form>
    </div>
    @endif
</div>


@endsection