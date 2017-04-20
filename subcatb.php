<?php


require_once("configure.php");

// Very important to set the page number first.
if (!(isset($_GET['pagenum']))) { 
	 $pagenum = 1; 
} else {
	$pagenum = intval($_GET['pagenum']); 		
}

//Number of results displayed per page 	by default its 10.

$page_limit=9;
$a =  ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? intval($_GET["show"]) : 10;

// Get the total number of rows in the table
$sql = "SELECT count(*) as count FROM product  WHERE grp = 2 and  trim(coalesce(ProductName, '')) <>'' " ;

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
$sql2 = " SELECT * FROM product WHERE grp = 2 and  trim(coalesce(ProductName, '')) <>''  limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==7){
$sql2 = " SELECT * FROM product WHERE grp = 2 and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==9){
$sql2 = " SELECT * FROM product WHERE grp = 2 and  trim(coalesce(ProductName, '')) <>''   ORDER BY CAST(Price as SIGNED INTEGER)  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==15){
$sql2 = " SELECT * FROM product WHERE grp = 2 and  trim(coalesce(ProductName, '')) <>''  ORDER BY CAST(Price as SIGNED INTEGER)  ASC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==20){
$sql2 = " SELECT * FROM product WHERE grp = 2 and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==21){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 0 and 500 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==22){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 500 and 1000 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==23){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 1000 and 5000 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==24){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 5000 and 10000 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==25){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 10000 and 15000 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==26){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 15000 and 20000 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==27){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (Price  between 20000 and 200000 ) and  trim(coalesce(ProductName, '')) <>''  order by ID  DESC limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}

if($a==33){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and 
(cola like '%%red%' or colb like '%%red%' or colc like '%%red%' or cold like '%%red%' or cole like '%%red%' or colf like '%%red%' or colg like '%%red%' or colh like '%%red%'  )order by ID   limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==34){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (cola like '%%blue%' or colb like '%%blue%' or colc like '%%blue%' or cold like '%%blue%' or cole like '%%blue%' or colf like '%%blue%' or colg like '%%blue%' or colh like '%%blue%')order by ID   limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==35){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (cola like '%%green%' or colb like '%%green%' or colc like '%%green%' or cold like '%%green%' or cole like '%%green%' or colf like '%%green%' or colg like '%%green%' or colh like '%%green%' )order by ID   limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==36){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and (cola like '%%yellow%' or colb like '%%yellow%' or colc like '%%yellow%' or cold like '%%yellow%' or cole like '%%yellow%' or colf like '%%yellow%' or colg like '%%yellow%' or colh like '%%yellow%'   )order by ID   limit ". ($lower_limit)." ,  ". ($page_limit). " ";
}
if($a==37){
$sql2 = " SELECT * FROM product WHERE (grp = 2 ) and  trim(coalesce(ProductName, '')) <>''  order by ID   limit ". ($lower_limit)." ,  ". ($page_limit). " ";
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





	<div class="clearfix">
					<ul class="pagination">
 
			<?php
			if ( ($pagenum-1) > 0) {
			?>	
			<li> <a href="javascript:void(0);"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo 1; ?>');"><<</a></li>
			<li> <a href="javascript:void(0);"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum-1; ?>');"><</a></li>
			<?php
			}
			//Show page links
			for($i=1; $i<=$last; $i++) {
				if ($i == $pagenum ) {
		?>
				<li> <a href="javascript:void(0);" class="active" ><?php echo $i ?></a></li>
		<?php
			} else {  
		?>
			<li><a href="javascript:void(0);"   onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
		<?php 
			}
		} 
		if ( ($pagenum+1) <= $last) {
		?>
			<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum+1; ?>');" >></a></li>
		<?php } if ( ($pagenum) != $last) { ?>	
			<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $last; ?>');" >>></a> </li>
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
	

	
	



                            
                       









<div class="row shop_block">
<div class="tovar_wrapper" data-appear-top-offset='-100' data-animated='fadeInUp'>
    <?php foreach ($results as $res) {
		$img=base64_encode($res['imga']);
	    $imgf=base64_encode($res['imgb']);
	    $imgv=base64_encode($res['imgc']);
        $top=$res['ProductName'];
		$qa=$res['qua'];
		$qb=$res['quab'];
        $pri=$res['Price'];
        $pria=$res['Pricea'];		
	    $cd= $res['code'];
		$we=$res['ID'];
		$para =$res['para'];
   if (!empty($top)) {		?>
   
						
						  
									<div class="tovar_wrapper col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ss-12 padbot40">
								<div class="tovar_item clearfix">
									<div class="tovar_img">
										<div>
											<?php  echo"<img class='img' src='data:image/jpeg;base64,$img' >";?>
											
										</div>
										<div class="tovar_item_btns">
										<?php if($qa > $qb){ ?>
											<table align="center">
												<tr>
													<td colspan="2">
												<form action="daily_single.php" method="get">
												<input type="hidden" name="id" value="<?= $we?>">
												
													<button type="submit" class="open-project tovar_view" >quick view</button>
													</form>
												</td>
												</tr>
												<tr height="5px"></tr>
												<tr>
													<td>
			<a class="add_bag" href=" " onclick="document.getElementById('my_form<?= $cd?>').submit();return false;" ><i class="fa fa-shopping-cart"></i></a>
														<?php echo"<form id='my_form$cd' method='post' action='dailysarees.php?action=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>
													</td>
													<td>
			<a class="add_lovelist" href="" onclick="document.getElementById('my_forms<?= $cd?>').submit();return false;" ><i class="fa fa-heart"></i></a>										
														
														<?php echo"<form id='my_forms$cd' method='post' action='dailysarees.php?go=add&code=$cd'>
         <input type='hidden' name='quantity' value='1' size='2' />

        </form>"; ?>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<div class="tovar_description clearfix">
	                                 <a href="daily_single.php?id=<?= $we; ?>" class="tovar_title"><?=$top ?></a>
										<span class="tovar_price">&nbsp;<i class="fa fa-inr"></i>&nbsp;<?=$pri ?>.00</span>
										<?php if (!empty($pria)) { ?>
<span class=tovar_price>&nbsp;<b><i class="fa fa-inr"></i>&nbsp;<strike><?=$pria ?>.00</strike></b></span>
<?php } ?>
									</div>
								</div>
							</div><!-- //TOVAR8 -->
							
										<?php } else { ?>
										
										
										<table align="center">
												<tr>
													<td colspan="2">
												
												
													<button type="submit" class="open-project tovar_view" >OUT OF STOCK</button>
													
												</td>
												</tr>
												
											</table>
										</div>
									</div>
									<div class="tovar_description clearfix">
	                                 <a  class="tovar_title"><?=$top ?></a>
										<span class="tovar_price">&nbsp;<i class="fa fa-inr"></i>&nbsp;<?=$pri ?>.00</span>
										<?php if (!empty($pria)) { ?>
<span class=tovar_price>&nbsp;<b><i class="fa fa-inr"></i>&nbsp;<strike><?=$pria ?>.00</strike></b></span>
<?php } ?>
									</div>
								</div>
							</div><!-- //TOVAR8 -->
										
										
										
										
										<?php } ?>
						
			
    <?php
    }
	}
    ?>
</div>
</div><!-- //ROW -->












<div align="center">
					<ul class="pagination">
 
	<?php
	if ( ($pagenum-1) > 0) {
	?>	
	<li> <a href="javascript:void(0);"  onclick="displayRecords('<?php echo $a;  ?>', '<?php echo 1; ?>');"><<</a></li>
	<li> <a href="javascript:void(0);"   onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum-1; ?>');"><</a></li>
	<?php
	}
	//Show page links
	for($i=1; $i<=$last; $i++) {
		if ($i == $pagenum ) {
?>
		<li> <a href="javascript:void(0);" class="active" ><?php echo $i ?></a></li>
<?php
	} else {  
?>
	<li><a href="javascript:void(0);"   onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
<?php 
	}
} 
if ( ($pagenum+1) <= $last) {
?>
	<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $pagenum+1; ?>');" >></a></li>
<?php } if ( ($pagenum) != $last) { ?>	
	<li><a href="javascript:void(0);" onclick="displayRecords('<?php echo $a;  ?>', '<?php echo $last; ?>');"  >>></a> </li>
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
	