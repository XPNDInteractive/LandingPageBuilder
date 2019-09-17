@extends('layouts.app')

@section('content')
<div class="row m-0 h-100">

    <div class="col  p-0 bg-light h-100 overflow-auto">
        <div class="h-100">
            <div class="layout h-100">
                <iframe class="border-0 h-100 w-100 m-0 p-0 d-block" src="/storage/layouts/{{$layout->name}}"></iframe>
            </div>

        </div>
    </div>

</div>

@endsection
