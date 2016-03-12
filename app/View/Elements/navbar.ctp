<?php
$user = CakeSession::read('Auth.User');
if (empty($user)) {

    return;
}
$username = $user['username'];
$perms = $user['perms'];
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span>
                        <img src="<?php echo Router::url('/', true) ?>/img/icon-user-default.png" class="img-circle" alt="image">
                    </span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="clear"> 
                            <span class="block m-t-xs"> 
                                <strong class="font-bold"><?php echo $username ?></strong>
                            </span> 
                        </span> 
                    </a>
                </div>
                <div class="logo-element">
                    <?php echo Configure::read('saya.App.name') ?>
                </div>
            </li>
            <?php if (in_array('DailyReports/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'DailyReports', 'action' => 'index')) ?>">
                        <i class="fa fa-pie-chart"></i> <span class="nav-label"> <?php echo __('daily_report_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('OrdersBundles/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'OrdersBundles', 'action' => 'index')) ?>">
                        <i class="fa fa-shopping-cart"></i> <span class="nav-label"> <?php echo __('orders_bundle_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Products/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Products', 'action' => 'index')) ?>">
                        <i class="fa fa-gift"></i> <span class="nav-label"> <?php echo __('product_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Products/indexView', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Products', 'action' => 'indexView')) ?>">
                        <i class="fa fa-gift"></i> <span class="nav-label"> <?php echo __('product_view_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Notifications/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Notifications', 'action' => 'index')) ?>">
                        <i class="fa fa-rss"></i> <span class="nav-label"> <?php echo __('notification_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Notifications/indexView', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Notifications', 'action' => 'indexView')) ?>">
                        <i class="fa fa-rss"></i> <span class="nav-label"> <?php echo __('notification_view_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Feedbacks/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Feedbacks', 'action' => 'index')) ?>">
                        <i class="fa fa-comments"></i> <span class="nav-label"> <?php echo __('feedback_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Ads/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Ads', 'action' => 'index')) ?>">
                        <i class="fa fa-diamond"></i> <span class="nav-label"> <?php echo __('ad_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('ClientVersions/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'ClientVersions', 'action' => 'index')) ?>">
                        <i class="fa fa-bell"></i> <span class="nav-label"> <?php echo __('client_version_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Categories/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Categories', 'action' => 'index')) ?>">
                        <i class="fa fa-tags"></i> <span class="nav-label"> <?php echo __('category_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Regions/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Regions', 'action' => 'index', 'parent')) ?>">
                        <i class="fa fa-institution"></i> <span class="nav-label"> <?php echo __('region_parent_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Regions/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Regions', 'action' => 'index', 'child')) ?>">
                        <i class="fa fa-university"></i> <span class="nav-label"> <?php echo __('region_child_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Bundles/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Bundles', 'action' => 'index')) ?>">
                        <i class="fa fa-flag"></i> <span class="nav-label"> <?php echo __('bundle_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('AdminUsers/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'AdminUsers', 'action' => 'index')) ?>">
                        <i class="fa fa-user-plus"></i> <span class="nav-label"> <?php echo __('admin_user_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Users/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index')) ?>">
                        <i class="fa fa-user"></i> <span class="nav-label"> <?php echo __('user_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Roles/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Roles', 'action' => 'index')) ?>">
                        <i class="fa fa-users"></i> <span class="nav-label"> <?php echo __('role_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array('Perms/index', $perms)): ?>
                <li class="">
                    <a href="<?php echo Router::url(array('controller' => 'Perms', 'action' => 'index')) ?>">
                        <i class="fa fa-user-secret"></i> <span class="nav-label"> <?php echo __('perm_nav_title') ?> </span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>