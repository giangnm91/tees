<!DOCTYPE html>
<html lang="en-us" ng-app="JavApplication">
    <head>
        @include('layout._meta')
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {!! Html::style('assets/css/libs/bootstrap.min.css', array('media' => 'screen')) !!}
        {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
        {!! Html::style('assets/css/libs/font-awesome.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/css/libs/sweetalert.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/global/plugins/simple-line-icons/simple-line-icons.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/global/plugins/uniform/css/uniform.default.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/global/plugins/fullcalendar/fullcalendar.min.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/global/plugins/morris/morris.css') !!}
        {!! Html::style('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') !!}
        {!! Html::style('assets/global/css/components-md.min.css') !!}
        {!! Html::style('assets/global/css/plugins-md.min.css') !!}
        {!! Html::style('assets/global/plugins/bootstrap-toastr/toastr.css') !!}
        {!! Html::style('assets/global/plugins/pace/themes/pace-theme-flash.css') !!}
        {!! Html::style('assets/layouts/layout4/css/layout.min.css') !!}
        {!! Html::style('assets/layouts/layout4/css/themes/light.min.css') !!}
        {!! Html::style('assets/css/libs/sweetalert.css', array('media' => 'screen')) !!}
        {!! Html::style('assets/css/custom.min.css') !!}        
        {!! Html::style('http://codemirror.net/lib/codemirror.css', array('media' => 'screen')) !!}
        {!! Html::style('http://codemirror.net/theme/twilight.css', array('media' => 'screen')) !!}
        <!-- END THEME LAYOUT STYLES -->
        @yield('header-script')
    </head>        
    <body class="page-container-bg-solid page-header-fixed page-md page-sidebar-closed">
        @include('layout.header')      
        @include('layout.sidebar')
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" ng-view></div>
        </div>
        <footer>
            <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>            
            <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
            {!! Html::script('assets/js/libs/angular.min.js') !!}
            <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            {!! Html::script('assets/js/backend/main.js') !!}
            {!! Html::script('assets/js/libs/sweetalert.min.js') !!}
            {!! Html::script('assets/global/plugins/bootstrap-toastr/toastr.js') !!}
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
            <script src="../assets/js/libs/jquery.livequery.js" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            
            {!! Html::script('assets/js/libs/angucomplete.js') !!}
            {!! Html::script('assets/js/libs/ui-bootstrap-tpls-1.3.2.min.js') !!}
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="../assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
            <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
            {!! Html::script('//ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.js') !!}
            {!! Html::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js') !!}
            {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/oclazyload/1.0.9/ocLazyLoad.min.js') !!}
            {!! Html::script('http://textangular.com/dist/textAngular-rangy.min.js') !!}
            {!! Html::script('http://textangular.com/dist/textAngular-sanitize.min.js') !!}
            {!! Html::script('http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular.min.js') !!}

            
            <script src="assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
            <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            {!! Html::script('assets/js/angular/app.js') !!}
            {!! Html::script('assets/js/angular/filters.js') !!}
            {!! Html::script('assets/js/angular/directive.js') !!}
            @yield('footer-script')
        </footer>
    </body>
</html>
