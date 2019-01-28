@extends('layouts.frontend') 
@section('title') Домашняя страница
@endsection
 
@section('content')
    @include('frontend.partials.slider')
    @include('frontend.partials.about')
    @include('frontend.partials.services')
@endsection