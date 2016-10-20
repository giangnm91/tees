@extends('layout.backend')
@section('header-script')
@stop

	<div class="row">
		<div class="col-lg-6">
			@include('layout.breadcrumbs')
		</div>
		<div class="col-lg-6">
			<button class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tạo order</button>
		</div>
	</div>
		
	@include('backend.order.box-search')

	<div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-list"></i>DANH SÁCH ORDER SẢN PHẨM</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-hover table-list-order header-fixed">
                    <thead>
                        <tr class="bg-primary">
                            <th rowspan="2" scope="col" style="width:450px !important"> Gom hàng </th>
                            <th colspan="7" scope="col"> Thông tin sản phẩm </th>
                            <th colspan="8" scope="col"> Thông tin Order </th>
                            <th colspan="2" scope="col"> Ghi chú </th>
                            <th rowspan="2" scope="col">Admin tạo đơn hàng?</th>
                        </tr>
						<tr class="bg-primary">
							<th scope="col">Mã đơn hàng</th>
							<th scope="col">Tên sản phẩm</th>
							<th scope="col">Link đặt hàng</th>
							<th scope="col">Số lượng</th>
							<th scope="col">Kích thước</th>
							<th scope="col">Màu sắc</th>
							<th scope="col">Giá trên web</th>

							<th scope="col">Có thuế / Không thuế</th>
							<th scope="col">% OFF</th>
							<th scope="col">% Công</th>
							<th scope="col">Tổng tiền hoá đơn</th>
							<th scope="col">Mã đặt hàng từ Nhật</th>
							<th scope="col">Trạng thái đơn hàng</th>
							<th scope="col">Sừa đơn hàng</th>
							<th scope="col">Mã trả hàng</th>

							<th scope="col">Ghi chú của khách</th>
							<th scope="col">Ghi chú của shop</th>
						</tr>
                    </thead>
                    <tbody id="order-table-body">
                    	@if (isset($products) && sizeof($products) > 0)
                    		@foreach ($products as $product)
                    			<tr>
                    				<td class="text-center"> <input type="checkbox"> </td>
		                            <td class="text-center"> {!! $product['OrderID'] !!} </td>
		                            <td> {!! isset($product['ProductName']) ? $product['ProductName'] : '' !!} </td>
		                            <td> {!! isset($product['ProductUrl']) ? $product['ProductUrl'] : '' !!} </td>
		                            <td> {!! isset($product['ProductQty']) ? $product['ProductQty'] : 0!!} </td>
		                            <td> {!! isset($product['ProductSize']) ? $product['ProductSize'] : '' !!} </td>
		                            <td> {!! isset($product['ProductColor']) ? $product['ProductColor'] : '' !!} </td>		                            
		                            <td> {!! isset($product['ProductPrice']) ? 
		                            	\Helper::Money($product['ProductPrice']) : 0 !!} ¥ </td>
		                            <td class="text-center"> {!! isset($product['ProductTax']) ? $product['ProductTax'] . '%' : 'Không' !!} </td>
		                            <td> {!! isset($product['OrderPercentOff']) ? $product['OrderPercentOff'] : 0 !!} </td>
		                            <td> {!! isset($product['OrderPercentEffort']) ? $product['OrderPercentEffort'] : 3.0 !!} </td>
		                            <td class="text-center"> {!! isset($product['order']['OrderTotal']) ? 
		                            	\Helper::Money($product['order']['OrderTotal']) : 0 !!} ¥ </td>
		                            <td> {!! isset($product['order']['OrderJpCode']) ? $product['order']['OrderJpCode'] : '' !!} </td>
		                            <td  class="text-center"> {!! $product['order']['OrderStatus'] !!}</td>
		                            <td  class="text-center"> <i class="fa fa-wrench"></i> </td>
		                            <td> {!! isset($product['order']['OrderReturnCode']) ? $product['order']['OrderReturnCode'] : '' !!} </td>
		                            <td>  </td>
		                            <td>  </td>
		                            <td> {!! $product['order']['OrderCreator'] !!} </td>
                    			</tr>
                    		@endforeach                    	
                    	@endif                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@section('footer-script')
	{!! Html::script('assets/js/backend/order.min.js') !!}
	<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
	<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
@stop
