@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Tasklist</h1>
            @if (Auth::check())
                {{ Auth::user()->name }}
            
            @else
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', '登録!', [], ['class' => 'btn btn-lg btn-success']) !!}
                {{-- ログインページへのリンク --}}
                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
            @endif
        </div>
    </div>
@endsection