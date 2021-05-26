@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>{{$tintuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                 @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                   @endif
                @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>The Loai</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            @foreach($theloai as $tl)
                            <option 
                                @if($tintuc->loaitin->idTheLoai==$tl->id)
                                    {{'selected'}}
                                @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                          @endforeach
                        </select>
                    </div>
                     <div class="form-group">
                        <label>Loai Tin</label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">
                             @foreach($loaitin as $lt)
                            <option 
                            @if($tintuc->idLoaiTin==$lt->id)
                            {{"selected"}}
                            @endif

                            value="{{$lt->id}}">{{$lt->Ten}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tieu De</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Category Name" value="{{$tintuc->TieuDe}}" />
                    </div>
                     <div class="form-group">
                        <label>Hinh Anh</label>
                        <img style="width: 300px" src="upload/tintuc/{{$tintuc->Hinh}}">
                        <input type="file" class="form-control" name="Hinh" value="{{$tintuc->Hinh}}"/>
                    </div>
                    <div class="form-group">
                        <label>TomTat</label>
                        <textarea id="demo" class="form-control ckeditor" name="TomTat"  rows="3" >{!!$tintuc->TomTat!!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Noi dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="NoiDung" rows="3" >{!!$tintuc->NoiDung!!}</textarea>
                    </div>
                   
                    <div class="form-group">
                        <label>Noi Bat</label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="0" 
                                @if($tintuc->NoiBat==0)
                                {{"checked"}}
                                @endif

                             type="radio">Khong
                        </label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="1" 
                             @if($tintuc->NoiBat==1)
                                {{"checked"}}
                                @endif
                            type="radio">Co
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Category Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
                  </div>
                    <!-- comment -->
             <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Binh luan
                    <small>{{$tintuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
             @if(session('thongbao'))
             <div class="alert alert-danger">
                    {{session('thongbao')}}
                    </div>
                @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Nuoi dung</th>
                        <th>Noi dung</th>
                        <th>Thoi gian</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc->comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{$cm->id}}</td>
                        <td>{{$cm->user->name}}</td>
                        <td>{!!$cm->NoiDung!!}</td>
                        <td>{{$cm->created_at}}</td>
                        
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                       
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
            <!-- end coment -->

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
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