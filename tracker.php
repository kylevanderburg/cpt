<?php
/*
NoteForge Hammer | Kyle Vanderburg CPT
	by Kyle Vanderburg, in Poplar Bluff, Springfield, Norman, and Fargo.
	All code copyright Kyle Vanderburg
*/

//CPT is built on Hammer. Let's set some options.
$options = [
	'vanguard'=>TRUE, //Require Login
	"seths"=>1, //Hard-code HammerSite
	"vanguardAccess"=>"A", //User-level access
	"vanguardLogin"=>"", //Special Login Screen
	"vanguardMessage"=>"kdv", //Login Message
	//"vanguardLoginURL"=>"https://vanguard.kylevanderburg.net/" //Use a different login endpoint than Liszt
	];
	
//Load the Vanilla Hammer core, Set HammerSite, HammerDirectory, and parse the URL
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hammer->setHS(1); $hammer->setHD("/");
$hammer->clientUrlParse();

//Exceptional code for user restriction
if($hammer->user['id']!=1){$hammer->prohibited('KV');die();}

//Declare the project variable and load it from the database
$comp = new vio_comp_project($hammer);
$comprow = $comp->getByGUID($_GET['guid']);

//Error Handling
if(isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);$hammer->debug();}

//Write <head> to the page
$hammer->head("ScoreMod | Tracker","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

//Secondary exceptional code for user restriction.
if(($hammer->getHS()=="1") && ($hammer->getUserRole()<7)){echo "<div class=\"text-center\"><img src=\"//cdn.ntfg.net/images/hammer/delete.png\" /></div><h1 class=\"text-center\">You are not authorized to view this page.";die();}else{}

//Load Standards
include "cpt-standards.php";

//Declare function for writing buttons
function button($arr){
	echo "<span class=\"d-grid\"><button type=\"button\" class=\"btn btn-lg mb-2 cpt-action btn-".$arr['displayClass']."\" data-action=\"".$arr['action']."\"><i class=\"fa-light ".$arr['icon']."\"></i> ".$arr['text']."</button></span>";
}

//Declare function for writing groups of buttons
function showButtons($category,$buttons){
	foreach($buttons as $button){
		switch ($button['category']){
			case $category:
				echo "<div class=\"col-md-4\">";
				echo button($button)."</div>";
			break;
		}
	}
}

//Declare function for writing stages
function stage($stage,$buttons){
	echo "<strong>".ucwords($stage)."</strong>";
	echo "<div class=\"row\">";
	showButtons($stage,$buttons);
	echo "</div>";
	echo "<hr>";
}

//Debug line
// $hammer->debug();
?>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-md-9">

	<center><strong>ScoreMod | <em><?php echo $comprow['title'] . "</em> | " . $comprow['inst'] . " | " . $comprow['duedate']; ?></strong></center>
	<?php
	foreach($stages as $stage){
		stage($stage,$buttons);
	}
	?>
	<div class="row">
		<div class="col-md-9">
			<label for="fall"><strong>Confidence</strong></label><input type="range" class="form-range" min="1" max="100" step="1" id="confidencerange">		
		</div><!--col-md-9-->
		<div class="col-md-3"><span class="d-grid"><button type="button" class="btn btn-liszt btn-lg d-block cpt-confidence" data-action="confidence">Log Confidence</button></span></div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-9">
			<?php $hr=new vio_comp_action($hammer);
			$hr->textinput("Comment","Comment");
			?>
		</div><!--col-md-4-->
		<div class="col-md-3"><br /><span class="d-grid"><button type="button" class="btn btn-liszt btn-lg cpt-comment" data-action="comment">Log Comment</button></span></div>
	</div>
	<hr>

</div><!--col-md-9-->
<div class="col-md-3 border-start">
<iframe src="/transcript.php?guid=<?php echo $_GET['guid'];?>" height="100%" width="100%" id="transcript"></iframe>
</div>
</div><!--row-->
</div><!--container-fluid-->
<script>

//Basically $.ajax()
function sendPostRequest(url, data, callback) {
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				callback(xhr.responseText);
			}
		}
	};
	xhr.send(data);
}

//Button click function.
function compButton(button, ext="") {
	var data = "page=" + encodeURIComponent("<?php echo get_class($hr); ?>") +
			 "&action=" + encodeURIComponent("compButton") +
			 "&record=" + encodeURIComponent("<?php echo $_GET['guid']; ?>") +
			 "&button=" + encodeURIComponent(button) +
			 "&extended=" + encodeURIComponent(ext) +
			 "&site=" + encodeURIComponent("<?php echo $hammer->getHA(); ?>") +
			 "&user=" + encodeURIComponent("<?php echo $hammer->user['hash']; ?>");

	//Uses Syscontrol.php for writing to DB.
	sendPostRequest("/syscontrol.php", data, function (result) {
		console.log(result);
	});
	setTimeout(function(){
		document.getElementById("transcript").contentDocument.location.reload(true);
	}, 1000);
}
		
//Button Handler
const btns = document.querySelectorAll('.cpt-action')
btns.forEach(btn => {
	btn.addEventListener('click', event => {
	//Press Button
		compButton(btn.getAttribute('data-action'));
	//Change button green for feedback
		btn.classList.add("bg-success");
		setTimeout(() => {
			btn.classList.remove("bg-success");
		}, "1000");
	//Extra Handling for End Session
	if(btn.getAttribute('data-action')=="end"){
		setTimeout(function(){
			window.close();
		}, 1000);
	}
	});
});

//Confidence Slider Handler
document.querySelector(".cpt-confidence").addEventListener("click", (event) => {
	//Specify Button
		const confidenceBtn = document.querySelector(".cpt-confidence");
	//Collect value
		const confidence = document.querySelector("#confidencerange").value;
	//Press Button
		compButton(confidenceBtn.getAttribute('data-action'),confidence);
	//Change button green for feedback
		confidenceBtn.classList.add("bg-success");
		setTimeout(() => {
			confidenceBtn.classList.remove("bg-success");
		}, "1000");
});

//Comment Handler
document.querySelector(".cpt-comment").addEventListener("click", (event) => {
	//Specify Button
		const commentBtn = document.querySelector(".cpt-comment");
	//Collect value
		const comment = document.querySelector("#<?php echo $hr->page;?>-comment-field");
	//Press Button
		compButton(commentBtn.getAttribute('data-action'),comment.value);
	//Reset Value
		comment.value = " ";
	//Change button green for beedback
		commentBtn.classList.add("bg-success");
		setTimeout(() => {
			commentBtn.classList.remove("bg-success");
		}, "1000");
});
</script>
</body>