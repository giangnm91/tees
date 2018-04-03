@extends('layout.backend')
@section('header-script')
{!! Html::style('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css') !!}
{!! Html::style('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css') !!}
{!! Html::style('assets/css/product/product.css') !!}
{!! Html::style('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') !!}
{!! Html::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-lg-6">
			@include('layout.breadcrumbs')
		</div>
		<div class="col-lg-6">
		 	<button class="btn btn-info pull-right import-excel" style="margin-left:5px;" data-toggle="modal" data-target="#modal-import-excel"><i class="fa fa-file-excel-o"></i> Import Excel</button>
			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus"></i> Tạo sản phẩm</button>

		</div>
	</div>
		
	@include('backend.product.box-search')

	<div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-list"></i>DANH SÁCH SẢN PHẨM</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table">
                <table class="table table-striped table-bordered table-hover table-list-order header-fixed">
                    <thead>
                        <tr class="bg-primary">                    
                            <th rowspan="2" scope="col"> Id </th>
                            <th colspan="11" scope="col"> Thông tin sản phẩm </th>
                            <th rowspan="2" scope="col">Thao tác</th>
                        </tr>
						<tr class="bg-primary">
							<th scope="col">Tên sản phẩm</th>
							<th scope="col">Link sản phẩm</th>
							<th scope="col">Hình ảnh</th>
							
							<th scope="col">Giá</th>
							<th scope="col">Giá giảm</th>
							<th scope="col">Mô tả</th>
							<th scope="col">Loại</th>
							<th scope="col">Android clicks</th>
							<th scope="col">iOS clicks</th>
							<th scope="col">Ngày tạo</th>
							<th scope="col">Cập nhật</th>
						</tr>
                    </thead>
                    <tbody id="order-table-body">
                    	@if (isset($products) && sizeof($products) > 0)
                    		@foreach ($products as $product)
                    			<tr>                    				
		                            <td class="text-center"> {!! $product['id'] !!} </td>
		                            <td> {!! isset($product['title']) ? $product['title'] : '' !!} </td>
		                            <td> {!! isset($product['url']) ? $product['url'] : '' !!} </td>
		                            <td> <img class='img-thumbnail img-responsive' style="width:100px;" src="{!! explode(',',$product['thumb'])[0] !!}" alt=""> </td>		                                                       
		                            <td> {!! isset($product['price']) ? 
		                            	\Helper::Money($product['price']) : 0 !!} đ </td>
		                            <td class="text-center"> {!! isset($product['price_discount']) ? \Helper::Money($product['price_discount']) : 0 !!} đ</td>
		                            
		                            <td> {!! isset($product['description']) ? str_limit($product['description'],$limit=50,$end='...') : '' !!} </td>
		                            <td class="text-center"> {!! isset($product['type']) ? $product['type'] : 0 !!} </td>
		                           
		                            <td  class="text-center"> {!! isset($product['android_clicks']) ? $product['android_clicks'] : 0 !!}</td>
		                            <td  class="text-center"> {!! isset($product['ios_clicks']) ? $product['ios_clicks'] : 0 !!}</td>
		                            <td> {!! isset($product['created_at']) ? $product['created_at'] : '' !!} </td>
		                            <td> {!! isset($product['updated_at']) ? $product['updated_at'] : '' !!} </td>	
		                            <td class="text-center"> 
		                            	<a href="javascript:;" class="editProduct" data-id="{!! $product['id'] !!}"><i class="fa fa-wrench"></i></a>
		                            	<a href="javascript:;" class="deleteProduct" data-id="{!! $product['id'] !!}"><i class="fa fa-trash"></i></a>
		                            </td>                    			
		                        </tr>
                    		@endforeach                    	
                    	@endif                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('backend.product.add')
    @include('backend.product.import-excel')
@stop

@section('footer-script')
	{!! Html::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
	{!! Html::script('assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js') !!}
	{!! Html::script('assets/js/backend/product.min.js') !!}
	{!! Html::script('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
	{!! Html::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
@stop
