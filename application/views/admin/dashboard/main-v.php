
	
		<div class="row">
			<!-- task, page, download counter  start -->
			<div class="col-xl-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-yellow f-w-600">$30200</h4>
								<h6 class="text-muted m-b-0">All Earnings</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-bar-chart f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-yellow">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">% change</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-green f-w-600">290+</h4>
								<h6 class="text-muted m-b-0">Page Views</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-file-text f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-green">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">% change</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-pink f-w-600">145</h4>
								<h6 class="text-muted m-b-0">Task Completed</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-calendar f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-pink">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">% change</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="card">
					<div class="card-block">
						<div class="row align-items-center">
							<div class="col-8">
								<h4 class="text-c-blue f-w-600">500</h4>
								<h6 class="text-muted m-b-0">Downloads</h6>
							</div>
							<div class="col-4 text-right">
								<i class="feather icon-download f-28"></i>
							</div>
						</div>
					</div>
					<div class="card-footer bg-c-blue">
						<div class="row align-items-center">
							<div class="col-9">
								<p class="text-white m-b-0">% change</p>
							</div>
							<div class="col-3 text-right">
								<i class="feather icon-trending-up text-white f-16"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- task, page, download counter  end -->

			<!-- visitor start -->
			<div class="col-xl-8 col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Visitors</h5>
						<span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span>
						<div class="card-header-right">
							<ul class="list-unstyled card-option">
								<li><i class="feather icon-maximize full-card"></i></li>
								<li><i class="feather icon-minus minimize-card"></i></li>
								<li><i class="feather icon-trash-2 close-card"></i></li>
							</ul>
						</div>
					</div>
					<div class="card-block">
						<div id="visitor" style="height:300px"></div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-12">
				<div class="card">
					<div class="card-block bg-c-green">
						<div id="proj-earning" style="height: 230px"></div>
					</div>
					<div class="card-footer">
						<h6 class="text-muted m-b-30 m-t-15">Total completed project and earning</h6>
						<div class="row text-center">
							<div class="col-6 b-r-default">
								<h6 class="text-muted m-b-10">Completed Projects</h6>
								<h4 class="m-b-0 f-w-600 ">175</h4>
							</div>
							<div class="col-6">
								<h6 class="text-muted m-b-10">Total Earnings</h6>
								<h4 class="m-b-0 f-w-600 ">76.6M</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- visitor end -->

			<!-- sale order start -->
			<div class="col-xl-4 col-md-6">
				<div class="card o-hidden">
					<div class="card-block bg-c-pink text-white">
						<h6>Sales Per Day <span class="f-right"><i class="feather icon-activity m-r-15"></i>3%</span></h6>
						<canvas id="sale-chart1" height="150"></canvas>
					</div>
					<div class="card-footer text-center">
						<div class="row">
							<div class="col-6 b-r-default">
								<h4>$4230</h4>
								<p class="text-muted m-b-0">Total Revenue</p>
							</div>
							<div class="col-6">
								<h4>321</h4>
								<p class="text-muted m-b-0">Today Sales</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="card o-hidden">
					<div class="card-block bg-c-green text-white">
						<h6>Visits<span class="f-right"><i class="feather icon-activity m-r-15"></i>9%</span></h6>
						<canvas id="sale-chart2" height="150"></canvas>
					</div>
					<div class="card-footer text-center">
						<div class="row">
							<div class="col-6 b-r-default">
								<h4>3562</h4>
								<p class="text-muted m-b-0">Monthly Visits</p>
							</div>
							<div class="col-6">
								<h4>96</h4>
								<p class="text-muted m-b-0">Today Visits</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-12">
				<div class="card o-hidden">
					<div class="card-block bg-c-blue text-white">
						<h6>Orders<span class="f-right"><i class="feather icon-activity m-r-15"></i>12%</span></h6>
						<canvas id="sale-chart3" height="150"></canvas>
					</div>
					<div class="card-footer text-center">
						<div class="row">
							<div class="col-6 b-r-default">
								<h4>1695</h4>
								<p class="text-muted m-b-0">Monthly Orders</p>
							</div>
							<div class="col-6">
								<h4>52</h4>
								<p class="text-muted m-b-0">Today Orders</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- sale order end -->

			
		</div>
	</div>
</div>

<div id="styleSelector">

</div>


                       
	
