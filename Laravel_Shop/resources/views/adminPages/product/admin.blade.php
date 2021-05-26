@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
@include('admin.content-header',['name'=>'product','key'=>'List'])

<!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12  m-2" >
                    <a href="{{route('addProduct')}}" style="float: right" class="btn btn-danger">Add</a>
                </div>
               <div class="col-md-12">
                   @if(session('thongbao'))
                       <div class="alert alert-success">
                           {{session('thongbao')}}
                       </div>
                       @endif
                   <table class="table">
                       <thead>
                       <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Image</th>
                           <th scope="col">Name</th>
                           <th scope="col">price</th>
                           <th scope="col">Description</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($product as $pr)
                       <tr>
                           <th scope="row">{{$pr->id}}</th>
                           <td>
                               <img style="width: 100px" src="source/image/product/{{$pr->image}}">
                           </td>
                           <td>{{$pr->name}}</td>
                           @if($pr->promotion_price!=0)
                           <td>{{$pr->promotion_price}}</td>
                           @else
                               <td>{{$pr->unit_price}}</td>
                           @endif
                           <td>{{$pr->description}}</td>
                       </tr>
                       @endforeach
                       </tbody>
                   </table>
               </div>
                {{$product->links()}}
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
