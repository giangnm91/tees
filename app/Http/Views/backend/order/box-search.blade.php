<div class="portlet box blue ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-search"></i> TÌM KIẾM & LỌC </div>
            <div class="tools">
                <a href="" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="" class="reload"> </a>
                <a href="" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['id' => 'formSearchData' , 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <!-- <form role="form" class="form-horizontal"> -->
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Mã order</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                                <input type="text" autocomplete="off" class="form-control" name="OrderID"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Mã đặt hàng từ Nhật</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                                <input type="text" autocomplete="off" class="form-control" name="OrderJpCode"> </div>
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label class="col-md-4 control-label">Tên khách hàng</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips" data-original-title="please provide an email" data-container="body"></i>
                                <input type="text" autocomplete="off" class="form-control" name="OrderUserName"> </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4">Khoảng thời gian</label>
                        <div class="col-md-8">
                            <div class="input-group input-large date-picker input-daterange" data-date="12/10/2016" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control" name="fromDate" autocomplete="off">
                                <span class="input-group-addon"> tới </span>
                                <input type="text" class="form-control" name="toDate" autocomplete="off"> </div>
                            <!-- /input-group -->
                            <!-- <span class="help-block"> Select date range </span> -->
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="row text-center">
                        	<button type="submit" class="btn blue">Lọc</button>
                            <!-- <button type="button" class="btn default">Cancel</button> -->                            
                        </div>
                    </div>
                </div>
            <!-- </form> -->
            {!! Form::close() !!}
        </div>
    </div>