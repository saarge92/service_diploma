@extends('layouts.frontend') 
@section('title') Домашняя страница
@endsection
 
@section('content')
    @include('frontend.partials.slider')
    @include('frontend.partials.about')
    @include('frontend.partials.services')
    @include('frontend.partials.team')
    @include('frontend.partials.contact')
@endsection
 
@section('scripts')
<script src="{{URL::asset('frontend/js/cartMain.js')}}"></script>
@endsection