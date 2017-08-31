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
		
