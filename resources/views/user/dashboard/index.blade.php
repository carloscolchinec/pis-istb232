@extends('layouts.app_enterprise')

@section('title', 'Dashboard')

@section('content')


<style>
    .container-section-center {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 89vh;
    }
</style>
  <div class="container-section-center">
  <div class="container text-center">


        <div class="container">
            <img style="width: 70%" src="{{ asset('img/logo.png') }}" alt="">
        </div>

    </div>
  </div>

@endsection
