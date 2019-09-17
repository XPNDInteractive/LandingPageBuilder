<div class="row m-0">
    @foreach($layouts as $layout)
        <div class="col-lg-4">
            <div class="bg-light border p-3 bg-white">
                <a href="{{Route('layouts_preview')}}?layout={{$layout->id}}">
                    <img class="w-100 " src="/storage/layouts/{{$layout->name}}/screenshot.jpg"/>
                </a>
                <div class=" py-3 row m-0 align-items-center ">
                    <div class="col text-center">
                    <a href="{{Route('layouts_preview')}}?layout={{$layout->id}}"><h6 class="mb-1">{{$layout->name}}</h6></a>


                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>
