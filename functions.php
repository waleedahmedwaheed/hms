<?php
include_once('conn/db.php');

function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' , ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' AND ';
    $dictionary  = array(
        0                   => 'ZERO',
        1                   => 'ONE',
        2                   => 'TWO',
        3                   => 'THREE',
        4                   => 'FOUR',
        5                   => 'FIVE',
        6                   => 'SIX',
        7                   => 'SEVEN',
        8                   => 'EIGHT',
        9                   => 'NINE',
        10                  => 'TEN',
        11                  => 'ELEVEN',
        12                  => 'TWELVE',
        13                  => 'THIRTEEN',
        14                  => 'FOURTEEN',
        15                  => 'FIFTEEN',
        16                  => 'SIXTEEN',
        17                  => 'SEVENTEEN',
        18                  => 'EIGHTEEN',
        19                  => 'NINETEEN',
        20                  => 'TWENTY',
        30                  => 'THIRTY',
        40                  => 'FORTY',
        50                  => 'FIFTY',
        60                  => 'SIXTY',
        70                  => 'SEVENTY',
        80                  => 'EIGHTY',
        90                  => 'NINETY',
        100                 => 'HUNDRED',
        1000                => 'THOUSAND',
        1000000             => 'MILLION',
        1000000000          => 'BILLION',
        1000000000000       => 'TRILLION',
        1000000000000000    => 'QUADRILLION',
        1000000000000000000 => 'QUINTILLION'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words)." PAISAS";
    }
    
    return $string;
}


function get_title($mode,$text){
switch($mode)
{
case category: $sql2 = "select mc_name title from menu_category where mc_id ='$text'"; break;   
case cuisine:  $sql2 = "select cs_name title from cuisine where cs_id ='$text'"; break;   
case role:	   $sql2 = "select role_name title from roles where cat ='$text'"; break;   
case table:	   $sql2 = "select tbl_name title from tables where tbl_id ='$text'"; break;   
case username: $sql2 = "select username title from users where u_id ='$text'"; break;   
case price:	   $sql2 = "select i_price title from items where i_id ='$text'"; break;   
case item:	   $sql2 = "select i_name title from items where i_id ='$text'"; break;   
case hall:	   $sql2 = "select hl_name title from halls where hl_id ='$text'"; break;   
case menu:	   $sql2 = "select mn_desc title from menu_hall where mn_id ='$text'"; break;   
case room:	   $sql2 = "select rt_name title from rooms_types where rt_id ='$text'"; break;   
case hservice: $sql2 = "select hs_name title from hall_service where hs_id ='$text'"; break;   
case hamount:  $sql2 = "select hs_amount title from hall_service where hs_id ='$text'"; break;      
case mn_rate:  $sql2 = "select mn_rate title from menu_hall where mn_id ='$text'"; break;      
case mn_person:$sql2 = "select mn_person title from menu_hall where mn_id ='$text'"; break;      
case res_room: $sql2 = "select room_no title from reserve where res_id ='$text'"; break;      
case exp_item: $sql2 = "select ei_name title from exp_items where ei_id ='$text'"; break;      
case stock_out: $sql2 = "SELECT COALESCE((select sum(quantity) FROM `order_detail` c,`order` b WHERE b.bill=1 and c.or_status=0 and b.o_id=c.o_id and c.i_id='$text'),0) as title"; break;      
case stock_in: $sql2 = "select COALESCE(IFNULL(s.i_quantity, 0)) - COALESCE(IFNULL(qty, 0)) title from 
(SELECT d.i_id,COALESCE(SUM(IFNULL(d.quantity, 0))) qty FROM `order_detail` d,`order` o
where o.o_id=d.o_id
and o.bill=1
and d.or_status=0
and d.i_id = '$text'
group by d.i_id)o1
,(select i_id, COALESCE(SUM(IFNULL(i_quantity, 0))) i_quantity  from stock where i_id='$text' group by i_id)s
where s.i_id=o1.i_id
"; break;     
case stock: $sql2 = "SELECT COALESCE( (SELECT SUM(i_quantity) FROM stock WHERE i_id = '$text'), 0) as title"; break; 
case hall_exp: $sql2 = "select sum(exp_price) as title FROM hall_exp WHERE bh_id='$text' and exp_status=0"; break;  
case order_tot:  $sql2 = "SELECT (COALESCE(SUM(od.price),0) + COALESCE(o.extra,0)) - COALESCE(o.discount,0) as title FROM `order_detail` od , `order` o
where od.o_id = o.o_id and od.or_status = 0 and o.o_id = '$text'"; break;    
 
}
$result = mysql_query($sql2);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows = mysql_fetch_assoc($result);
$title	= $rows["title"];
return $title;
}


function get_count($mode)
{
$cur_date = date("Y-m-d");
switch($mode)
{
case t_order:    	$sql2 = "select count(o_id) as count from `order` where status = 0"; break;
case t_porder:   	$sql2 = "select count(o_id) as count from `order` where status = 0 and bill = 0"; break;
case active:     	$sql2 = "select count(o_id) as count from `order` where status = 0 and bill = 0"; break;
case inactive: 	    $sql2 = "select count(d.tbl_id) as count from `order` c, tables d where c.bill = 1 and d.tbl_status = 0 and c.tbl_id=d.tbl_id"; break;
case cur_orders: 	$sql2 = "SELECT count(o_id) as count FROM `order` WHERE `date`='$cur_date'"; break;
case cur_bookings:  $sql2 = "SELECT count(bh_id) as count FROM booking_hall where bh_status = '0'and entry_date = '$cur_date'"; break;
case cur_reserve:   $sql2 = "SELECT count(res_id) as count FROM reserve where res_status = 0 and entry_date = '$cur_date'"; break;

}
$result = mysql_query($sql2);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows = mysql_fetch_assoc($result);
$title	= $rows["count"];
return $title;
}

function get_sum($mode_,$text_){
switch($mode_)
{
case restaurant: $sql2_ = "select titles , o2.ext , o2.dis , (o2.ext+titles)-o2.dis amount  from
(SELECT COALESCE(SUM(price),0) as titles,c.o_id FROM `order_detail` c,`order` d where c.or_status = '0' and c.o_id=d.o_id and `date`='$text_') o1 ,
(SELECT COALESCE(SUM(extra),0) as ext,COALESCE(SUM(discount),0) as dis,o_id FROM `order` d where d.bill = '1' and d.status=0 and `date`='$text_') o2
where o1.o_id = o2.o_id"; break;

case hotel:		 $sql2_ = "select titles,o2.hs_amt,COALESCE(sum(titles + o2.hs_amt),0) as amount  from
(select COALESCE(sum(rent*total_days),0) as titles,res_date from reserve where res_status = 0 and res_date = '$text_') o1 ,
(select COALESCE(sum(h.hs_amount),0) as hs_amt,r.res_date from reserve r, service_rec s,hall_service h where r.res_status = 0 and r.res_date = '$text_' and r.res_id = s.res_id and s.hs_id=h.hs_id ) o2
"; break;
//where o1.res_date = o2.res_date"; break;

case hall:		 $sql2_ = "select o1.totals,dis,tax,o2.hs_amt,o3.other,o4.exp, COALESCE(sum((o1.totals + tax + o2.hs_amt + o3.other)-(dis + o4.exp)),0) as amount  from
(select COALESCE(sum(total),0) as totals,COALESCE(sum(discount),0) as dis,COALESCE(sum(tax),0) as tax,bh_id from booking_hall 
where bh_status = 0 and entry_date = '$text_') o1 ,
(SELECT COALESCE(sum(h.hs_amount),0) as hs_amt,b.bh_id FROM booking_hall b, booking_detail bd, service_rec s, hall_service h 
where b.bh_id=bd.bh_id and bd.bd_id = s.bd_id 
and s.hs_id = h.hs_id
and b.bh_status = 0 and b.entry_date = '$text_') o2,
(SELECT COALESCE(sum(bd.other_rate),0) as other,b.bh_id FROM booking_hall b, booking_detail bd
where b.bh_id=bd.bh_id and b.bh_status = 0 and b.entry_date = '$text_') o3,
(SELECT COALESCE(sum(he.exp_price),0) as exp,b.bh_id FROM booking_hall b, hall_exp he
where b.bh_id=he.bh_id and he.exp_status = 0 and b.entry_date = '$text_') o4"; break;
//where o1.bh_id = o2.bh_id and o1.bh_id = o3.bh_id and o1.bh_id = o4.bh_id"; break;

case expense: 	$sql2_ = "SELECT COALESCE(SUM(exp_amount),0) as amount FROM expenses where exp_date = '$text_' and exp_status = '0'";break;


case open_restaurant:   $sql2_ = "select titles , o2.ext , o2.dis , (o2.ext+titles)-o2.dis amount  from
(SELECT COALESCE(SUM(price),0) as titles,c.o_id FROM `order_detail` c,`order` d where c.or_status = '0' and c.o_id=d.o_id and `date`<'$text_') o1 ,
(SELECT COALESCE(SUM(extra),0) as ext,COALESCE(SUM(discount),0) as dis,o_id FROM `order` d where d.bill = '1' and d.status=0 and `date`<'$text_') o2
where o1.o_id = o2.o_id"; break;

case open_hotel:		 $sql2_ = "select titles,o2.hs_amt,COALESCE(sum(titles + o2.hs_amt),0) as amount  from
(select COALESCE(sum(rent*total_days),0) as titles,res_date from reserve where res_status = 0 and res_date < '$text_') o1 ,
(select COALESCE(sum(h.hs_amount),0) as hs_amt,r.res_date from reserve r, service_rec s,hall_service h where r.res_status = 0 and r.res_date < '$text_' and r.res_id = s.res_id and s.hs_id=h.hs_id ) o2
"; break;
//where o1.res_date = o2.res_date"; break;

case open_hall:		 $sql2_ = "select o1.totals,dis,tax,o2.hs_amt,o3.other,o4.exp, COALESCE(sum((o1.totals + tax + o2.hs_amt + o3.other)-(dis + o4.exp)),0) as amount  from
(select COALESCE(sum(total),0) as totals,COALESCE(sum(discount),0) as dis,COALESCE(sum(tax),0) as tax,bh_id from booking_hall 
where bh_status = 0 and entry_date < '$text_') o1 ,
(SELECT COALESCE(sum(h.hs_amount),0) as hs_amt,b.bh_id FROM booking_hall b, booking_detail bd, service_rec s, hall_service h 
where b.bh_id=bd.bh_id and bd.bd_id = s.bd_id 
and s.hs_id = h.hs_id
and b.bh_status = 0 and b.entry_date < '$text_') o2,
(SELECT COALESCE(sum(bd.other_rate),0) as other,b.bh_id FROM booking_hall b, booking_detail bd
where b.bh_id=bd.bh_id and b.bh_status = 0 and b.entry_date < '$text_') o3,
(SELECT COALESCE(sum(he.exp_price),0) as exp,b.bh_id FROM booking_hall b, hall_exp he
where b.bh_id=he.bh_id and he.exp_status = 0 and b.entry_date < '$text_') o4"; break;
//where o1.bh_id = o2.bh_id and o1.bh_id = o3.bh_id and o1.bh_id = o4.bh_id"; break;

case open_expense: 	$sql2_ = "SELECT COALESCE(SUM(exp_amount),0) as amount FROM expenses where exp_date < '$text_' and exp_status = '0'";break;

}

$result_ = mysql_query($sql2_);
//mysql_select_db($database_dbconfig, $dbconfig);
$rows_ = mysql_fetch_assoc($result_);
$amount_ = $rows_["amount"];
return $amount_;
}


function get_exp($mode,$date_from,$date_to,$ei_id)
{

switch($mode)
{
case exp_amt: $sqle = "SELECT COALESCE(SUM(exp_amount),0) as exp_amount FROM expenses where exp_date between '$date_from' and '$date_to'
 and ei_id='$ei_id' and exp_status = '0'"; break;

}
$resulte = mysql_query($sqle);
//mysql_select_db($database_dbconfig, $dbconfig);
$rowse = mysql_fetch_assoc($resulte);
$exp_amt	= $rowse["exp_amount"];
return $exp_amt;
}


function get_sum_month($mode_,$start_date,$end_date){
switch($mode_)
{

case hotel_month:  $sql2m_ = "select titles,o2.hs_amt,COALESCE(sum(titles + o2.hs_amt),0) as amount  from
(select COALESCE(sum(rent*total_days),0) as titles,res_date from reserve where res_status = 0 and res_date between ('$start_date') and ('$end_date')) o1 ,
(select COALESCE(sum(h.hs_amount),0) as hs_amt,r.res_date from reserve r, service_rec s,hall_service h where r.res_status = 0 
and r.res_date between ('$start_date') and ('$end_date') and r.res_id = s.res_id and s.hs_id=h.hs_id ) o2
"; break;
 

}

$resultm_ = mysql_query($sql2m_);
//mysql_select_db($database_dbconfig, $dbconfig);
$rowsm_ = mysql_fetch_assoc($resultm_);
$amountm_ = $rowsm_["amount"];
return $amountm_;
}
?>