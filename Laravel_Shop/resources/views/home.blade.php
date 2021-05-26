@extends('layout.index')
@section('content')

<div class="container">
<div id="content" class="space-top-none">
    <div class="main-content">
        <div class="space60">&nbsp;</div>
        <div class="row">
            <div class="col-sm-12">
                <div class="beta-products-list">
                    <h4>New Products</h4>
                    <div class="beta-products-details">
                        <p class="pull-left">{{count($product)}}.san pham</p>
                        <div class="clearfix"></div>
                    </div>

                    <div class="row">
                        @foreach($product as $pr)
                        <div class="col-sm-3">
                            <div class="single-item">
                                    @if($pr->promotion_price!=0)
                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                @endif
                                <div class="single-item-header">
                                    <a href="product.html"><img style="width: 270px;height: 250px" src="source/image/product/{{$pr->image}}" alt=""></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$pr->name}}</p>
                                    <p class="single-item-price">
                                        @if($pr->promotion_price==0)
                                        <span class="flash-sale">{{$pr->unit_price}}$</span>
                                        @else
                                        <span class="flash-del">{{$pr->unit_price}}$</span>
                                        <span class="flash-sale">{{$pr->promotion_price}}$</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" onclick="AddCart({{$pr->id}})" href="javascript:" >
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                    <a class="beta-btn primary" href="chitiet/{{$pr->id}}">Details
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{$product->links()}}
                </div> <!-- .beta-products-list -->

                <div class="space50">&nbsp;</div>

                <div class="beta-products-list">
                    <h4>San pham khuyen mai</h4>
                    <div class="beta-products-details">
                        <p class="pull-left">{{count($product1)}}.sản phẩm</p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        @foreach($product1 as $pr1)

                        <div class="col-sm-3">
                            <div class="single-item">
                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

                                <div class="single-item-header">
                                    <a href="chitiet/{{$pr1->id}}"><img style="width: 270px;height: 250px" src="source/image/product/{{$pr1->image}}" alt=""></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$pr1->name}}</p>
                                    <p class="single-item-price">
                                        <span class="flash-del">{{$pr1->unit_price}}</span>
                                        <span class="flash-sale">{{$pr1->promotion_price}}</span>
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" onclick="AddCart({{$pr1->id}})" href="javascript:"><i class="fa fa-shopping-cart" ></i></a>
                                    <a class="beta-btn primary" href="chitiet/{{$pr1->id}}">Details <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{$product1->links()}}
                    </div>
                    <div class="space40">&nbsp;</div>

                    </div>
                </div> <!-- .beta-products-list -->
            </div>
        </div> <!-- end section with sidebar and main content -->


    </div> <!-- .main-content -->
</div> <!-- #content -->
</div> <!-- .container -->
@endsection
@section('script')
    <script>
        function AddCart(id)
        {
           $.ajax({
               url:'cart/'+id,
               type:'GET',
           }).done(function (kq) {
               // console.log(kq);
              RenderCart(kq);
               alertify.success('Thêm thành công');
           })
        }
    $('#change-cart').on('click','.xoa i',function (){
        // console.log($(this).data('id'));
        $.ajax({
            url:'delete/'+$(this).data('id'),
            type:'GET',
        }).done(function (kq) {
            // console.log(kq);
            RenderCart(kq);
            alertify.success('xoa thanh cong ');
        })
    })
        function RenderCart(kq)
        {
            $('#change-cart').empty();
            $('#change-cart').html(kq);
        $("#total-quantity-show").text($("#total-quantity").val());
        }
    </script>
@endsection
