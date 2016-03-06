<div>
    <div>
        <h1 class="logo-name" style="font-size: 70px !important;">
            <?php echo Configure::read('saya.App.name') ?>
        </h1>
    </div>
    <h3><?php echo Configure::read('saya.App.slogan') ?></h3>
    <?php
    echo $this->Form->create($model_name, array(
        'class' => 'm-t',
        'role' => 'form',
    ));
    ?>
    <div class="form-group">
        <?php
        echo $this->Form->input('username', array(
            'placeholder' => __('username_placeholder'),
            'required' => true,
            'div' => false,
            'label' => false,
            'class' => 'form-control',
        ));
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $this->Form->input('password', array(
            'placeholder' => __('password_placeholder'),
            'required' => true,
            'div' => false,
            'label' => false,
            'class' => 'form-control',
            'type' => 'password',
        ));
        ?>
    </div>
    <?php
    echo $this->Form->button(__('log_in'), array(
        'class' => 'btn btn-primary block full-width m-b',
    ));
    ?>
    <?php echo $this->Form->end() ?>
</div>