<!DOCTYPE html>
<html>
<head>
	<title>tes</title>
	<script src="<?php echo base_url('assets/grafik/') ?>code/highcharts.js"></script>
	<script src="<?php echo base_url('assets/grafik/') ?>code/modules/data.js"></script>
	<script src="<?php echo base_url('assets/grafik/') ?>code/modules/drilldown.js"></script>
</head>
<body>
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
	                            id: <?php echo "'".$outlet->id_info_pt."'"; ?>,
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
</body>
</html>