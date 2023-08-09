
<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="{{url('public/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('public/vendors/bower_components/bootstrap/dist/js/bootstrap.min.j')}}s"></script>
    
	<!-- Data table JavaScript -->
	<script src="{{url('public/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="{{url('public/dist/js/jquery.slimscroll.js')}}"></script>
	
	<!-- simpleWeather JavaScript -->
	<script src="{{url('public/vendors/bower_components/moment/min/moment.min.js')}}"></script>
	<script src="{{url('public/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js')}}"></script>
	<script src="{{url('public/dist/js/simpleweather-data.js')}}"></script>
	
	<!-- Progressbar Animation JavaScript -->
	<script src="{{url('public/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
	<script src="{{url('public/vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="{{url('public/dist/js/dropdown-bootstrap-extended.js')}}"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="{{url('public/vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>
	
	<!-- Owl JavaScript -->
	<script src="{{url('public/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')}}"></script>
	
	<!-- ChartJS JavaScript -->
	<script src="{{url('public/vendors/chart.js/Chart.min.js')}}"></script>
	
	<!-- EasyPieChart JavaScript -->
	<script src="{{url('public/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
	
	<!-- EChartJS JavaScript -->
	<script src="{{url('public/vendors/bower_components/echarts/dist/echarts-en.min.js')}}"></script>
	<script src="{{url('public/vendors/echarts-liquidfill.min.js')}}"></script>
	
	<!-- Toast JavaScript -->
	<script src="{{url('public/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
	
	<!-- Switchery JavaScript -->
	<script src="{{url('public/vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>
	
	<!-- Bootstrap Select JavaScript -->
	<script src="{{url('public/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	
	<!-- Init JavaScript -->
	<script src="{{url('public/dist/js/init.js')}}"></script>
	<script src="{{url('public/dist/js/ecommerce-data.js')}}"></script>





    <script src="{{url('public/plugins/jquery/dist/sweetalert2.all.min.js')}}"></script>
      <script src="{{url('public/jquery/dist/toastr.min.js')}}"></script>
    <script src="{{url('public/dist/js/function.js')}}"></script>
    <script src="{{url('public/vendors/product-image.js') }}"></script>
	<script type="text/javascript">
		$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>
	<script>
         let APP_URL = {!! json_encode(url('/')) !!};
      </script>
       @stack('scripts')
      