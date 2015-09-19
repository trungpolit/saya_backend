<?php echo $this->start('page-heading') ?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2><?php echo $page_title ?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo!empty($home_url) ? $home_url : '#' ?>"><?php echo __('home_title') ?></a>
			</li>
			<?php if (!empty($breadcrumb)): ?>
				<?php
				if (!is_array($breadcrumb[0])) {

					$breadcrumb = array($breadcrumb);
				}
				?>
				<?php foreach ($breadcrumb as $k => $item): ?>
					<?php
					$li_class = '';
					if ($k == count($breadcrumb) - 1) {

						$li_class = 'active';
					}
					?>
					<li class="<?php echo $li_class ?>">
						<a href="<?php echo $item['url'] ?>" >
							<?php if (!empty($li_class)): ?>
								<strong><?php echo $item['label'] ?></strong>
							<?php else: ?>
								<?php echo $item['label'] ?>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ol>
	</div>
	<div class="col-sm-4">
		<div class="title-action">
			<a class="btn btn-primary" href="<?php echo isset($location_id) ? Router::url(array('action' => 'add', $location_id)) : Router::url(array('action' => 'add')) ?>">
				<i class="fa fa-plus"></i> <span><?php echo __('add_action_title') ?></span>
			</a>
		</div>
	</div>
</div>
<?php echo $this->end() ?>