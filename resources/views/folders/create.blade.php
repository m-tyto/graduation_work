@extends('layouts.app')
@section('content')

    @foreach($errors->all() as $error)
        <li><strong>{{$error}}</strong></li>
    @endforeach
    <form action="{{ route('folder_store') }}" method='post'>
        @csrf
        <p>フォルダ名</p>
        <input type="text" name="name">
        <input type="hidden" name="user_id" value='{{ Auth::id() }}'>
        <input type="submit" value="作成">
    </form>

@endsection