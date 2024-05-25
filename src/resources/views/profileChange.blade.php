@extends('commonWithSearchFunction')
@section('title')
<title>プロフィール設定-coachtechフリマ-</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/profileChange.css') }}">
@endsection
@section('content')
<div class="profile-change">
    <form class="form__wrapper" action="{{ route('profileChange') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-change__title">
            プロフィール設定
        </div>
        @error('img')
        <p>{{$errors->first('img')}}</p>
        @enderror
        @error('user_name')
        <p>{{$errors->first('user_name')}}</p>
        @enderror
        @error('post_code')
        <p>{{$errors->first('post_code')}}</p>
        @enderror
        @error('address')
        <p>{{$errors->first('address')}}</p>
        @enderror
        @error('building_name')
        <p>{{$errors->first('building_name')}}</p>
        @enderror
        <div class="profile-change__form">
            <div class="profile-change__form--img">
                <!-- <div class="form__img--img">
                    @if (Auth::check() && Auth::user()->img !== null)
                    <img id="thumbnail" accept="image/*" src="{{ asset($userProfile->img) }}" alt="イメージ画像">
                    @else
                    <img id="thumbnail" accept="image/*" src="{{ asset('img/sampleUserImage.png') }}" alt="イメージ画像">
                    @endif
                </div> -->
                <div class="form__img--img">
                    <img id="thumbnail" accept="image/*" src="{{ Auth::check() && Auth::user()->img !== null ? asset($userProfile->img) : asset('img/sampleUserImage.png') }}" alt="イメージ画像">
                </div>

                <div class="form__img--select-button">
                    <!-- <label for="img">商品画像</label> -->
                    <div class="form__item--border">
                        <!-- <div class="form__image--select-button">
                            <input class="form__item--control" type="file" name="img">
                        </div> -->
                        <input type="file" onchange="onChangeFileInput(this)" id="fileElem" multiple accept="image/*" style="display:none" name="img" />
                        <button id="fileSelect" type="button">画像を選択する</button>
                        <script src="{{ asset('/js/thumbnail.js') }}"></script>
                    </div>
                </div>
            </div>
            <div class="form__item">
                <label for="user_name">ユーザー名</label>
                <input type="text" name="user_name" value="{{ $userProfile->user_name }}" />
            </div>
            <div class="form__item">
                <label for="post-code">郵便番号</label>
                <input type="text" name="post_code" value="{{ $userProfile->post_code }}" />
            </div>
            <div class="form__item">
                <label for="address">住所</label>
                <input type="text" name="address" value="{{ $userProfile->address }}" />
            </div>
            <div class="form__item">
                <label for="building_name">建物名</label>
                <input type="text" name="building_name" value="{{ $userProfile->building_name }}" />
            </div>
            <input type="hidden" name="email" value="{{ $userProfile->email }}">
            <input type="hidden" name="password" value="{{ $userProfile->password }}">
        </div>
        <div class="form__submit">
            <button>更新する</button>
        </div>
    </form>
</div>
@endsection