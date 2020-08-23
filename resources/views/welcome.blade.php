@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Tasklist</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '登録!', [], ['class' => 'btn btn-lg btn-success']) !!}
        </div>
    </div>
@endsection