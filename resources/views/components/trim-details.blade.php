<div class="w-100">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Specifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Media</a>
        </li>
    </ul>
    <div class="tab-content bg-white border border-top-0 p-5" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @if(isset($rows) && is_array($rows))
                @foreach($rows as $category => $aspects)
                    <div class="row m-0">
                        <div class="col-12 p-0">
                            <h4 class="mb-3">{{$category}}</h4>
                            @foreach($aspects as $aspect => $images)
                                <div class="row m-0 py-3 border mb-3">
                                    <div class="col-12">
                                        <h5>{{$aspect}}</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="row m-0">
                                            @foreach($images as $img)
                                                <div class="col-3 p-1">
                                                   
                                                    @if(pathinfo($img)['extension'] !== 'mp4')
                                                        <img class="w-100" src="{{$img}}"/>
                                                    @else
                                                    <video class="w-100" controls>
                                                        <source src="{{$img}}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
          
           
        </div>
    </div>
</div>