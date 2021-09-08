<?php
//This php used to update order finished stats.
require_once "public_conn.php";
//check each rep order
$sql_get_reps = "select id,quota_1,quota_2,quota_3 ,realname from reps";
$res_get_reps = $conn->query($sql_get_reps);
while($row = mysqli_fetch_array($res_get_reps)){
    $id = $row[0];
    $quota_1 = $row[1];
    $quota_2 = $row[2];
    $quota_3 = $row[3];
    //get order exceeding 24 hours
    $sql_get_order = " select o.Id,o.OrderNumber_1,o.OrderNumber_2,o.OrderNumber_3 from user_order_relation as uo left join users as u on u.Id=uo.UserId left join orders as o on o.Id=uo.OrderId left join rep_order_relation as ro on ro.OrderId = o.Id left join reps as r on ro.RepId = r.Id where r.id = $id AND IsFinished = 0 AND TimeSTAMPDIFF(hour,o.date,current_timestamp) > 24";
    $res_get_order = $conn->query($sql_get_order);
    if ($res_get_order->num_rows == 0){
        continue;
    }
    //process each order
    while ($row2 = mysqli_fetch_array($res_get_order)){
        $o_id = $row2[0];
        $quota_1 = $quota_1 - $row2[1];
        $quota_2 = $quota_2 - $row2[2];
        $quota_3 = $quota_3 - $row2[3];
        //Judge whether quota enough
        if ($quota_1<0||$quota_2<0||$quota_3<0){
            $sql_update = "UPDATE orders SET IsFINISHED = 2 where id = $o_id";
            echo $sql_update;
            $conn->query($sql_update);
            $sql_commit_anormal = "insert into log (operation,content,datetime) value ('Anormal','caused by exceeding order by $row[4]',current_timestamp)";
            $conn->query($sql_commit_anormal);
        }else{
            $sql_update = "UPDATE orders SET IsFINISHED = 1 where id = $o_id";
            $conn->query($sql_update);
        }
    }
    $sql_update = "UPDATE reps SET quota_1 = $quota_1,quota_2 = $quota_2,quota_3 = $quota_3 where id = $id";
    $conn->query($sql_update);
}
?>