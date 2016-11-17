<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
$loggedinas = $row->fname . ' ' . $row->lname;
    
//Check user level and show associating department or post
if (($row->userlevel == 9)&&($loggedinas == 'Alvin Herbert')){
        $group = 'System Developer';
    } elseif ($row->userlevel == 9){
    $group = 'System User';
    } elseif ($row->userlevel == 7){
        $group = 'Administrator';        
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Helen Schur Parris')){
        $group = 'CEO';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Chris Gloumeau')){
        $group = 'CFO';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Ysabelle Allard')){
        $group = 'General Manager';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Cinthya Cabrera')){
        $group = 'General Manager';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Marielle Alexander')){
        $group = 'General Manager';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Korey Boyce')){
        $group = 'Director of Operations';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Francisca Deane')){
        $group = 'Operations Manager';
    } elseif (($row->userlevel == 6)&&($loggedinas == 'Ashley Scantlebury')){
        $group = 'Administrative Assistant';
    } elseif ($row->userlevel == 6){
        $group = 'Manager';
    } elseif ($row->userlevel == 5){
        $group = 'Supervisor';
    } elseif ($row->userlevel == 4){
        $group = 'Accounting';
    } elseif ($row->userlevel == 3){
        $group = 'Five Star Fast Track';
    } elseif ($row->userlevel == 2){
        $group = 'Reservations';
    } elseif ($row->userlevel == 1){
        $group = 'Special Assignment';
    }
?>
<script>
$(document).ready(function(){
consoleChat('<?php echo $loggedinas; ?>');// username not necessarily, default name Guest
});
</script>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="../admin-panel-skb/thumbmaker.php?src=<?php echo UPLOADURL;?><?php echo ($row->avatar) ? $row->avatar : "blank.png";?>&amp;w=<?php echo $core->thumb_w;?>&amp;h=<?php echo $core->thumb_h;?>&amp;s=1&amp;a=t1" alt="<?php echo $loggedinas; ?>"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="../admin-panel-skb/thumbmaker.php?src=<?php echo UPLOADURL;?><?php echo ($row->avatar) ? $row->avatar : "blank.png";?>&amp;w=<?php echo $core->thumb_w;?>&amp;h=<?php echo $core->thumb_h;?>&amp;s=1&amp;a=t1" alt="<?php echo $loggedinas; ?>"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $loggedinas; ?></div>
                                <div class="profile-data-title"><?php echo $group; ?></div>
                            </div>
                        </div>                                                                        
                    </li>