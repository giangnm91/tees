@extends('layout.backend')
@section('content')

@include('layout.page_header')
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="index.html">@lang('backend.Breadcrumbs.home')</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">@lang('backend.Breadcrumbs.dashboard')</span>
    </li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE BASE CONTENT -->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number"> +
                    <span data-counter="counterup" data-value="85">0</span>
                </div>
                <div class="desc"> @lang('backend.Statistics.new_post') </div>
            </div>
            <a class="more" href="javascript:;"> @lang('backend.view_more')
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="8205">0</span></div>
                <div class="desc"> @lang('backend.Statistics.visit') </div>
            </div>
            <a class="more" href="javascript:;"> @lang('backend.view_more')
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="549">0</span>
                </div>
                <div class="desc"> @lang('backend.Statistics.comment') </div>
            </div>
            <a class="more" href="javascript:;"> @lang('backend.view_more')
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1202"></span> </div>
                <div class="desc"> @lang('backend.Statistics.total_post') </div>
            </div>
            <a class="more" href="javascript:;"> @lang('backend.view_more')
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green"></i>
                    <span class="caption-subject font-green bold uppercase">@lang('backend.Statistics.visit')</span>
                    <span class="caption-helper">@lang('backend.Statistics.monthly_stats')...</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn red btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">@lang('backend.Statistics.visit_new')</label>
                        <label class="btn red btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="option2">@lang('backend.Statistics.visit_return')</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div id="site_statistics_loading">
                    <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                <div id="site_statistics_content" class="display-none">
                    <div id="site_statistics" class="chart"> </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">@lang('backend.Statistics.comment')</span>
                    <span class="caption-helper">@lang('backend.Statistics.monthly_stats')...</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a href="" class="btn dark btn-outline btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter Range
                            <span class="fa fa-angle-down"> </span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;"> Q1 2014
                                    <span class="label label-sm label-default"> @lang('backend.Statistics.past') </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;"> Q2 2014
                                    <span class="label label-sm label-default"> @lang('backend.Statistics.past') </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="javascript:;"> Q3 2014
                                    <span class="label label-sm label-success"> @lang('backend.Statistics.current') </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;"> Q4 2014
                                    <span class="label label-sm label-warning"> @lang('backend.Statistics.upcoming') </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div id="site_activities_loading">
                    <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                <div id="site_activities_content" class="display-none">
                    <div id="site_activities" style="height: 228px;"> </div>
                </div>
                <div style="margin: 20px 0 10px 30px">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                            <span class="label label-sm label-success"> Revenue: </span>
                            <h3>$13,234</h3>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                            <span class="label label-sm label-info"> Tax: </span>
                            <h3>$134,900</h3>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                            <span class="label label-sm label-danger"> Shipment: </span>
                            <h3>$1,134</h3>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                            <span class="label label-sm label-warning"> Orders: </span>
                            <h3>235090</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
@stop