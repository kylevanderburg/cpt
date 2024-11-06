<?php
$hr = new vio_comp_action($hammer);
$project="494669A9-6251-4B60-86F1-C8287D816DEF";
$hammer->debug();
//foreach($hr->q("`project`='".$project."' AND `action` <> 'end' AND `action` <> 'start' AND `action` <> 'confidence' AND `action` <> 'comment' AND `duration` = ''") as $a){
foreach($hr->q("`project`='".$project."' AND `action` <> 'end' AND `action` <> 'start' AND `action` <> 'confidence' AND `action` <> 'comment'") as $a){
    $push['duration']="";
    if($a['action']=="end" || $a['action']=="start" || $a['action']=="confidence" || $a['action']=="comment"){}else{
        $nexta = $hr->getNextAction($project,$a['id']);
        if(isset($nexta['id'])) {
            $datetime1 = new DateTime($a['created_time']); // start time
            $datetime2 = new DateTime($nexta['created_time']); // end time
            $interval = $datetime2->format('U') - $datetime1->format('U');
            if($interval>7200){$interval=7200;}
            $hr->getByID($a['id']);
            $push['duration']=$interval;
            $hr->update($push);
            // echo " \ " . $interval;
            // var_dump($a);
            // echo "<strong>".$a['action']."</strong>";
            // echo $datetime1->format('U') . " - ". $datetime2->format('U');
            // echo "<br />";
            // echo $interval." - OLD: ".$a['duration'];
        }
    }
    echo "<hr>";
    // echo "
}
?>