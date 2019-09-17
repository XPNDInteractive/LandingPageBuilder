@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center text-white mb-5">
            <h1 class="text-primary font-weight-bold ">Select the package you want to sign up for!</h1>
            <h4 class="">Our packages are created to meet your business needs</h4>
            <p class="small w-50 mx-auto">Not sure what package you need start with our free package until you get a feel for the system and then you can upgrade anytime to explore more applications and services we offer.</p>

        </div>

        @foreach($packages as $package)
        <div class="col-3">
            <div class="bg-white border rounded text-center p-4">
                <h5 class=" d-block py-2">{{$package->name}}</h5>
                <div class="bg-light row m-0 align-items-center justify-content-center mb-3">
                    <h4 class="m-0 mt-2">$</h4>
                    <h1 class="m-0 display-4 font-weight-bold">{{str_replace('.00','', $package->price)}}</h1>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($package->fields()->get() as $field)
                        <li class="list-group-item">{{$field->field}}</li>
                    @endforeach
                </ul>
                <a class="btn btn-primary btn-block mt-4" href="/home">Select</a>

            </div>
        </div>
        @endforeach



    </div>
</div>
@endsection
