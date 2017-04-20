<?php


require_once("configure.php");

// Very important to set the page number first.
if (!(isset($_GET['pagenum']))) { 
	 $pagenum = 1; 
} else {
	$pagenum = intval($_GET['pagenum']); 		
}

//Number of results displayed per page 	by default its 10.

$page_limit=12;
$a =  ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? intval($_GET["show"]) : 10;

// Get the total number of rows in the table
$sql = "SELECT count(*) as count FROM product  WHERE Grp = 3 " ;
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $tresults = $stmt->fetchAll();
} catch (Exception $ex) {
    echo($ex->getMessage());
}

$cnt = $tresults[0]["count"];

//Calculate the last page based on total number of rows and rows per page. 
$last = ceil($cnt/$page_limit); 

//this makes sure the page number isn't below one, or more than our maximum pages 
if ($pagenum < 1) { 
	$pagenum = 1; 
} elseif ($pagenum > $last)  { 
	$pagenum = $last; 
}

$lower_limit = ($pagenum - 1) * $page_limit;
if($a==8){
$sql2 = " SELECT * FROM product WHERE Grp = 3 limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==7){
$sql2 = " SELECT * FROM product WHERE Grp = 3 order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==9){
$sql2 = " SELECT * FROM product WHERE Grp = 3  ORDER BY CAST(Price as SIGNED INTEGER)  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==15){
$sql2 = " SELECT * FROM product WHERE Grp = 3 ORDER BY CAST(Price as SIGNED INTEGER)  ASC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==20){
$sql2 = " SELECT * FROM product WHERE Grp = 3 order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}

try {
    $stmt = $DB->prepare($sql2);
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (Exception $ex) {
    echo($ex->getMessage());
}

?>
<style>
	.buttona {
    font-size: 14px;
    color: #212121;
	    background-color: transparent;
    margin: 0;
    text-decoration: none;
    text-transform: uppercase;
    padding: .5em 2em;
    border: 1px solid;
    border-radius: 25px;
}

 .buttona:hover {
    background-color: #FF9B05;
}
</style>




<div class="col-md-12" >
	<div class="col-md-6">
					<ul class="pagination">
 
			<?php
			if ( ($pagenum-1) > 0) {
			?>	
			<li> <a href="javascript:void(0);" class="links" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo 1; ?>');"><<</a></li>
			<li> <a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum-1; ?>');"><</a></li>
			<?php
			}
			//Show page links
			for($i=1; $i<=$last; $i++) {
				if ($i == $pagenum ) {
		?>
				<li> <a href="javascript:void(0);" class="selected" ><?php echo $i ?></a></li>
		<?php
			} else {  
		?>
			<li><a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
		<?php 
			}
		} 
		if ( ($pagenum+1) <= $last) {
		?>
			<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum+1; ?>');" class="links">></a></li>
		<?php } if ( ($pagenum) != $last) { ?>	
			<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $last; ?>');" class="links" >>></a> </li>
		<?php
			} 
		?>

		 </ul>
	</div>
	<div class="col-md-6">
		<ul style="list-style:none;">
			<li align="right"><b><font color="black">Page <?php echo $pagenum; ?> of <?php echo $last; ?></font></b></li>
		</ul>
	</div>
	
</div>
	
</div>
	
	
	



                            
                 










<div class="row products">
    <?php foreach ($results as $res) {
		$img=base64_encode($res['imga']);
	    $imgf=base64_encode($res['imgb']);
	    $imgv=base64_encode($res['imgc']);
        $top=$res['ProductName'];
        $pri=$res['Price'];	 
	    $cd= $res['code'];
		$we=$res['ID'];
		$para =$res['para'];
		
  		?>
   
   
   
   
   
   <div class="col-md-3 col-sm-4">
                            <div class="product">
                                <a href="divaah_product.php">
                                    
									<?php  echo"<img class='img-responsive' src='data:image/jpeg;base64,$img' >";?>
                                </a>
                                <div class="text">
                                    <h3><a href="divaah_product.php"><?=$top ?></a></h3>
                                    <p class="price"><i class="fa fa-inr"></i> <?=$pri ?>.00</p>
									<form action="divaah_product.php" method="get">
									<input type="hidden" value="<?= $we ?>" name="id">
				<?php if (!empty($top)) { ?>
				<button type="submit" class="btn btn-success">Edit details</button>
				<?php }else{ ?>
				<button type="submit" class="btn btn-success" style="background-color:blue;">ADD details</button>
				<?php } ?>
									</form><br><br>
									
                                    
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>      
   
   
  
    <?php
    
	}
    ?>
</div>
<div align="center">
					<ul class="pagination">
 
	<?php
	if ( ($pagenum-1) > 0) {
	?>	
	<li> <a href="javascript:void(0);" class="links" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo 1; ?>');"><<</a></li>
	<li> <a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum-1; ?>');"><</a></li>
	<?php
	}
	//Show page links
	for($i=1; $i<=$last; $i++) {
		if ($i == $pagenum ) {
?>
		<li> <a href="javascript:void(0);" class="selected" ><?php echo $i ?></a></li>
<?php
	} else {  
?>
	<li><a href="javascript:void(0);" class="links"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
<?php 
	}
} 
if ( ($pagenum+1) <= $last) {
?>
	<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum+1; ?>');" class="links">></a></li>
<?php } if ( ($pagenum) != $last) { ?>	
	<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $last; ?>');" class="links" >>></a> </li>
<?php
	} 
?>
 </ul>
					</div>
<div class="height30"></div>
<table width="50%" border="0" cellspacing="0" cellpadding="2"  align="center">
<tr>
  <td valign="top" align="left">
	
	</td>
	</tr>
	</table>
	