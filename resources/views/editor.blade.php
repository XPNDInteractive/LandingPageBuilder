@extends('layouts.app')

@section('content')
<div class="row m-0 h-100">
    <div style="position: relative; z-index: 5; width: 280px;" class="bg-white border-right shadow h-100  d-none d-lg-block overflow-auto ">
        @include('components.editor-sidebar')
    </div>
    <div class="col p-3 bg-light h-100 overflow-auto">
        <div class="h-100">


        </div>
    </div>
     <div style="position: relative; z-index: 5; width: 80px;" class="bg-white border-left shadow h-100  d-none d-lg-block overflow-auto ">
        @include('components.editor-sidebar')
    </div>
</div>

@endsection
