<?php
/*
NoteForge Hammer
	by Kyle Vanderburg, in Poplar Bluff & Springfield, Missouri, and Norman, OK.
	Hammer Backend Index Page
	Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
	All code copyright Kyle Vanderburg
*/

$options['vanguard']=TRUE; $options['seths']=1;$options['vanguardAccess']="A";$options['vanguardLogin']="kdv/";
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hammer->setHS(1); $hammer->setHD("pt");

$hammer->clientUrlParse();
if($hammer->user['id']!=1){$hammer->prohibited('KV');die();}

if(!empty($hammer->location[1])){$hammer->location['page']=$hammer->location[1];}
if(!empty($hammer->location[2])){$hammer->location['action']=$hammer->location[2];}
if(!empty($hammer->location[3])){$hammer->location['item']=$hammer->location[3];}

if(isset($hammer->location[1])){$page=$hammer->location[1];}else{$page="pt-index";}
if(isset($hammer->location[2])){$action=$hammer->location[2];}else{$action="";}
$titles = array(
	"vio-billing-codes" => "Billing Codes",
	"vio-email" => "Email Console",
	"vio-index" => "Index",
	"vio-permissions" => "Permissions",
	"vio-sites" => "Site Configuration",
	"vio-user" => "User Configuration",
	"vio-vars" => "Site Configuration",
	"vio-audit" => "Audit Log"
);
$title = $titles[$page];
// $hammer->debug();

if(isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);$hammer->debug();}
$hammer->head("CPT","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

// var_dump($hammer);
// if(!isset($hammer->permissions['noteforge/hammer'])){$hammer->permissions['noteforge/hammer']=0;}
if(($hammer->getHS()=="1") && ($hammer->getUserRole()<7)){echo "<div class=\"text-center\"><img src=\"//acdn.ntfg.net/images/hammer/delete.png\" /></div><h1 class=\"text-center\">You are not authorized to view this page.</h1>";die();}else{}

// $hammer->debug(); ?>



<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php include('lz-nav-top.php'); ?>
<?php include('lz-nav-sidebar.php'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
		</div><!-- content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
			<?php if(isset($hammer->user)){include($page.".php");} ?></div>
			</div><!-- container-fluid -->
		</section><!-- content -->
	</div>
	<!-- content-wrapper -->
	<?php $hammer->h3footer(); ?>
  
</div><!-- ./wrapper -->

<?php require_once "/var/www/cdn.ntfg.net/htdocs/footer-scripts.php"; ?>
</body>
</html>