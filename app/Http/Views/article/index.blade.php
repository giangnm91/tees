@extends('layout.backend')
@section('header-script')
	{!! Html::style('https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css', array('media' => 'screen')) !!}
	
@stop
@section('content')
    @include('layout.breadcrumbs')
	<div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-docs font-dark"></i>
                        <span class="caption-subject bold uppercase"> @lang('backend.Article.page_title')</span>
                    </div>
                    <!-- <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                    </div> -->
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button id="btn_add_new" class="btn sbold green"> @lang('backend.Article.page_add')
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> Print </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <div class="page-toolbar">
                                        <div id="filter-created-range" class="pull-right tooltips btn btn-fit-height green" data-placement="top" data-original-title="{!! trans('backend.Article.create_date_range') !!}">
                                            <i class="icon-calendar"></i>&nbsp;
                                            <span class="thin uppercase hidden-xs"></span>&nbsp;
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="article_table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> 
                                </th>
                                <th> @lang('backend.Article.name') </th>
                                <th> @lang('backend.Article.category') </th>
                                <th> @lang('backend.Article.excerpt') </th>
                                <th> @lang('backend.Article.created_time') </th>
                                <th> @lang('backend.Article.modified_time') </th>
                                <th> @lang('backend.Article.author') </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@stop
@section('footer-script')
	{!!Html::script('https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js')!!}
    {!!Html::script('assets/js/backend/article.min.js')!!}
@stop
