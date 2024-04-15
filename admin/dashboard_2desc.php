<?php include_once('header.php'); ?>

     <?php include_once('left-sidebar.php'); ?> 
	 <?php
	 $user_id = $_SESSION['user_id'];
	 
	 $current_date_time = date("Y-m-d H:i:s");
	
	function calculate_work($request)
{
    $start = strtotime($request['start']);
    $end = strtotime($request['end']);
    $work_time = 0;

    /* Add 1 minute to the start so that we don't count 0 as a minute  */
    for ($time = $start + 60; $time <= $end; $time += 60)
    {
        // Weekends
        //if (date('D', $time) == 'Sat' OR date('D', $time) == 'Sun')
            //continue;
		if ( date('D', $time) == 'Sun')
            continue;

        // Non Working Hours
        if (date('Hi', $time) <= '0900' OR date('Hi', $time) > '1800')
            continue;

        // On Hold
        if ($time > strtotime('3PM Dec 2 2013') AND $time <= strtotime('3PM Dec 3 2013'))
            continue;

        $work_time++;
    }

    // Divide by 60 to turn minutes into hours
    return $work_time / 60;
}

	 
	 if($_SESSION['admin_id'] > 1)
	 {
		$company_qur = "AND company='".$_SESSION['admin_id']."'"; 
	 }
	 
	
	 $query="SELECT count(id) AS total_count FROM ts_tickets WHERE 1 $company_qur AND cmp_status='Open'";	 	 
	 
	 $open_ticket = $db->fetchRow($query);
	 $open_ticket_count = $open_ticket['total_count'];
	 
	 $query="SELECT count(id) AS total_count FROM ts_tickets WHERE 1 $company_qur AND cmp_status='Completed'";
	 
	 $completed_ticket = $db->fetchRow($query);
	 $completed_ticket_count = $completed_ticket['total_count'];
	 
	 $query="SELECT count(id) AS total_count FROM ts_tickets WHERE 1 $company_qur AND cmp_status='In Process'";
	  
	 $process_ticket = $db->fetchRow($query);
	 $process_ticket_count = $process_ticket['total_count'];
	 
	
	 $query="SELECT id,cmp_no,cmp_full_name,cmp_phn_no,cmp_dep,cmp_group,cmp_company,cmp_date,cmp_status,reassign FROM ts_tickets WHERE 1 $company_qur AND  cmp_status='Open' ";
	
	 
	 $sla_ticket = $db->fetchResult($query);
	 $sla_count = 0;
	 foreach($sla_ticket as $value){
		 $request = array(
					'start' => $value['cmp_date'],
					'end' => $current_date_time
					);

				   $work_hour =  calculate_work($request);
				   $sql = "SELECT group_name, sla from ts_group where group_id='".$value['cmp_group']."'";
				   $group_against_qur = $db->fetchRow($sql);
				   @$group_against_name = $group_against_qur['group_name']; 
				   @$sla = $group_against_qur['sla']; 
				   $sql = "SELECT count(id) as comment_count FROM ts_comment where ticket_id='".$value['id']."'";
				   $comment_count_qur = $db->fetchRow($sql);
				   $comment_count = $comment_count_qur['comment_count'];
					if(($work_hour >$sla)&&($comment_count==0))
					{
					$sla_count++;	
					}
		 
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
                        <i class="fa fa-folder-open"></i><b>Support Tickets Pending to Answer. </b>;
                    </div>
                </div>
                <!--end  Welcome -->
            </div>


            <div class="row">
                <!--quick info section -->
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
                <!--end quick info section -->
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
                            <i class="fa fa-bar-chart-o fa-fw"></i> Tickets cross SLA time line 
                            
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Complainant_no</th>
                                                    <th>Complainant Name</th>
                                                    <th>Mobile No</th>
                                                    <th>Department</th>
													<th>Group</th>
													<th>Company</th>
													<th>Date</th>
													<th>Status</th>
													<th>Reassign</th>
													<th>View Detail</th>
													
													
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
					foreach($sla_ticket as $value){
					$request = array(
					'start' => $value['cmp_date'],
					'end' => $current_date_time
					);

					$work_hour =  calculate_work($request);
					$sql = "SELECT group_name, sla from ts_group where group_id='".$value['cmp_group']."'";
					$group_against_qur = $db->fetchRow($sql);
					@$group_against_name = $group_against_qur['group_name']; 
					@$sla = $group_against_qur['sla']; 
					$sql = "SELECT dep_name from ts_department where dep_id='".$value['cmp_dep']."'";
				   $dept_against_qur = $db->fetchResult($sql);
				   @$dept_against_name = $dept_against_qur[0]['dep_name']; 
				   $sql = "SELECT count(id) as comment_count FROM ts_comment where ticket_id='".$value['id']."'";
				   $comment_count_qur = $db->fetchRow($sql);
				   $comment_count = $comment_count_qur['comment_count'];
								if(($work_hour >$sla)&&($comment_count==0))
								{
				?>
                                                <tr style="background-color: #f2dede;">
                                                    <td><?php echo $value['cmp_no'];?></td>
                                                    <td><?php echo $value['cmp_full_name'];?></td>
                                                    <td><?php echo $value['cmp_phn_no'];?></td>
                                                    <td><?php echo $dept_against_name;?></td>
													<td><?php echo $group_against_name;?></td>
													<td><?php echo $value['cmp_company'];?></td>
													<td><?php echo $value['cmp_date'];?></td>
													<td><?php echo $value['cmp_status'];?></td>
													<td><?php echo $value['reassign']; ?></td>
													<td class="center"><a href="#" class="btn btn-outline btn-link" data-id="<?php echo $value['id']; ?>" data-toggle="modal" data-target="#view_cmp" onclick="view_complaint('<?php echo $value['id']; ?>','view_cmp');">View Detail</a></td>
                                                </tr>
                                                
					<?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
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
