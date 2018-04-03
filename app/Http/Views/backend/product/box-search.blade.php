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
            {!! Form::open(['id' => 'formSearchData' , 'url' => 'product', 'method' => 'GET', 'class' => 'form-horizontal']) !!}
            <!-- <form role="form" class="form-horizontal"> -->
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Mã sản phẩm</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-info-circle tooltips" data-original-title="Product id" data-container="body"></i>
                                <input type="text" class="form-control" value="{!!isset($input['product_id']) ? $input['product_id'] : ''!!}" name="product_id"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Tên sản phẩm</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-info-circle tooltips" data-original-title="Product name" data-container="body"></i>
                                <input type="text" value="{!!isset($input['title']) ? $input['title'] : ''!!}" class="form-control" name="title"> </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Danh mục</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-info-circle tooltips" data-original-title="Category" data-container="body"></i>
                                <select name="category_id" class="bs-select" data-live-search="true" data-size="5">
                                    @foreach ($listCategory as $cat)
                                        <option value="{!!$cat['id']!!}" @if(isset($input['category_id']) && $input['category_id']== $cat['id']) selected @endif>{!!$cat['name']!!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label class="control-label col-md-4">Khoảng giá</label>
                        <div class="col-md-8">
                            <input id="price_range" name="price" type="text" value="" />
                            <span class="help-block"> Lọc sản phẩm theo khoảng giá </span>
                        </div>
                    </div> -->
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