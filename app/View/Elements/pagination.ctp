<?php
if (isset($this->Paginator) && $this->Paginator->counter('{:pages}') > 1):
	?>
	<?php
	$ajax_target = !empty($ajax_target) ? $ajax_target : '';
	?>
<div class="text-center pagination-container" data-ajax_target="<?php echo $ajax_target ?>">
		<div class="btn-group">
			<?php echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('tag' => 'span', 'escape' => false, 'class' => 'btn btn-white'), null, array('class' => 'disabled btn btn-white', 'tag' => 'span', 'escape' => false, 'disabledTag' => '')); ?>
			<?php
			echo $this->Paginator->numbers(array(
				'first' => 2,
				'last' => 2,
				'tag' => 'span',
				'currentClass' => 'active',
				'separator' => false,
				'currentTag' => 'a',
				'ellipsis' => '<span class="btn btn-white"><span>...</span></span >',
				'class' => 'btn btn-white',
			));
			?>
			<?php echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array('tag' => 'span', 'escape' => false, 'class' => 'btn btn-white'), null, array('class' => 'disabled btn btn-white', 'tag' => 'span', 'escape' => false, 'disabledTag' => '')); ?>
		</div>
	</div>
	<?php
endif;
?>

