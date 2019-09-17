


<div class="row m-0 align-items-start justify-content-start border bg-white w-100 p-5">
    <div class="col-12">
    <h4 class="text-left">Interior</h4>
    </div>
    
    @if(isset($rows_interior) && $rows_interior->count() > 0)
        @foreach($rows_interior as $row)    
        
   
                <div class="text-dark grid-item p-1">
                    <div class="h-100 w-100 p-2 border shadow-sm bg-white">
                        <div class="grid-item-image border-bottom d-flex align-items-center mb-2">
                            <a href=""><img class="w-100" src="{{$row['path']}}"/></a>
                        </div>
                       
                        <p class="mb-0 small">Aspect:{{\App\AssetAspect::where('id',$row['asset_aspect_id'])->first()->name}}</p>
                        <p class="mb-0 small">Aspect:{{\App\AssetAspect::where('id',$row['asset_aspect_id'])->first()->name}}</p>
                    </div>
                </div>    
        
        @endforeach
    @endif
</div>

@if(isset($rows_interior) && method_exists($rows_interior, 'links'))
    {{$rows_interior->links()}}
@endif

<div class="row m-0 align-items-start justify-content-start border bg-white w-100 p-5">
    <div class="col-12">
    <h4 class="text-left">Exterior</h4>
    </div>
    
    @if(isset($rows_exterior) && $rows_exterior->count() > 0)
        @foreach($rows_exterior as $row)    
        
   
                <div class="text-dark grid-item p-1">
                    <div class="h-100 w-100 p-2 border shadow-sm bg-white">
                        <div class="grid-item-image border-bottom d-flex align-items-center mb-2">
                            <a href=""><img class="w-100" src="{{$row['path']}}"/></a>
                        </div>
                       
                        <p class="mb-0 small">Aspect:{{\App\AssetAspect::where('id',$row['asset_aspect_id'])->first()->name}}</p>
                        <p class="mb-0 small">Aspect:{{\App\AssetAspect::where('id',$row['asset_aspect_id'])->first()->name}}</p>
                    </div>
                </div>    
        
        @endforeach
    @endif
</div>

@if(isset($rows_exterior) && method_exists($rows_exterior, 'links'))
    {{$rows_exterior->links()}}
@endif