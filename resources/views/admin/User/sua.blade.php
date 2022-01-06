@extends("admin.layout.index")

@section("content")

<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
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
                                <label>Tên user</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên" value="{{$user->name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" readonly="" class="form-control" name="Email" placeholder="Nhập email" value="{{$user->email}}"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="change" name="changePassword">
                                <label>Đổi mật khẩu</label>
                                <input disabled="" type="password" class="form-control password" name="Password" placeholder="Nhập mật khẩu mới" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input disabled="" type="password" class="form-control password" name="PasswordAgain" placeholder="Nhập lại mật khẩu mới" />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1"
                                    @if ($user->quyen == 1)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0"
                                    @if ($user->quyen == 0)
                                        {{"checked"}}
                                    @endif
                                    type="radio">User
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa user</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

@section("script")
    <script>
        $(document).ready(function(){
            $("#change").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled',"");
                }
            })
        })
    </script>
@endsection