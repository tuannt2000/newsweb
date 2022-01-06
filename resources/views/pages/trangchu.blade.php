@extends('layout.index')


@section('content')
<div class="container">

<!-- slider -->
    @include("layout.slide")
<!-- end slide -->

<div class="space20"></div>


<div class="row main-left">
    @include('layout.menu')

    <div class="col-md-9">
        <div class="panel panel-default">            
            <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                <h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức</h2>
            </div>

            <div class="panel-body">
                @foreach ($theloai as $value)
                    @if (count($value->loaitin) > 0  && count($value->tintuc->where('NoiBat',1)) > 0)
                         <!-- item -->
                        <div class="row-item row">
                            <h3>
                                <a href="category.html">{{$value->Ten}}</a> | 
                                @foreach ($value->loaitin as $lt)
                                    <small><a href="loaitin/{{$lt->id}}"><i>{{$lt->Ten}}</i></a>/</small>
                                @endforeach	
                            </h3>

                            <?php 
                                $data = $value->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
                                $tin1 = $data->shift();  
                            ?>

                            <div class="col-md-8 border-right">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$tin1['id']}}">
                                        <img class="img-responsive" src="images/tintuc/{{$tin1['Hinh']}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-7">
                                    <h3>{{$tin1['TieuDe']}}</h3>
                                    <p>{{$tin1['TomTat']}}</p>
                                    <a class="btn btn-primary" href="tintuc/{{$tin1['id']}}">Xem chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>                           

                            <div class="col-md-4">
                                @foreach ($data->all() as $dt)
                                    <a href="tintuc/{{$dt->id}}">
                                        <h4>
                                            <span class="glyphicon glyphicon-list-alt"></span>
                                            {{$dt->TieuDe}}
                                        </h4>
                                    </a>
                                @endforeach
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
</div>

@endsection