@extends("layout.index")


@section("content")
<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on : {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!!$tintuc->NoiDung!!}</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if (Auth::check())
                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form role="form" action="comment/{{$tintuc->id}}" method="post">
                            {{csrf_field()}}

                            @if (session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                @endif

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach ($tintuc->comment as $value)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$value->user->name}}
                                <small>{{$value->created_at}}</small>
                            </h4>
                            {{$value->NoiDung}}
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        @foreach ($tinlienquan as $value)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$value->id}}">
                                        <img class="img-responsive" src="images/tintuc/{{$value->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$value->id}}"><b>{{$value->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left:7px">{{$value->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach ($tinnoibat as $value)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$value->id}}">
                                        <img class="img-responsive" src="images/tintuc/{{$value->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$value->id}}"><b>{{$value->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left:7px">{{$value->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>


@endsection