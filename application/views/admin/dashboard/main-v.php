<script src="<?php echo base_url('assets/grafik/') ?>code/highcharts.js"></script>
<script src="<?php echo base_url('assets/grafik/') ?>code/modules/data.js"></script>
<script src="<?php echo base_url('assets/grafik/') ?>code/modules/drilldown.js"></script>
<div class="">
    <div class="row">
        <!-- task, page, download counter  start -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-yellow update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?php echo $jmldata; ?> Trx</h4>
                            <h6 class="text-white m-b-0">Trx Penjualan</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-1" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-pink update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?php echo $stnktunda; ?> Trx</h4>
                            <h6 class="text-white m-b-0">STNK Blm Selesai</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-3" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-lite-green update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?php echo $ttlleasing; ?> Trx</h4>
                            <h6 class="text-white m-b-0">Use Leasing</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-4" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-c-green update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?php echo $ttlchash; ?> Trx</h4>
                            <h6 class="text-white m-b-0">Bayar Chash</h6>
                        </div>
                        <div class="col-4 text-right">
                            <canvas id="update-chart-2" height="50"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                </div>
            </div>
        </div>
        <!-- task, page, download counter  end -->

        <!-- visitor start -->
       <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Penghasilan Outlet</h5>
                </div>
                <div class="card-block">
                    <div id="penghasilan"></div>
                    <script type="text/javascript">
                    // Create the chart
                    Highcharts.chart('penghasilan', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Penghasilan Peroutlet Harian'
                        },
                        subtitle: {
                            text: 'Klik Grafik untuk melihat detail penjualan'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Total Penghasilan Harian'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.1f}'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                        },

                        series: [{
                            name: 'Brands',
                            colorByPoint: true,
                            data: [
                            <?php foreach ($dtpt as $outlet): ?>
                                {
                                    name: <?php echo "'".$outlet->nama_info_pt."'"; ?>,
                                    y: <?php echo $outlet->total; ?>,
                                    drilldown: <?php echo "'".$outlet->id_info_pt."'"; ?>
                                },
                            <?php endforeach ?>
                             ]
                        }],
                        drilldown: {
                            series: [
                            <?php foreach ($dtpt as $outlet2): ?>
                                {
                                    name: <?php echo "'".$outlet->nama_info_pt."'"; ?>,
                                    id: <?php echo "'".$outlet2->id_info_pt."'"; ?>,
                                    data: [
                                    <?php $produk_record = $this->Admin_m->getprodukterjual($hariini,$outlet2->id_info_pt); ?>
                                    <?php foreach ($produk_record as $produk): ?>
                                        [
                                        <?php echo "'".$produk->nm_type."'"; ?>,
                                        <?php echo $produk->total; ?>,
                                        ],
                                    <?php endforeach ?>
                                    ]
                                },
                            <?php endforeach ?>
                            ]
                        }
                    });
                </script>
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

        <!-- income start -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Total Leads</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-5"></i> 18% High than last month</p>
                    <div class="row">
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Overall</p>
                            <h5>76.12%</h5>
                        </div>
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Monthly</p>
                            <h5>16.40%</h5>
                        </div>
                        <div class="col-4">
                            <p class="text-muted m-b-5">Day</p>
                            <h5>4.56%</h5>
                        </div>
                    </div>
                </div>
                <canvas id="tot-lead" height="150"></canvas>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Total Vendors</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <p class="text-c-pink f-w-500"><i class="feather icon-chevrons-down m-r-15"></i> 24% High than last month</p>
                    <div class="row">
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Overall</p>
                            <h5>68.52%</h5>
                        </div>
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Monthly</p>
                            <h5>28.90%</h5>
                        </div>
                        <div class="col-4">
                            <p class="text-muted m-b-5">Day</p>
                            <h5>13.50%</h5>
                        </div>
                    </div>
                </div>
                <canvas id="tot-vendor" height="150"></canvas>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Invoice Generate</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-15"></i> 20% High than last month</p>
                    <div class="row">
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Overall</p>
                            <h5>68.52%</h5>
                        </div>
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Monthly</p>
                            <h5>28.90%</h5>
                        </div>
                        <div class="col-4">
                            <p class="text-muted m-b-5">Day</p>
                            <h5>13.50%</h5>
                        </div>
                    </div>
                </div>
                <canvas id="invoice-gen" height="150"></canvas>
            </div>
        </div>
        <!-- income end -->

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

        <!-- social start -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Sales Analytics</h5>
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
                    <div id="sales-analytics" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <!-- social start -->

        <!--  sale analytics start -->
        <div class="col-xl-8 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left ">
                        <h5>Monthly View</h5>
                        <span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span>
                    </div>
                </div>
                <div class="card-block-big">
                    <div id="monthly-graph" style="height:305px"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>New Users</h5>
                </div>
                <div class="card-block">
                    <canvas id="newuserchart" height="250"></canvas>
                </div>
                <div class="card-footer ">
                    <div class="row text-center b-t-default">
                        <div class="col-4 b-r-default m-t-15">
                            <h5>85%</h5>
                            <p class="text-muted m-b-0">Satisfied</p>
                        </div>
                        <div class="col-4 b-r-default m-t-15">
                            <h5>6%</h5>
                            <p class="text-muted m-b-0">Unsatisfied</p>
                        </div>
                        <div class="col-4 m-t-15">
                            <h5>9%</h5>
                            <p class="text-muted m-b-0">NA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  sale analytics end -->
    </div>
</div>
