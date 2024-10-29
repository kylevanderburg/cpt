<?php
/*
NoteForge Hammer
	by Kyle Vanderburg, in Poplar Bluff and Springfield, Missouri, and Norman, OK.
Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
All code copyright Kyle Vanderburg

This code is a module that requires the Hammer Core in order to fully work.
*/
$hr = new vio_comp_project($hammer);
$hr->restrict();

// $class = new vio_class($hammer);
// $class->restrict();

echo "<div class=\"hh\"><h1>Hammer &raquo; Projects</h1></div>";
$hammer->setHD("//cpt.research.kylevanderburg.net");
$hr->toolbar();
switch ($hammer->location[1]){
	case "new":
	case "insert":
	case "modify":
	case "write":
		//Insert new stuff
		if($hammer->location['action']==="insert"){$hr->create();}

		if(($hammer->location['action']==="insert") xor ($hammer->location['action']==="write")){
			if(!isset($hr->id)){$hr->id=$_POST['id'];}
			unset($_POST['options']);
			$hr->update($_POST);
		}

		if($hammer->location['action']=="modify"){$hr->id=$hammer->location['item'];}

		if($hammer->location['action']=="insert"||$hammer->location['action']=="modify"||$hammer->location['action']=="write"){$hr->get();}
		
		if(($hammer->location['action']=="insert" OR $hammer->location['action']=="write") AND isset($_POST['saveclose'])){?>
		<script>location.href = "<?php echo "/".$hr->page."/";?>"</script>
		<?php } 
		$hr->saveCloseHandler($_POST);
		$hr->savedAlert($action);
		?>
		
		<form name="<?php echo $hr->page; ?>" action="/<?php echo $hr->page;?>/<?php if($hammer->location['action']=="new"){echo "insert";}elseif(($hammer->location['action']=="modify")||($hammer->location['action']=="insert")||($hammer->location['action']=="write")){echo "write";} ?>/" method="post" enctype="multipart/form-data" autocomplete="off">
		<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<?php $hammer->writeTab("Details",1); ?>
				<?php if($hammer->location['action']!="new"){?><?php $hammer->writeTab("Comments"); ?><?php } ?>
				<?php if($hammer->location['action']!="new"){?><?php $hammer->writeTab("Audit"); ?><?php } ?>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php $hammer->writeTabHeader("details",1); ?>
				<br />
					<table class="table table-hover">
						<tr><td><?php $hr->textinput("title","Working Title");?></td></tr>
						<tr><td><?php $hr->textinput("inst","Instrumentation");?></td></tr>
						<tr><td><?php $hr->datepicker("duedate","Due Date");?></td></tr>
						<tr><td><?php $hr->checkbox("archived","Archived"); ?></td></tr>
					</table>
				<?php $hammer->writeTabFooter(); ?>
				<?php $hammer->writeTabHeader("comments"); ?><br /><?php include "comments.php"; ?><?php $hammer->writeTabFooter(); ?>
				<?php $hammer->writeTabHeader("audit"); ?><br /><?php include "audit.php"; ?><?php $hammer->writeTabFooter(); ?>
			</div>
		</div>
		<br />
		<input type="hidden" name="id" value="<?php echo $hr->id; ?>">
		<div class="text-center">
		<div class="btn-group btn-group-lg">
			<?php echo $hr->saveButton(); 
			echo $hr->saveCloseButton();
			echo $hr->deleteButton($hr->row['id'],$hr->row['title']); ?>
		</div>
		</div>
		</form>
		<script><?php $hr->deleteHandler();?></script>
		<?php
	break;
	
	case "export":
		$hr->export("vio-projects");
	break;
	
	default:
		$hr->getPageJS();
		?>

		<br />
		<?php
		$thefuture = new DateTime('now');
		$thefuture = $thefuture->add(new DateInterval('P30D'));
		$hr->qcount();
				
		echo "<div role=\"tabpanel\">
			<ul class=\"nav nav-tabs\" role=\"tablist\">";
		$hammer->writeTab("All",1);
		$hammer->writeTab("Archived");
		echo "</ul>";
		echo "<div class=\"tab-content\">";
		$hammer->writeTabHeader("All",1);
		$hr->listIndexWrapper("`archived`='0'","",1,"50","",$hammer->getHD());
		$hammer->writeTabFooter();

		$hammer->writeTabHeader("Archived");
		$hr->listIndexWrapper("`archived`>0","",1,"50","",$hammer->getHD());
		$hammer->writeTabFooter();

		echo "</div>";
		echo "</div>";
		 
} ?>
