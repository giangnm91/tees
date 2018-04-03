	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			{!! Form::open(array('id' => 'edit-product-form', 'method' => 'post')) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Sửa sản phẩm</h4>
			</div>
			<div class="modal-body">
				<div class="portlet light bordered">
                	<div class="portlet-body form">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên sản phẩm</label>
                                <div class="col-md-9">
                                    <input type="text" name="title" class="form-control margin-bottom-10" value="{!! $product[0]['title'] !!}">
                                </div>
                            </div>
                            <div class="form-group margin-bottom-5">
                                <label class="col-md-3 control-label">Đường dẫn</label>
                                <div class="col-md-9">
                                    <input type="text" name="url" class="form-control margin-bottom-10" value="{!! $product[0]['url'] !!}">                                   
                                </div>
                            </div>
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="form-group margin-bottom-5">
                                    <label class="col-md-3 control-label">Mockup {!!$i!!}</label>
                                    <div class="col-md-9">
                                        <input type="text" name="mockup{!!$i!!}" value="{!! $product[0]['mockup'.$i] !!}" class="form-control margin-bottom-10" placeholder="Mockup 1">                                   
                                    </div>
                                </div>
                            @endfor
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mô tả</label>
                                <div class="col-md-9 margin-bottom-20">
                                    <textarea name="description" class="ckeditor-edit form-control" id="description-edit-{!!$product[0]['id']!!}" rows="3" value="{!! $product[0]['description'] !!}">
                                        {!! $product[0]['description'] !!}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Ảnh sản phẩm</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="height: 150px;">
                                            @foreach (explode(",", $product[0]['thumb']) as $img)   
                                                <img src="{!!$img!!}" alt="" style="display:inline-block;margin-right:5px">
                                            @endforeach  
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Chọn ảnh </span>
                                                <span class="fileinput-exists"> Thay đổi </span>
                                                <input id="product-imgs-upload-edit" type="file" name="thumb[]" multiple="multiple"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Type</label>
                                <div class="col-md-9">
                                    <select name="type" class="form-control margin-bottom-10">
                                        <option value="{!!$product[0]['type']!!}">{!! $product[0]['type'] !!}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
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
                                        <input type="text" name="price" class="form-control" value="{!! isset($product[0]['price']) ? 
                                        \Helper::Money($product[0]['price']) : 0 !!}"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Giá sau giảm</label>
                                <div class="col-md-9">
                                    <div class="input-group  margin-bottom-10">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="text" name="price_discount" class="form-control" value="{!! isset($product[0]['price_discount']) ? 
                                        \Helper::Money($product[0]['price_discount']) : 0 !!}"> </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{!! $product[0]['id'] !!}">
                    	</div>	
                   	</div>
                </div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Sửa</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
		</div>
	</div>
    <script>
    $(document).ready(function(){
        $('.ckeditor-edit').each(function(e){
            if (CKEDITOR.instances[this.id]) {
                CKEDITOR.remove(CKEDITOR.instances[this.id]);
            } else{
                CKEDITOR.replace( this.id );
            }
        });
    });
    </script>        
	</div>