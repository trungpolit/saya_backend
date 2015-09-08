<?php

echo $this->start('script');
echo $this->Html->script('plugins/datapicker/bootstrap-datepicker');
echo $this->end();

echo $this->start('css');
echo $this->Html->css('plugins/datapicker/datepicker3');
echo $this->end();
