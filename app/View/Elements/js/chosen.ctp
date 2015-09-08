<?php

echo $this->start('script');
echo $this->Html->script('plugins/chosen/chosen.jquery');
echo $this->end();

echo $this->start('css');
echo $this->Html->css('plugins/chosen/chosen');
echo $this->end();
?>
