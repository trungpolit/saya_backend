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
                                <strong class="font-bold">xxx</strong>
                            </span> 
                        </span> 
                    </a>
                </div>
                <div class="logo-element">
                    <?php echo Configure::read('saya.App.name') ?>
                </div>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Products', 'action' => 'index')) ?>">
                    <i class="fa fa-gift"></i> <span class="nav-label"> <?php echo __('product_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Categories', 'action' => 'index')) ?>">
                    <i class="fa fa-tags"></i> <span class="nav-label"> <?php echo __('category_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Regions', 'action' => 'index', 'parent')) ?>">
                    <i class="fa fa-institution"></i> <span class="nav-label"> <?php echo __('region_parent_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Regions', 'action' => 'index', 'child')) ?>">
                    <i class="fa fa-university"></i> <span class="nav-label"> <?php echo __('region_child_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Bundles', 'action' => 'index')) ?>">
                    <i class="fa fa-flag"></i> <span class="nav-label"> <?php echo __('bundle_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index')) ?>">
                    <i class="fa fa-user"></i> <span class="nav-label"> <?php echo __('user_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Roles', 'action' => 'index')) ?>">
                    <i class="fa fa-users"></i> <span class="nav-label"> <?php echo __('role_nav_title') ?> </span>
                </a>
            </li>
            <li class="">
                <a href="<?php echo Router::url(array('controller' => 'Perms', 'action' => 'index')) ?>">
                    <i class="fa fa-user-secret"></i> <span class="nav-label"> <?php echo __('perm_nav_title') ?> </span>
                </a>
            </li>
        </ul>
    </div>
</nav>