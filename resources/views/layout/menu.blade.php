<div class="col-md-3 ">
        <ul class="list-group" id="menu">
            <li href="#" class="list-group-item menu1 active">
                Menu
            </li>

            @foreach ($theloai as $value)
                @if (count($value->loaitin)>0)
                    <li href="#" class="list-group-item menu1">
                        {{$value->Ten}}
                    </li>
                    <ul>
                        @foreach ($value->loaitin as $lt)
                            <li class="list-group-item">
                                <a href="loaitin/{{$lt->id}}">{{$lt->Ten}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </ul>
    </div>