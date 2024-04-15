<?php include_once('header.php'); ?>

     <?php include_once('left-sidebar.php'); ?> 
	 <?php
	 $user_id = $_SESSION['user_id'];
	 
	 $current_date_time = date("Y-m-d H:i:s");
	


	 
	 if($_SESSION['admin_id'] > 1)
	 {
		$company_qur = "AND company='".$_SESSION['admin_id']."'"; 
	 }
	 
	
	 
	 
	 ?>
        <!--  page-wrapper -->
		<link href="assets/css/jquery.jqplot.min.css" rel="stylesheet" />
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard<?php //print_r($_SESSION); ?></h1>
                </div>
                <!--End Page Header -->
            </div>

            <div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <div style="text-align: center;padding:140px; font-size:30px;">WELCOME!
						<br><br>
						<img src="../upload/<?php echo $image; ?>" height="90px"> 
						
						</div>
                    </div>
                </div>
                <!--end  Welcome -->
            </div>


            <!--<div class="row">
                
                <div class="col-lg-3">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;<b><?php echo $sla_count;?> </b> Tickets cross SLA time line

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-success text-center">
                        <i class="fa  fa-beer fa-3x"></i>&nbsp;<b><?php echo $completed_ticket_count;?> </b>Closed Tickets 
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-info text-center">
                        <i class="fa fa-rss fa-3x"></i>&nbsp;<b><?php echo $open_ticket_count; ?></b> Open Tickets 

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="alert alert-warning text-center">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;<b><?php echo $process_ticket_count;?> </b> In Process Tickets
                    </div>
                </div>
                
            </div>-->

            <div class="row" >
               
               <!--<div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow">
                            <i class="fa fa-bar-chart-o fa-3x"></i>
                            <h3>20,741 </h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Daily User Visits
                            </span>
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body blue">
                            <i class="fa fa-pencil-square-o fa-3x"></i>
                            <h3>2,060 </h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Pending Orders Found
                            </span>
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green">
                            <i class="fa fa fa-floppy-o fa-3x"></i>
                            <h3>20 GB</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">New Data Uploaded
                            </span>
                        </div>
                    </div>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body red">
                            <i class="fa fa-thumbs-up fa-3x"></i>
                            <h3>2,700 </h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">New User Registered
                            </span>
                        </div>
                    </div>







                </div>-->
				</div>
				<!--<div class="col-lg-12" style="display:none;">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Line Chart Example
                        </div>
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pie Chart
                        </div>
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart"></div>
                            </div>
                        </div>
                    </div>
                      
                </div>
                <div class="col-lg-6" style="display:none;">
                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Multiple Axes Line Chart Example
                        </div>
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart-multi"></div>
                            </div>
                        </div>
                    </div>
                     
                </div>
                <div class="col-lg-6" style="display:none;">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Moving Line Chart Example
                        </div>
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart-moving"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bar Chart
                        </div>
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="chart2" class="example-chart" style="height:100%;width:100%"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>

    

        </div>
      
   
<div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
    
    <script src="../assets/plugins/jquery-1.10.2.js"></script>
    
    
    <!-- Page-Level Plugin Scripts-->
    <script src="../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../assets/scripts/flot-demo.js"></script>
	
	
	<script class="include" type="text/javascript" src="../assets/scripts/jquery.jqplot.min.js"></script>
    

    <script language="javascript" type="text/javascript" src="../assets/scripts/jqplot.categoryAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="../assets/scripts/jqplot.barRenderer.min.js"></script>
	<script>
	$(function() {

    var data = [{
        label: "In Process Tickets",
        data: <?php echo $process_ticket_count;?>
    }, {
        label: "Open Tickets",
        data: <?php echo $open_ticket_count;?>
    }, {
        label: "Tickets cross SLA time line",
        data: <?php echo $sla_count;?>
    }, {
        label: "Closed Tickets",
        data: <?php echo $completed_ticket_count;?>
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});

$(document).ready(function(){
    var line1 = [['Open Tickets', <?php echo $open_ticket_count;?>],['In Process Tickets', <?php echo $process_ticket_count;?>],['Tickets cross SLA time line', <?php echo $sla_count;?>],['Close Tickets', <?php echo $completed_ticket_count;?>]];
 
    $('#chart2').jqplot([line1], {
        //title:'Bar Chart with Varying Colors',
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {
                // Set the varyBarColor option to true to use different colors for each bar.
                // The default series colors are used.
                varyBarColor: true
            }
        },
        axes:{
            xaxis:{
                renderer: $.jqplot.CategoryAxisRenderer
            }
        }
    });
});

	</script>
	

</body>

</html>

		
		
  
 
   
   <?php include_once('footer.php'); ?>
