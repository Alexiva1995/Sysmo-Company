{{-- <a href="{{route('tree_type_id', [strtolower($type), base64_encode($data->id)])}}">
    <img src="{{$data->logoarbol}}" alt="{{$data->name}}" title="{{$data->name}}" height="96">
</a>
 --}}
{{-- {{$data->id}} --}}
 <a onclick="tarjeta({{$data}}, '{{route('tree_type_id', [strtolower($type), base64_encode($data->id)])}}')">
    <img src="{{$data->logoarbol}}" alt="{{$data->name}}" title="{{$data->name}}" height="45">
</a>