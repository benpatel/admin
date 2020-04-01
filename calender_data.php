<?php
include_once("init.php");


$start_date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['start'])));
$end_date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['end'])));


$schedule = array();
$x=0;
$sql = "SELECT * FROM `schedule` WHERE `seller_id` = {$seller_id} AND `start_date` >= '{$start_date}' AND `end_date` <= '{$end_date}'";
$result_set=$dtb->query($sql);
     
while($result = $result_set->fetch_object()){
  
  $schedule[$x]['start']=$result->start_date;
  $schedule[$x]['end']=date('Y-m-d', strtotime($result->end_date. ' + 1 day'));
  $schedule[$x]['title']=$result->city_name;
  $schedule[$x]['className']=$result->class;


$x++;
}      


echo json_encode($schedule);

    ?>