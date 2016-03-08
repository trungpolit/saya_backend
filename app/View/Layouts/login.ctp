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
        echo $this->Html->css('style.min');
        echo $this->fetch('css');

        echo $this->Html->script('jquery-2.1.1');
        echo $this->Html->script('bootstrap.min');
        echo $this->fetch('script');
        ?>
    </head>
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen  animated fadeInDown">
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
    </body>
</html>
