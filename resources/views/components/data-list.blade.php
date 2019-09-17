<table class="table border bg-white">
    @if(isset($columns) && is_array($columns))
    <thead class="border-top-0 bg-light">
        <tr>
            <th style="width: 30px;" class="bg-light border-right border-bottom-0"><input type="checkbox"/></th>
            @foreach($columns as $col => $callableName)
                <th class="border-top-0 border-bottom-0">{{$col}}</th>
            @endforeach
        </tr>
    </thead>
    @endif
    @if(isset($rows) && $rows->count() > 0)
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td style="width: 30px;" class="bg-light border-right"><input type="checkbox"/></td>
                    @foreach($columns as $col => $column)
                        @if(is_callable($column))
                        <td class="small text-muted"><a class="text-dark p-0 m-0" href="">{!!$column($row)!!}</a></td>
                        @else
                            <td class="small text-muted"><a class="text-dark p-0 m-0" href="{{$item_url . $row[$column]}}">{{$row[$column]}}</a></td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    @endif
</table>

@if(isset($rows) && method_exists($rows, 'links'))
    {{$rows->links()}}
@endif

