@extends('layouts.app')

@section('content')
<div class="row m-0 h-100">
    <div style="position: relative; z-index: 5;" class="col-6 p-0 bg-white border-right shadow h-100  d-none d-lg-block overflow-auto ">
        @include('components.code-sidebar')
    </div>
    <div class="col p-3 bg-light h-100 overflow-auto">
        <div class="h-100 section-preview">


        </div>
    </div>

</div>

@endsection
