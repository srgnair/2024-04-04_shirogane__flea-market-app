@extends('commonWithSearchFunction')
@section('title')
<title>マイページ-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<script src="https://kit.fontawesome.com/ada21263c2.js" crossorigin="anonymous"></script>
@endsection
@section('content')

<div class="mypage__user-info">
    <div class="form__submit">
        {{ session('message') }}
    </div>
    <div class="form__submit">
        {{ session('error') }}
    </div>
    <div class="reserve__title">
        レビュー投稿
    </div>
    <div class="reserve__form">

        @if(Auth::id() === $transaction->buyer_id)
        <form class="form__wrapper" action="{{ route('postReviewBuyer', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="form">

                <div class="radioform__item">

                    <label for="rating5">
                        <input type="radio" name="rating" value="5" id="rating5" class="radioform__item--control">
                        @for($i=0; $i<5; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating4">
                        <input type="radio" name="rating" value="4" id="rating4" class="radioform__item--control">
                        @for($i=0; $i<4; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating3">
                        <input type="radio" name="rating" value="3" id="rating3" class="radioform__item--control">
                        @for($i=0; $i<3; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating2">
                        <input type="radio" name="rating" value="2" id="rating2" class="radioform__item--control">
                        @for($i=0; $i<2; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating1">
                        <input type="radio" name="rating" value="1" id="rating1" class="radioform__item--control">
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
        @elseif(Auth::id() === $transaction->seller_id)
        <form class="form__wrapper" action="{{ route('postReviewSeller', ['id' => $id]) }}" method="POST">
            @csrf
            <div class="form">

                <div class="radioform__item">

                    <label for="rating5">
                        <input type="radio" name="rating" value="5" id="rating5" class="radioform__item--control">
                        @for($i=0; $i<5; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating4">
                        <input type="radio" name="rating" value="4" id="rating4" class="radioform__item--control">
                        @for($i=0; $i<4; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating3">
                        <input type="radio" name="rating" value="3" id="rating3" class="radioform__item--control">
                        @for($i=0; $i<3; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating2">
                        <input type="radio" name="rating" value="2" id="rating2" class="radioform__item--control">
                        @for($i=0; $i<2; $i++) <i class="fa-solid fa-star fa-2xs" style="color: #FFD43B;"></i>
                            @endfor
                    </label>

                    <label for="rating1">
                        <input type="radio" name="rating" value="1" id="rating1" class="radioform__item--control">
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