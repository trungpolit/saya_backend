<nav  role="navigation" class="navbar navbar-static-top">
	<div class="navbar-header">
		<a href="#" class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i> </a>
	</div>
	<ul class="nav navbar-top-links navbar-right">
		<li>
			<a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'logout')) ?>">
				<i class="fa fa-sign-out"></i> <?php echo __('log_out') ?>
			</a>
		</li>
	</ul>
</nav>