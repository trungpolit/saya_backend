<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('page_meta_title', Configure::read('saya.App.name'));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $this->fetch('title'); ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('/font-awesome/css/font-awesome.min');
        echo $this->Html->css('animate');
        echo $this->Html->css('style');
        echo $this->Html->css('main');
        echo $this->Html->css('select2.min');
        echo $this->fetch('css');

        // Mainly scripts
        echo $this->Html->script('jquery-2.1.1');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('plugins/metisMenu/jquery.metisMenu');
        echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min');
        echo $this->Html->script('select2.min');

        // Custom and plugin javascript
        echo $this->Html->script('inspinia');
        echo $this->Html->script('plugins/pace/pace.min');
        echo $this->element('js/main');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php echo $this->element('navbar') ?>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <?php echo $this->element('navbar-static-top'); ?>
                </div>
                <?php
                $this->startIfEmpty('page-heading');
                echo $this->element('page-heading');
                $this->end();
                ?>
                <?php echo $this->fetch('page-heading') ?>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <?php
                    $flash_good = $this->Session->flash('good');
                    $flash_bad = $this->Session->flash('bad');
                    ?>
                    <?php if (!empty($flash_good)): ?>
                        <div class="alert alert-success">
                            <?php echo $flash_good ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($flash_bad)): ?>
                        <div class="alert alert-danger">
                            <?php echo $flash_bad ?>
                        </div>
                    <?php endif; ?>
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php // echo $this->element('sql_dump');  ?>
        </div>
    </body>
</html>
