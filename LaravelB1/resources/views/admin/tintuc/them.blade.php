@extends('admin.layout.index')
@section('content')


<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tuc
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                  @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}
                        @endforeach
                    </div>

                @endif

                @if(session('thongbao'))
                  <div class="alert alert-link">
                        {{session('thongbao')}}
                  </div>
                @endif
                 @if(session('loi'))
                  <div class="alert alert-primary">
                        {{session('loi')}}
                  </div>
                @endif
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>The Loai</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                           @foreach($theloai as $tl)
                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="form-group">
                        <label>Loai Tin</label>
                       <select class="form-control" name="LoaiTin" id="LoaiTin">
                           @foreach($loaitin as $lt)
                            <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tieu de</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Category Name" />
                    </div>
                     <div class="form-group">
                        <label>Hinh Anh</label>
                        <input type="file" class="form-control" name="Hinh" value="Chon">
                    </div>
                    <div class="form-group">
                        <label>Tom Tat</label>
                       <textarea id="demo" class="form-control ckeditor" name="TomTat" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Noi dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="NoiDung" rows="4"></textarea>
                    </div>
                   
                    <div class="form-group">
                        <label>Noi Bat</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked="" type="radio">Khong
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" type="radio">Co
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Category Add</button>
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
   <script >
       $(document).ready(function () {
          $("#TheLoai").change(function(){
            var idTheLoai=$(this).val();
            $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
              
                 $("#LoaiTin").html(data);
           });
          });
       });
   </script>
@endsection