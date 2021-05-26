@extends('layout.index')
@section('style')


    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

@endsection
@section('content')

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="listCartDelete">
                <div class="cart-table">
                    <table>
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th class="p-name">Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Save</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(Session::has('Cart')!=null)
                            @foreach(Session::get('Cart')->products as $item)
                        <tr>
                            <td class="cart-pic first-row"><img src="source/image/product/{{$item['productInfo']->image}}" alt=""></td>
                            <td class="cart-title first-row">
                                <h5>{{$item['productInfo']->name}}</h5>
                            </td>
                            <td class="p-price first-row">{{$item['productInfo']->unit_price}}</td>
                            <td class="qua-col first-row">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input id="quantityItemCart-{{$item['productInfo']->id}}" type="number" value="{{$item['quantity']}}">
                                    </div>
                                </div>
                            </td>
                            <td class="total-price first-row">{{$item['price']}}</td>
                            <td class="close-td first-row"><i class="ti-save"  onclick="SaveListItemCart({{$item['productInfo']->id}})"></i></td>
                            <td class="close-td first-row"><i class="ti-close" onclick="DeleteListItemCart({{$item['productInfo']->id}})"></i></td>

                        </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 offset-lg-8">
                        <div class="proceed-checkout">
                            @if(Session::has('Cart')!=null)
                            <ul>
                                <li class="subtotal">Số lượng <span>{{Session::get('Cart')->totalQuantity}}</span></li>
                                <li class="cart-total">Total <span>{{Session::get('Cart')->totalPrice}}</span></li>
                            </ul>
                            @endif
                            <a href="dat-hang" class="proceed-btn">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function DeleteListItemCart(id)
        {
            $.ajax({
                url:'delete-list-cart/'+id,
                type:'GET',
            }).done(function (kq) {
                // console.log(kq);
                RenderListCart(kq);
               alertify.success('Xoá thành công');
            })
        }
        function SaveListItemCart(id)
        {
            // console.log($('#quantityItemCart-'+id).val());
            $.ajax({
                url:'save-list-cart/'+id+'/'+$('#quantityItemCart-'+id).val(),
                type:'GET',
            }).done(function (kq) {
                // console.log(kq);
                RenderListCart(kq);
                 alertify.success('Cập nhật thành công');
            })
        }

        function RenderListCart(kq)
        {
            $('#listCartDelete').empty();
            $('#listCartDelete').html(kq);
        }
    </script>
@endsection
