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
                                    <input  id="quantityItemCart-{{$item['productInfo']->id}}" type="number" value="{{$item['quantity']}}">
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
                <ul>
                    <li class="subtotal">Số lượng <span>{{Session::get('Cart')->totalQuantity}}</span></li>
                    <li class="cart-total">Total <span>{{Session::get('Cart')->totalPrice}}</span></li>
                </ul>
                <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
            </div>
        </div>
    </div>
</div>
