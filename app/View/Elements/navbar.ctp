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
        </ul>
    </div>
</nav>