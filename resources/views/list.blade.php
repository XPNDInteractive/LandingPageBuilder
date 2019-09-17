@extends('layouts.app')

@section('content')
<div class="row m-0 h-100">
    <div class=" border-right h-100  bg-white  d-none d-lg-block overflow-auto " style="width:280px;">
        @include('components.sidebar')
    </div>
    <div class="col bg-light  h-100 overflow-auto">
        <div class="h-100">
            <div class="row m-0 py-4 align-items-center">
                @if(isset($count))
                    <h4 class="  mb-0">{{$title}}({{$count}})</h4>
                @else
                    <h4 class="  mb-0">{{$title}}(0)</h4>
                @endif
                <a href="{{$create_url}}" class="btn btn-primary ml-auto">Create</a>
            </div>
            <div style="height: calc(100% - 83.6px);" class="row   w-100 m-0 overflow-auto">
                @include('components/' . $component)
            </div>
        </div>
    </div>
</div>

@endsection
