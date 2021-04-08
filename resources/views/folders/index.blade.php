@extends('layouts.app')
@section('content')
    <h4>{{ $folder->name }}</h4>
    <p><strong>ツイート</strong></p>
    @if($tweets->isEmpty())
        <p>まだツイートの分類はされていません</p>
    @else
        @foreach($tweets as $tweet)
            <li>{{ $tweet->text }}</li>
        @endforeach
    @endif
@endsection