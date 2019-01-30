@extends('layouts.frontend') 
@section('title') Домашняя страница
@endsection
 
@section('content')
    @include('frontend.partials.slider')
    @include('frontend.partials.about')
    @include('frontend.partials.services')
@endsection
 
@section('scripts')
<script src="{{URL::asset('frontend/js/cart.js')}}"></script>
@endsection