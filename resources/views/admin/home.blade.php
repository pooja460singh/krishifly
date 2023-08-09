
@extends('admin.layouts.master')
@section('content')
<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
            	<div class="row mt-30">
            		@include('admin.partials.alerts')
            		<div class="col-sm-6 col-md-3 mb-20">
		              <div class="card card-stats animate fadeLeft">
		                <div class="card-header card-header-warning card-header-icon">
		                  <div class="card-icon">
		                    <i class="fa fa-shopping-bag"></i>
		                  </div>
		                  <p class="card-category">Total Orders</p>
		                  <h3 class="card-title">1885
		               
		                  </h3>
		                </div>
		                <div class="card-footer"></div>
		              </div>
		            </div>
		            <div class="col-sm-6 col-md-3 mb-20">
		              <div class="card card-stats animate fadeLeft">
		                <div class="card-header card-header-warning card-header-icon card-success">
		                  <div class="card-icon">
		                    <i class="fa fa-cart-plus"></i>
		                  </div>
		                  <p class="card-category">Total Delivery</p>
		                  <h3 class="card-title">1885
		               
		                  </h3>
		                </div>
		                <div class="card-footer"></div>
		              </div>
		            </div>
		            <div class="col-sm-6 col-md-3 mb-20">
		              <div class="card card-stats animate fadeLeft">
		                <div class="card-header card-header-warning card-header-icon card-pending">
		                  <div class="card-icon">
		                    <i class="fa fa-times-circle-o"></i>
		                  </div>
		                  <p class="card-category">Total Pending</p>
		                  <h3 class="card-title">1885
		               
		                  </h3>
		                </div>
		                <div class="card-footer"></div>
		              </div>
		            </div>
		            <div class="col-sm-6 col-md-3 mb-20">
		              <div class="card card-stats animate fadeLeft">
		                <div class="card-header card-header-warning card-header-icon card-purchase">
		                  <div class="card-icon">
		                    <i class="fa fa-shopping-basket"></i>
		                  </div>
		                  <p class="card-category">This Month Purchase</p>
		                  <h3 class="card-title">1885
		               
		                  </h3>
		                </div>
		                <div class="card-footer"></div>
		              </div>
		            </div>
            	</div>
				<!-- Row -->
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Order Overview</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row">
									<div class="col-sm-6 pa-0">
										<div id="e_chart_3" class="" style="height:185px;"></div>
									</div>
									<div class="col-sm-6 pr-0 pt-30">
										<div class="label-chatrs">
											<div class="mb-5">
												<span class="clabels circular-clabels inline-block bg-green mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Order Cancled</span>
											</div>
											<div class="mb-5">
												<span class="clabels circular-clabels inline-block bg-gold mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Order Completed</span>
											</div>
											<div class="mb-5">
												<span class="clabels circular-clabels inline-block bg-yellow mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Order Pending</span>
											</div>
											<div class="">
												<span class="clabels circular-clabels inline-block bg-beige mr-5"></span>
												<span class="clabels-text font-12 inline-block txt-dark capitalize-font">Order Delivered</span>
											</div>											
										</div>
									</div>										
								</div>	
							</div>
						</div>
						
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Order Overview</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row" style="padding: 20px 20px;">
									<div class="mt-20">
				                      	<h4 style="margin-bottom: 3px;">30</h4>
				                      	<h6 style="color: #616161;">Online Order <span class="pull-right">30%</span></h6>
				                      	<div class="progress mb-3" style="height: 7px">
				                          	<div class="progress-bar bg-primary" style="width: 30%;" role="progressbar"><span class="sr-only">30% Order</span>
				                          	</div>
				                      	</div>
				                  	</div>
				                  	<div class="mt-20">
				                      	<h4 style="margin-bottom: 3px;">20</h4>
				                      	<h6 style="color: #616161;">Cash On Develery <span class="pull-right">30%</span></h6>
				                      	<div class="progress mb-3" style="height: 7px">
				                          	<div class="progress-bar bg-warning" style="width: 30%;" role="progressbar"><span class="sr-only">20% Order</span>
				                          	</div>
				                      	</div>
				                  	</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-12 col-md-12 col-xs-12">
						<div class="panel panel-default card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Latest Transaction</h6>
								</div>
								<div class="pull-right">
									<a href="javascript:void(0)" class="pull-left btn btn-success btn-xs mr-15">view all</a>
									<a href="#" class="pull-left inline-block refresh mr-15">
										<i class="zmdi zmdi-replay"></i>
									</a>
									<a href="#" class="pull-left inline-block full-screen mr-15">
										<i class="zmdi zmdi-fullscreen"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table  display table-hover border-none">
												<thead>
													<tr>
														<th>#Invoice</th>
														<th>Description</th>
														<th>Amount</th>
														<th>Status</th>
														<th>issue date</th>
														<th>due date</th>
													</tr>
												</thead>

												<tbody>
													<tr>
														<td>#5012</td>
														<td>System Architect</td>
														<td>$205,500</td>
														<td>
															<span class="label label-danger">unpaid</span>
														</td>
														<td>2011/04/25</td>
														<td>2012/12/02</td>
														
													</tr>
													<tr>
														<td>#5013</td>
														<td>Accountant</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2011/07/25</td>
														<td>2012/12/02</td>
														
													</tr>
													<tr>
														<td>#5014</td>
														<td>Junior Technical Author</td>
														<td>$205,500</td>
														<td>
															<span class="label label-warning">pending</span>
														</td>
														<td>2009/01/12</td>
														<td>2012/12/02</td>
														
													</tr>
													<tr>
														<td>#5015</td>
														<td>Senior Javascript Developer</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2012/03/29</td>
														<td>2012/12/02</td>
														
													</tr>
													<tr>
														<td>#5010</td>
														<td>Integration Specialist</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2010/10/14</td>
														<td>2014/09/15</td>
														
													</tr>
													<tr>
														<td>#5011</td>
														<td>Javascript Developer</td>
														<td>$205,500</td>
														<td>
															<span class="label label-success">paid</span>
														</td>
														<td>2009/09/15</td>
														<td>2013/09/15</td>
														
													</tr>
													
												</tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div>
					
				</div>
				<!-- /Row -->
			</div>

			@endsection