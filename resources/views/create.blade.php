@extends('layouts.app')

@section('content')
<div class="row m-0 h-100">
    <div style="position: relative; z-index: 5; width: 280px;" class="bg-white border-right shadow h-100  d-none d-lg-block overflow-auto ">
        @include('components.sidebar')
    </div>
    <div class="col p-0 bg-light h-100 overflow-auto">
        <div class="h-100">

            <div class=" row justify-content-center p-5 w-100 m-0 overflow-auto">
                @include('components/' . $component)
            </div>
        </div>
    </div>
</div>

@endsection
