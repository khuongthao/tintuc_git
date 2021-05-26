@if(Session::has('Cart')!=null)



<div id="change-cart">
    @foreach(Session::get('Cart')->products as $item)
    <div class="cart-item">
        <a class="cart-item-delete xoa" ><i class="fa fa-times" data-id="{{$item['productInfo']->id}}"></i></a>

        <div class="media">
            <a class="pull-left" href="#"><img src="source/image/product/{{$item['productInfo']->image}}" alt=""></a>
            <div class="media-body">
                <span class="cart-item-title">{{$item['productInfo']->name}}</span>
                <span class="cart-item-options">Unit:{{$item['productInfo']->unit}}</span>
                <span class="cart-item-amount">{{$item['quantity']}}*<span>{{$item['productInfo']->unit_price}}</span></span>
            </div>

        </div>

    </div>
    @endforeach


    <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{Session::get('Cart')->totalPrice}}</span></div>
        <input hidden id="total-quantity" type="number" value="{{Session::get('Cart')->totalQuantity}}">
    <div class="clearfix"></div>

</div>


@endif
