@extends('adminlte::page')

@section('content_header')
    <h1>{{ $pageTitle }}</h1>
@endsection

@section('content')
    @include('partial.crud.show_form')
@endsection