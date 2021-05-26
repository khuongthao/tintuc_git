@extends('admin.layout.index')
@section('content')


<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif
                <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                   @csrf
                    <div class="form-group">
                        <label>Ten</label>
                        <input class="form-control" name="Ten" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Hinh</label>
                        <input type="file" class="form-control" name="Hinh" />
                    </div>
                    <div class="form-group">
                        <label>Noi Dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="NoiDung" placeholder="Please Enter Category Keywords" rows="4" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>link</label>
                        <input class="form-control" name="link" placeholder="Please Enter Category Keywords" />
                     
                    </div>
                   
                    <button type="submit" class="btn btn-default"> Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection