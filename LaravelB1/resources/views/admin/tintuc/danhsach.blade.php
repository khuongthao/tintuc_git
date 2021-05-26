@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tuc
                    <small>List</small>
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
                        <th>Tieu de</th>
                        <th>Tom tat</th>
                        <th>The loai</th>
                        <th>Loai tin</th>
                        <th>Noi dung</th>
                        <th>Noi bat</th>
                        <th>so luot xem</th>
                      
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc as $tt)
                    <tr class="odd gradeX" align="center">
                        <td>{{$tt->id}}</td>
                        <td>{{$tt->TieuDe}}
                            <img style="width: 100px;" src="upload/tintuc/{{$tt->Hinh}}">
                        </td>
                        <td>{!!$tt->TomTat!!}</td>
                        <td>{{$tt->loaitin->theloai->Ten}}</td>
                         <td>{{$tt->loaitin->Ten}}</td>
                          <td>"{!!$tt->NoiDung!!}"</td>
                           <td>
                            @if($tt->NoiBat==0)
                            {{'khong'}}
                            @else
                            {{'co'}}

                            @endif
                           </td>

                            <td>{{$tt->SoLuotXem}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Edit</a></td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection