<?php

echo $this->start('script');
echo $this->Html->script('plugins/moment/moment-with-locales.min');
echo $this->Html->script('plugins/datetimepicker/bootstrap-datetimepicker.min');
echo $this->end();

echo $this->start('css');
echo $this->Html->css('plugins/datetimepicker/bootstrap-datetimepicker.min');
echo $this->end();
