<?php include_once('../../conn/db.php'); 
 include_once('../../functions.php'); 
//include("../../conn/dsn.php");

session_start();

if ( !isset($_SESSION['SESS_NAME']) ) {
	header('location: ../../index.php');
} else {
	
	$qry = "SELECT * FROM users WHERE username = '{$_SESSION['SESS_NAME']}'";
	mysql_select_db($database_dbconfig, $dbconfig);
	$result = mysql_query($qry, $dbconfig) or die(mysql_error());
	$user_arr = mysql_fetch_assoc($result);
	$role_id = $user_arr["role_id"];
}

$cur_year =  date("Y");
$ddate = date("Y-m-d");

$date_from_ = strtotime($ddate . ' -1 day');
$date_to_ = strtotime($ddate . ' +1 day');
				
				
function list_days($date_from_,$date_to_){
    $arr_days = array();
    $day_passed = ($date_to_ - $date_from_); //seconds
    $day_passed = ($day_passed/86400); //days

    $counter = 1;
    $day_to_display = $date_from_;
    while($counter < $day_passed){
        $day_to_display += 86400;
        //echo date("F j, Y \n", $day_to_display);
        $arr_days[] = date('o-m-d',$day_to_display);
        $counter++;
    }

    return $arr_days;
}

 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<link rel="shortcut icon" href="../../assets/favicon7753.png" type="image/png" />
	
    <title> Admin - Hotel Hillock</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"> Admin HMS </a>
            </div>
            <!-- /.navbar-header -->
		<?php include("topbar.php") ?>
           
		<?php include("sidebar.php"); ?>
		
        </nav>

		<?php 
			switch($role_id)
{

case 1: include("dashboard.php"); break;
case 2: include("dashboard.php"); break;
case 3: include("dashboard_u.php"); break;
case 4: include("dashboard_u.php"); break;
case 5: include("dashboard_u.php"); break;
case 6: include("dashboard_u.php"); break;

}
 ?>
 
       
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
   
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	
	<script type="text/javascript">
$(function () {
    $('#containers').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Delivered Amount'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rupees'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Rs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
			{
            name: 'Restaurant Orders',
			data: [
			<?php
				for($i=1;$i<=12;$i++)
				{
				
				$number = cal_days_in_month(CAL_GREGORIAN, $i, $cur_year);				
				
				$insertSQL = "SELECT COALESCE(SUM(price),0) as price,COALESCE(SUM(extra),0) as extra FROM `order_detail` c,`order` d where c.or_status = '0' and c.o_id=d.o_id
				 and `date` between ('$cur_year-$i-01') and ('$cur_year-$i-$number')";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
				$price_re = $row["price"];	
				$extra_res = $row["extra"];	
				
				$price_res = $price_re + $extra_res;
				
				echo $price_res.",";
				
				$tot_price_res = $tot_price_res + $price_res; 
				}	
				?>	
			]
		} ,
		{
            name: 'Hall Bookings',
			data: [
			<?php
				for($i=1;$i<=12;$i++)
				{
				
				$number = cal_days_in_month(CAL_GREGORIAN, $i, $cur_year);				
				
				$hallSQL = "SELECT COALESCE(SUM(total),0) as price FROM booking_hall where bh_status = '0' 
				and entry_date between ('$cur_year-$i-01') and ('$cur_year-$i-$number')";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resulth = mysql_query($hallSQL, $dbconfig) or die(mysql_error());	 
				$rowh = mysql_fetch_assoc($Resulth);
				
				$price_hall = $rowh["price"];	
		
				echo $price_hall.",";
				
				$tot_price_hall = $tot_price_hall + $price_hall; 
				}	
				?>	
			]
		},
		{
            name: 'Room Reservations',
			data: [
			<?php
				for($i=1;$i<=12;$i++)
				{
				
				$number = cal_days_in_month(CAL_GREGORIAN, $i, $cur_year);				
				
				
				
				$hotelSQL = "SELECT * FROM reserve where res_status = 0
				and entry_date between ('$cur_year-$i-01') and ('$cur_year-$i-$number')";
		mysql_select_db($database_dbconfig, $dbconfig);
		$Resultho = mysql_query($hotelSQL, $dbconfig) or die(mysql_error());	 
		$rowho = mysql_fetch_assoc($Resultho);
		$res_id_ 	 = $rowho["res_id"];
		$rent_		 = $rowho["rent"];
		$total_days_ = $rowho["total_days"];
				
				if($res_id_<>"")
				{
				$serSQL = "SELECT * FROM service_rec where res_id = '$res_id_'";
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultser = mysql_query($serSQL, $dbconfig) or die(mysql_error());
				while($rowser = mysql_fetch_assoc($Resultser))
				{
				$hs_id_ = $rowser["hs_id"];
				$hamount_ = get_title(hamount,$hs_id_);
				$tot_hamount_ = $tot_hamount_ + $hamount_; 	
				} 
				}
		$tot_price_ = ($total_days_ * $rent_);
		$sv_charges_ = 0.05 * $tot_price_;
		$total_ = $tot_price_ + $sv_charges_ + $tot_hamount_;
		
				echo $total_.",";
				$total_rsv = $total_rsv + $total_;
				$hamount_ = 0;
				$tot_price_ = 0;
				$tot_hamount_ = 0;
				$sv_charges_ = 0;
				$total_ = 0;
				?>
				<?php 
				}	
				?>	
			]
		}
		
			]
    });
});
		</script>
		
		<script type="text/javascript">
$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Yearly Delivered Amount'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
		tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Rs</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        series: [{
            name: 'Delivered amount',
            data: [
                ['Restaurant', <?php echo $tot_price_res; ?>],
                ['Hall', <?php echo $tot_price_hall; ?>],
                ['Hotel', <?php echo $total_rsv; ?>]
            ]
        }]
    });
});
		</script>
		
		
				<script type="text/javascript">
$(function () {
    $('#containers3').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Most Ordered Items'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
		series: [{
            name: 'Quantity',
            data: [
			<?php
			$itemsSQL = "SELECT COALESCE(SUM(quantity),0) as quantity,i_id FROM `order_detail` WHERE or_status = 0 group by i_id limit 10";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resultit = mysql_query($itemsSQL, $dbconfig) or die(mysql_error());	 
				while($rowit = mysql_fetch_assoc($Resultit))
				{
						$quantity = $rowit["quantity"];
						$i_id = $rowit["i_id"];
			?>	
				['<?php echo get_title(item,$i_id); ?>', <?php echo $quantity; ?>],
				<?php } ?>
                
            ]
        }]
    });
});
		</script>
		
		<script type="text/javascript">
$(function () {
    $('#container4').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Delivered Amount Comparison'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Rupees'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [
			{
            name: 'Restaurant Orders',
			data: [
			<?php
				for($i=1;$i<=12;$i++)
				{
				
				$number = cal_days_in_month(CAL_GREGORIAN, $i, $cur_year);				
				
				$insertSQL = "SELECT COALESCE(SUM(price),0) as price FROM `order_detail` c,`order` d where c.or_status = '0' and c.o_id=d.o_id
				 and `date` between ('$cur_year-$i-01') and ('$cur_year-$i-$number')";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Result1 = mysql_query($insertSQL, $dbconfig) or die(mysql_error());	 
				$row = mysql_fetch_assoc($Result1);
				
				$price_res = $row["price"];	
		
				echo $price_res.",";
				
				$tot_price_res = $tot_price_res + $price_res; 
				}	
				?>	
			]
		} ,
		{
            name: 'Hall Bookings',
			data: [
			<?php
				for($i=1;$i<=12;$i++)
				{
				
				$number = cal_days_in_month(CAL_GREGORIAN, $i, $cur_year);				
				
				$hallSQL = "SELECT COALESCE(SUM(total),0) as price FROM booking_hall where bh_status = '0' 
				and entry_date between ('$cur_year-$i-01') and ('$cur_year-$i-$number')";	
				mysql_select_db($database_dbconfig, $dbconfig);
				$Resulth = mysql_query($hallSQL, $dbconfig) or die(mysql_error());	 
				$rowh = mysql_fetch_assoc($Resulth);
				
				$price_hall = $rowh["price"];	
		
				echo $price_hall.",";
				
				$tot_price_hall = $tot_price_hall + $price_hall; 
				}	
				?>	
			]
		},
		{
            name: 'Room Reservations',
			data: [
			<?php
				for($i=1;$i<=12;$i++)
				{
				
				$number = cal_days_in_month(CAL_GREGORIAN, $i, $cur_year);				
				 $cur_date = $cur_year."-".$i."-01";
				//echo "</br>";
				 $end_date = $cur_year."-".$i."-".$number;
				//echo "</br>";
				echo get_sum_month(hotel_month,$cur_date,$end_date).",";	 
			
				}	
				?>	
			]
		}
		
			]
    });
});
		</script>
		
 <script src="../../js/highcharts.js"></script>
<script src="../../js/exporting.js"></script>
<script src="../../highcharts-3d.js"></script>

</body>

</html>
