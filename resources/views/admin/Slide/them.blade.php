@extends("admin.layout.index")

@section("content")

<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $err)
                                        {{$err}}
                                        <br>
                                    @endforeach
                                </div>
                            @endif

                            @if (session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Tên slide</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên slide" />
                            </div>
                            <div class="form-group">
                                <label>Hình</label>
                                <input type="file" class="form-control" name="Hinh">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" id="demo" rows="3" name="NoiDung"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Nhập link" />
                            </div>
                            <button type="submit" class="btn btn-default">Thêm slide</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>


@endsection