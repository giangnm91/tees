<div class="modal fade" id="addProduct">
	
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			{!! Form::open(array('id' => 'add-product-form', 'method' => 'post')) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Thêm sản phẩm</h4>
			</div>
			<div class="modal-body">
				<div class="portlet light bordered">
                	<div class="portlet-body form">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên sản phẩm</label>
                                <div class="col-md-9">
                                    <input type="text" name="title" class="form-control margin-bottom-10" placeholder="Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="form-group margin-bottom-5">
                                <label class="col-md-3 control-label">Đường dẫn</label>
                                <div class="col-md-9">
                                    <input type="text" name="url" class="form-control margin-bottom-10" placeholder="Url sản phẩm">                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mô tả</label>
                                <div class="col-md-9 margin-bottom-5">
                                    <textarea name="description" class="ckeditor form-control margin-bottom-10" id="description-editor" rows="3"></textarea>
                                </div>
                            </div>
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="form-group margin-bottom-5">
                                    <label class="col-md-3 control-label">Mockup {!!$i!!}</label>
                                    <div class="col-md-9">
                                        <input type="text" name="mockup{!!$i!!}" class="form-control margin-bottom-10" placeholder="Mockup {!!$i!!}">                                   
                                    </div>
                                </div>
                            @endfor
                            <div class="form-group margin-bottom-10">
                                <label class="control-label col-md-3">Ảnh sản phẩm</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Chọn ảnh </span>
                                                <span class="fileinput-exists"> Thay đổi </span>
                                                <input id="product-imgs-upload" type="file" name="thumb[]" multiple> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Type</label>
                                <div class="col-md-9">
                                    <select name="type" class="form-control margin-bottom-10">
                                        @for ($i = 1; $i <= 3; $i++)
                                            <option value="$i">$i</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Danh mục</label>
                                <div class="col-md-9">
                                    <select name="category" class="form-control margin-bottom-10">
                                    	@foreach ($listCategory as $category)
                                        	<option value="{!!$category['id']!!}">{!!$category['name']!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Giá</label>
                                <div class="col-md-9">
                                    <div class="input-group margin-bottom-10">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="text" name="price" class="form-control" placeholder="Giá trước giảm"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Giá sau giảm</label>
                                <div class="col-md-9">
                                    <div class="input-group  margin-bottom-10">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="text" name="price_discount" class="form-control" placeholder="Giá sau giảm"> </div>
                                </div>
                            </div>
                    	</div>	
                   	</div>
                </div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Thêm</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
		</div>
        {!! Form::close() !!}
	</div>
	</div>
</div>