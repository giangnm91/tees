@extends('layout.backend')
@section('header-script')
	{!! Html::style('assets/global/plugins/jquery-nestable/jquery.nestable.css') !!}
    {!! Html::style('http://mjolnic.com/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css') !!}
@stop
@section('content')
	@include('layout.breadcrumbs')
	
	<div class="row">
		<div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-plus font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">@lang('backend.System.Menu.add')</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! Form::open(array('id' => 'formAddMenu')) !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label>@lang('backend.System.Menu.name')</label>
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <img src="../assets/global/img/flags/vn.png" alt="">
                                        </span>
                                        <input autocomplete="off" type="text" class="form-control" name="CategoryName" placeholder="{!!trans('backend.System.Menu.name_in_vn')!!}"> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.System.Menu.link')</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </span>
                                    <input autocomplete="off" type="text" name="Slug" class="form-control" placeholder="{!!trans('backend.System.Menu.link')!!}"> </div>
                            </div> 
                            <div class="form-group">
                                <label>@lang('backend.System.Menu.choose_icon')</label>
                                <input autocomplete="off" type="text" name="Icon" class="form-control icon-picker" placeholder="{!!trans('backend.System.Menu.choose_icon_btn')!!}">
                            </div>                          
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn blue">@lang('backend.Common.add')</button>
                            <button type="button" class="btn default">@lang('backend.Common.reset')</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">@lang('backend.System.Menu.list')</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                        <a href="" class="reload"> </a>
                        <a href="" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body ">
                    <div class="dd" id="nestable_list_menu">
                        <ol class="dd-list" id="list-menu">
                        </ol>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn green margin-top-20 btn-save-menu">@lang('backend.Common.save')</button>
                </div>
            </div>
        </div>        
    </div>
    <input type="hidden" name="initMenu" id="initMenu" value='{!!$listMenu!!}'>
@stop

@section('footer-script')
    {!! Html::script('assets/js/libs/iconpicker.js') !!}
    {!! Html::script('assets/js/libs/jquery.ui.pos.js') !!}
	{!! Html::script('assets/js/libs/jquery.nestable.js') !!}
	{!! Html::script('assets/js/backend/system_menu.min.js') !!}
@stop