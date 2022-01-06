@extends("layout.index")

@section("content")

<div class="container">
        <div class="row">
            @include("layout.menu")

            <?php
                function doimau($str,$search){
                   return str_replace($search,"<span style='color:red'>$search</span>",$str);
                }
            ?>

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm kiếm : {{$search}}</b></h4>
                    </div>

                    @foreach ($tintuc as $value)
                        <div class="row-item row">
                            <div class="col-md-3">

                                <a href="tintuc/{{$value->id}}">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="images/tintuc/{{$value->Hinh}}" alt="">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3>{!! doimau($value->TieuDe,$search)!!}</h3>
                                <p>{!! doimau($value->TomTat,$search)!!}</p>
                                <a class="btn btn-primary" href="tintuc/{{$value->id}}">Xem chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach

                    <div style="text-align:center">
                        {{$tintuc->links(("pagination::bootstrap-4"))}}
                    </div>

                </div>
            </div> 

        </div>

    </div>

@endsection