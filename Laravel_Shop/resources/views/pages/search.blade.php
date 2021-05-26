@extends('layout.index')
@section('content')

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <?php
            function doimau($str,$tukhoa)
                {
                    return str_replace($tukhoa,"<span style='color: red'>$tukhoa</span>",$str);
                }
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>New Products</h4>
                        <div class="panel-heading" style="background-color:#337AB7; color:white;">
                            <h4><b>Search:{{$tukhoa}}</b></h4>
                        </div>
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
                                            <p class="single-item-title">{!!doimau($pr->name,$tukhoa)!!}</p>
                                            <p class="single-item-price">
                                                @if($pr->promotion_price==0)
                                                    <span class="flash-sale">{!!doimau($pr->unit_price,$tukhoa)!!}$</span>
                                                @else
                                                    <span class="flash-del">{!!doimau($pr->unit_price,$tukhoa)!!}$</span>
                                                    <span class="flash-sale">{!!doimau($pr->promotion_price,$tukhoa)!!}$</span>
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
                        {!! $product->appends(['tukhoa' =>$tukhoa])->links() !!}
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>


                </div> <!-- .beta-products-list -->
            </div>
        </div> <!-- end section with sidebar and main content -->


    </div> <!-- .main-content -->
</div> <!-- #content -->
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

        function RenderCart(kq)
        {
            $('#change-cart').empty();
            $('#change-cart').html(kq);
            $("#total-quantity-show").text($("#total-quantity").val());
        }
    </script>
@endsection
