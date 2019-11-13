@extends('layouts.app')

@section('content')



@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{asset('css/apiuser.profile.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/apiuser.profile.js')}}"></script>
@endsection