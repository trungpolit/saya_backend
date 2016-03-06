<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-8">
        <?php
        $page_title = !empty($page_title) ? $page_title : '';
        $home_url = !empty($home_url) ? $home_url : '';
        ?>
        <h2><?php echo $page_title ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo $home_url ?>"><?php echo __('home_title') ?></a>
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
</div>