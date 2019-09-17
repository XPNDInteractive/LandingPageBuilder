@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-lg-8 pt-5">
            <div class="p-5 bg-white border rounded">
                <div class="row m-0 align-items-center">
                    <i class="col-lg-4 rounded text-center fas fa-building display-1 p-5 bg-primary text-white"></i>
                    <div class="col pl-lg-4">
                        <h4 class=" font-weight-bold">Create your Orginization</h4>
                        <p class="small">Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.</p>
                        <form action="/company/save" method="post">
                            @csrf
                            <input type="hidden" name="user" value="{{Auth::user()->id}}"/>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your company or entity name"/>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button class="btn btn-primary mt-3" type="submit">Next</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
