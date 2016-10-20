@extends('layout.backend')
@section('header-script')
    {!!Html::style('assets/global/plugins/jquery-multi-select/css/multi-select.css',array('media' => 'screen'))!!}
    {!!Html::style('assets/css/libs/dropzone.css',array('media' => 'screen'))!!}
@stop
@section('footer-script')    
    {!! Html::script('assets/js/backend/article_add.min.js') !!}
    {!! Html::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
    {!! Html::script('assets/js/libs/dropzone.js') !!}
    {!! Html::script('assets/js/libs/fastclick.js') !!}
    {!! Html::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') !!}
    {!! Html::script('assets/global/plugins/plupload/js/plupload.full.min.js') !!}
@stop
@section('content')
	@include('layout.page_header')
	@include('layout.breadcrumbs')
	<!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('action' => 'Article\ArticleCtrl@postAdd', 'id' => 'form-add-article', 'method' => 'POST', 'class' => 'form-horizontal form-row-seperated')) !!}            
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file"></i> @lang('backend.Article.vietnam') </div>
                        <div class="actions btn-set">
                            <button type="button" class="btn btn-secondary-outline">
                                <i class="fa fa-angle-left"></i> @lang('backend.Common.back')</button>
                            <button type="button" class="btn btn-secondary-outline btn-reset-data">
                                <i class="fa fa-reply"></i> @lang('backend.Common.reset')</button>
                            <button type="button" class="btn btn-success btn-add-article">
                                <i class="fa fa-check"></i> @lang('backend.Common.save')</button>                           
                            <div class="btn-group">
                                <a class="btn btn-success dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                    <i class="fa fa-share"></i> @lang('backend.Common.more')
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> @lang('backend.Common.dupicate') </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> @lang('backend.Common.delete') </a>
                                    </li>
                                    <li class="dropdown-divider"> </li>
                                    <li>
                                        <a href="javascript:;"> @lang('backend.Common.print') </a>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-bordered">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_general1" data-toggle="tab"><img alt="" src="../assets/global/img/flags/vn.png"> @lang('backend.Article.vietnam') </a>
                                </li>
                                <li>
                                    <a href="#tab_general2" data-toggle="tab"><img alt="" src="../assets/global/img/flags/us.png"> @lang('backend.Article.us') </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_general1">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.name'):
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" autocomplete="off" class="form-control required" name="article[vn][name]" placeholder=""> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.excerpt'):
                                            </label>
                                            <div class="col-md-10">
                                                <textarea autocomplete="off" class="form-control ckeditor" name="article[vn][excerpt]"></textarea>
                                                <span class="help-block"> @lang('backend.Article.excerpt_desc') </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.category'):
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class="col-md-9">
                                                        <select autocomplete="off" multiple="multiple" class="multi-select" id="category_multi_select" name="article[vn][category][]">
                                                            <option value="dich_vu">Dịch Vụ</option>
                                                            <option value="gioi_thieu">Giới Thiệu</option>
                                                            <option value="gia_cuoc" selected>Giá Cước</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span class="help-block"> @lang('backend.Article.category_desc') </span>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.content'):
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea id="article-content-vn" class="ckeditor form-control required" rows="6"></textarea>  
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Image.image'):</label>
                                            <div class="col-md-10">
                                                <div id="tab_images_uploader_container" class="margin-bottom-10 needsclick">
                                                    <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn btn-success fileinput-button">
                                                       <i class="fa fa-file"></i> @lang('backend.Common.select_file') </a>
                                                    <div class="margin-top-15 dropzone" id="dropzone" name="article[vn][images]">
                                                      <div class="needsclick dz-message" data-dz-message>
                                                            @lang('backend.Image.drop_here')<br />                                                        
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Status:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <select autocomplete="off" class="table-group-action-input form-control input-medium" name="status">
                                                    <option value="">@lang('backend.Common.select')...</option>
                                                    <option value="1">Published</option>
                                                    <option value="0">Not Published</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_general2">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.name'):
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control required" name="article[us][name]" placeholder=""> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.excerpt'):
                                            </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" name="article[us][excerpt]"></textarea>
                                                <span class="help-block"> @lang('backend.Article.excerpt_desc') </span>
                                            </div>
                                        </div>                                                                                     
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">@lang('backend.Article.content'):
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea class="ckeditor form-control required" id="article-content-us" name="article[us][content]" rows="6"></textarea>  
                                            </div>
                                        </div>                                        
                                    </div>                                                    
                            </div>
                        </div>
                    </div>
                </div>
            <input type="hidden" name="author" value="{!!auth()->user()->email!!}">
            {!! Form::close() !!}
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@stop