<h1>Slider</h1>
<hr>
<form action="@if(session("slider")){{url("slider/update")}}/{{session("slider")->id}}@else{{url("slider/create")}}@endif" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    @if(isset($errors))
        @foreach($errors->slider->all() as $message)
            {{$message}}
            <br>
        @endforeach
    @endif
    @if(session("slidermessage")){{session("slidermessage")}}<br>@endif
    <input type="text" name="title"
           value="@if(session("slider")){{session("slider")->title}}@endif" placeholder="Enter Title slider">
    <br><br>
    <input type="text" name="caption"
           value="@if(session("slider")){{session("slider")->caption}}@endif" placeholder="Enter Caption slider">
    <br><br>
    <input type="text" name="link"
           value="@if(session("slider")){{session("slider")->link}}@endif" placeholder="Enter Link Slider">
    <br><br>
    @if(session("slider"))<img style="width: 100px;height: 100px;" src="{{asset("/upload/")}}/{{session("slider")->image}}" alt="">@endif
    <input type="file" name="image">
    <br><br>
    Is show in slider?<input type="checkbox" name="status" value="1"
    @if(session("slider"))
        @if(session("slider")->status==1)
            checked="checked"
        @endif
    @endif>
    <br><br>
    <input type="submit" name="send" value="send">
</form>
<hr>
<table border="1">
    <tr>
        <th>id</th>
        <th>image</th>
        <th>title</th>
        <th>create_time</th>
        <th>update_time</th>
        <th>edit</th>
        <th>del</th>
    </tr>
    @if(isset($listSlider))
        @foreach($listSlider as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td><img src="{{asset("/upload/")}}/{{$item->image}}" style="width:50px;height: 50px;" /></td>
                <td>{{$item->title}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td><a href="{{url("slider/edit")}}/{{$item->id}}">edit</a></td>
                <td><a href="{{url("slider/delete")}}/{{$item->id}}">del</a></td>
            </tr>
        @endforeach
    @endif

</table>