<?php include_once('header.php'); ?>

     <?php include_once('left-sidebar.php'); ?> 
	 <?php
	 $user_id = $_SESSION['user_id'];
	 
	$query_user_list="SELECT ts_student.id, registration_no, student_name, dob, class, batch_id, father_name, address, mobile_no, reg_date, ts_student.status FROM ts_student 
	INNER JOIN ts_class ON  ts_student.class_id=ts_class.id 
	INNER JOIN ts_batch ON  ts_student.batch_id=ts_batch.id
	where ts_student.id = '".$_SESSION['user_id']."'
	";
   	
	$r_id = $db->fetchRow($query_user_list);
	
	$reg_date = $r_id['reg_date'];
	$current_date = date('Y-m-d');
	$diff = abs(strtotime($current_date) - strtotime($reg_date));

	$month = floor($diff / (30*60*60*24));
	$fee_month = $month+1;
	
	$query_total_fee="SELECT  sum(fee) as total_fee FROM ts_batch 
	WHERE id in(".$r_id['batch_id'].")";
	$r_total_fee = $db->fetchRow($query_total_fee);
	
	$query_add_fee="SELECT  sum(paid_fee) as paid_fee FROM ts_fee 
	group by student_id
	having student_id = '".$_SESSION['user_id']."'
	";
   	
	$r_fee = $db->fetchRow($query_add_fee);
	$paid_fee = $r_fee['paid_fee'];
	$remaining_fee = ($r_total_fee['total_fee']*$fee_month)-$paid_fee;
	
	 $query_user_list="SELECT * FROM ts_fee WHERE registration_no ='".$_SESSION['user_name']."'";
	
     $r_user_list = $db->fetchResult($query_user_list);
	 
	 
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
                        <i class="fa fa-folder-open"></i><b>Pictorial Representation of Student. </b>;
                    </div>
                </div>
                <!--end  Welcome -->
            </div>



            <div class="row">
                <div class="col-lg-12">



                    <!--Area chart example -->
                    <!--<div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>

                    </div>-->
                    <!--End area chart example -->
                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Fee Detail 
                            
                        </div>

                        
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->

                </div>

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
				<div class="col-lg-12" style="display:none;">
                    <!-- Line chart -->
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
                    <!--End Line chart -->
                </div>
                <div class="col-lg-6">
                    <!-- pie chart-->
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
                      <!--end pie chart-->
                </div>
                <div class="col-lg-6" style="display:none;">
                     <!--  Multiple Axes Line Chart-->
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
                     <!-- End Multiple Axes Line Chart-->
                </div>
                <div class="col-lg-6" style="display:none;">
                    <!-- Moving Line Chart -->
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
                    <!--End Moving Line Chart -->
                </div>
                <div class="col-lg-6">
                    <!-- Bar Chart -->
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
                     <!--End Bar Chart -->
                </div>
				<div class="col-lg-12">


                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Event List 
                            
                        </div>

                        
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->

                </div>




                
            </div>

    

        </div>
      
   

    
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>   
   <div class="modal fade" id="view_cmp" role="dialog">
    
  </div>
  <div class="modal fade" id="reassign_complaint" role="dialog">
    
  </div>
    
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.pie.js"></script>
    <script src="assets/scripts/flot-demo.js"></script>
	
	
	<script class="include" type="text/javascript" src="assets/scripts/jquery.jqplot.min.js"></script>
    

    <script language="javascript" type="text/javascript" src="assets/scripts/jqplot.categoryAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="assets/scripts/jqplot.barRenderer.min.js"></script>
	<script language="javascript" type="text/javascript" src="assets/scripts/jqplot.pieRenderer.min.js"></script>
	
	<script>
	
	$(document).ready(function(){

    var data = [ {
        label: "Total Fee",
        data: <?php echo $r_total_fee['total_fee']*$fee_month;?>
    }, {
        label: "Paid Fee",
        data: <?php echo $paid_fee;?>
    }, {
        label: "Remaing Fee ",
        data: <?php echo $remaining_fee;?>
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
    var line1 = [['Total Fee', <?php echo $r_total_fee['total_fee']*$fee_month;?>],['Paid', <?php echo $paid_fee;?>],['Remaing Fee', <?php echo $remaining_fee;?>]];
 
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
