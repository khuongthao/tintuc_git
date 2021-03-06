@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>{{$slide->Ten}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                  @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif
                <form action="" method="POST" enctype="multipart/form-data">
                   @csrf
                    <div class="form-group">
                        <label>Ten</label>
                        <input class="form-control" name="Ten" value="{{$slide->Ten}}" />
                    </div>
                    <div class="form-group">
                        <label>Hinh</label>
                        <img width="300px" src="upload/slide/{{$slide->Hinh}}"><br>
                        <input type="file" class="form-control" name="Hinh"  />
                    </div>
                    <div class="form-group">
                        <label>Noi Dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="NoiDung"  rows="4" >{{$slide->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="link" value="{{$slide->link}}" />
                    </div>
                    
                    <button type="submit" class="btn btn-default">Category Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection