<div id="phprop-box">
<div id="phprop-table">
<table>
<tr><td>ID</td><td>LOCALE</td><td>HASH</td><td>TEXT</td><td>ACTIVE</td><td></td></tr>

<?php 
 foreach ($lang as $id => $langs){
 	echo "<tr>";
 	echo "<td>".$id."</td>";
 	echo "<td>".$langs['locale']."</td>";
 	echo "<td>".$langs['hash']."</td>";
 	echo "<td>".$langs['text']."</td>";
 	$activo=$langs['active'];
 	if ($activo){
 		echo "<td>YES</td>";
 	}
 	else {
 	echo "<td>NO</td>";}
 	if($activo){
 		echo "<td>".$html->link(__('OFF', true), array('controller' => 'Languagesphprops', 'action' => 'off', $id)) ."</td>";
 		
 	}
 	else {
 		echo "<td>".$html->link(__('ON', true), array('controller' => 'languagesphprops', 'action' => 'on', $id)) ."</td>";
 		
 		
 	}
 	
 	
 	echo "</tr>";
 }

?>



</table>

<?php echo $html->link(__('Add Language', true), array('plugin'=>'phprop','controller' => 'languagesphprops', 'action' => 'add'));?>
<?php echo "   ".$html->link(__('Return', true), array('plugin'=>'phprop','controller' => 'phprops', 'action' => 'index'));?>
</div>

</div>