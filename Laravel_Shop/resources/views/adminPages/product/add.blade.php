@extends('admin.index')
@section('content')
    <div class="content-wrapper">
      @include('admin.content-header',['name'=>'product','key'=>'Add'])
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8  m-2" >
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form method="post" action="" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" id="staticEmail" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleFormControlSelect2" class="col-sm-2 col-form-label">Loai</label>
                            <div class="col-sm-10">
                            <select  class="form-control" name="loai">
                                @foreach($type as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>

                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Unit_price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword" name="unit_price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Unit</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="unit" id="exampleRadios1" value="cái" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                   Cái
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="unit" id="exampleRadios2" value="hộp">
                                <label class="form-check-label" for="exampleRadios2">
                                    Hộp
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Descript</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="descript" placeholder="Mô tả" rows="3">
                            </div>
                        </div>
                        <button type="submit"  class="btn btn-primary btn-sm " style="align: center">Add</button>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
