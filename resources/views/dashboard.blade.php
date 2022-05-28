@extends('layouts.app')
@section('title','Home')
@section('top_scripts')
@endsection
@section('style')
@endsection
@include('layouts.admin.navigation')
@section('content')
<div class="main-body">

    <div class="container-fluid">

        <section>
            <div class="row">
                <div class="col-md-2">
                    @include('layouts.admin.sidebar')
                </div>


            </div>
        </section>

    </div>
    @endsection
    @section('bottom_scripts')
    @endsection