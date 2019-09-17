<div class="w-100 mx-auto p-5 ">
        <div class="row m-0 align-items-center">

            <div class="col bg-white border p-5">
                
                @if(isset($forms) && isset($forms['create']))
                <form enctype="multipart/form-data" method="{{$forms['create']['method']}}" action="{{$forms['create']['action']}}">
                    @csrf
                    
                    @foreach($forms['create'] as $type => $field)
                        @if($type === 'h1' )
                            <h1>{{$field}}</h1>
                        @elseif($type === "h2")
                            <h2>{{$field}}</h2>
                        @elseif($type === "h3")
                            <h3>{{$field}}</h3>
                        @elseif($type === "h4")
                            <h4>{{$field}}</h4>
                        @elseif($type === "h5")
                            <h5>{{$field}}</h5>
                        @elseif($type === "h6")
                            <h6>{{$field}}</h6>
                        @elseif($type === "p")
                            <p class="small"> {{$field}} </p>

                        @elseif($type === "input")

                            @foreach($field as $input)
                                @if($input['type'] == 'text')
                                    <div class="form-group">
                                        @if(isset($input['label']))
                                            <label>{{$input['label']}}</label>
                                        @endif
                                        <input class="form-control  @error($input['name']) is-invalid @enderror" type="{{$input['type']}}"  name="{{$input['name']}}" placeholder="{{isset($input['placeholder']) ? $input['placeholder']:null}}"/>
                                        @error($input['name'])
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if(isset($input['helper']))
                                        <p class="small text-muted">{{$input['helper']}}</p>
                                        @endif
                                    </div>
                                @elseif($input['type'] == 'file')
                                <div class="form-group">
                                    @if(isset($input['label']))
                                        <label>{{$input['label']}}</label>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error($input['name']) is-invalid @enderror" id="customFile" name="{{$input['name']}}"/>
                                        <label class="custom-file-label" for="customFile">{{isset($input['placeholder']) ? $input['placeholder']:null}}</label>
                                      </div>
                                    @error($input['name'])
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if(isset($input['helper']))
                                    <p class="small text-muted">{{$input['helper']}}</p>
                                    @endif
                                </div>
                                @elseif($input['type'] == 'select')
                                    <div class="form-group">
                                    @if(isset($input['label']))
                                        <label class="">{{$input['label']}}</label>
                                    @endif

                                    <select class="mb-3 custom-select {{isset($input['class']) ? $input['class']:''}} @error($input['name']) is-invalid @enderror" name="{{$input['name']}}">
                                        @foreach($input['options'] as $id => $option)
                                            <option value="{{$id}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                @elseif($input['type'] == 'hidden')
                                     <input type="{{$input['type']}}" name="{{$input['name']}}" value="{{$input['value']}}"/>
                                @endif
                            @endforeach

                     
                        @elseif($type === "submit")
                            <button class="btn btn-primary mt-3"> {{$field}} </button>
                        @endif
                    @endforeach
                    </form>
                @endif

            </div>
        </div>

    </div>
