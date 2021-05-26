
@extends('layout.index')
@section('content')

<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$pt1->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="home">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($productType as $pt)
							<li><a href="type/{{$pt->id}}">{{$pt->name}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($product)}}</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($product as $pr)
								<div class="col-sm-4">
									<div class="single-item">
										@if($pr->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="chitiet/{{$pr->id}}"><img width="270px" height="250px" src="source/image/product/{{$pr->image}}" alt=""></a>
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
											<a class="add-to-cart pull-left" href="cart"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
							
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>San pham khac</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($product1)}}.sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($product1 as $pr1)
								
								<div class="col-sm-4">
									<div class="single-item">
											@if($pr1->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="product.html"><img style="width: 270px;height: 250px" src="source/image/product/{{$pr1->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$pr1->name}}</p>
											<p class="single-item-price">
													@if($pr1->promotion_price==0)
												<span class="flash-sale">{{$pr1->unit_price}}$</span>
												@else
												<span class="flash-del">{{$pr1->unit_price}}$</span>
												<span class="flash-sale">{{$pr1->promotion_price}}$</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
								{{$product1->links()}}
							</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection