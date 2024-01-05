<!-- Liszt Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary">
	<!-- Liszt Logo -->
	<a href="//<?php echo $baseurl;?>" class="brand-link"><img src="//cdn.ntfg.net/common/wheel.png" width="170px" alt="Liszt Logo" class="brand-image" style="padding-top:10px;padding-left:5px;"><div class="brand-text">CPT</div></a>

	<!-- Navigation Sidebar -->
	<div class="sidebar">
		<!-- Liszt User Panel -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				
			</div>
			<div class="info">
				<strong><?php echo $hammer->user['firstname']." ".$hammer->user['lastname'];?></strong>
			</div>
			
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<!--Site Menu-->
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				
				<li class="nav-header">Process Tools</li>
				<li class="nav-item<?php if($page=="classes"){echo " active";}?>"><a class="nav-link" href="/pt/projects/"><i class="nav-icon fas fa-music"></i><p>Projects</p></a></li>
				<!--<li class="nav-item<?php if($page=="projects"){echo " active";}?>"><a class="nav-link" href="/ndsu/projects/"><i class="nav-icon fas fa-project-diagram"></i><p>Projects</p></a></li>
				<li class="nav-item<?php if($page=="due-dates"){echo " active";}?>"><a class="nav-link" href="/ndsu/due-dates/"><i class="nav-icon fas fa-calendar-week"></i><p>Due Dates</p></a></li>-->
				
				<li class="nav-header">Reports</li>
				<!--<li class="nav-item<?php if($page=="report-student"){echo " active";}?>"><a class="nav-link" href="/ndsu/report-student/"><i class="nav-icon fas fa-clipboard"></i><p>Report by Student</p></a></li>
				<li class="nav-item<?php if($page=="report-class"){echo " active";}?>"><a class="nav-link" href="/ndsu/report-class/"><i class="nav-icon fas fa-clipboard"></i><p>Report by Class</p></a></li>
				<li class="nav-item<?php if($page=="report-dates"){echo " active";}?>"><a class="nav-link" href="/ndsu/report-dates/"><i class="nav-icon fas fa-clipboard"></i><p>Master Due Date File</p></a></li>-->
				
			</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>