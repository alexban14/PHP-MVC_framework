

<div class="p-2">
    <h1 class="p-2">Create an account</h1>

    <?php $form =  app\core\form\Form::begin('', "post") ?>
        <?php echo $form->field($model, 'firstname') ?>
        <?php echo $form->field($model, 'lastname') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordField() ?>
        <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>

        <button type="submit" class="btn btn-primary">Register</button>
    <?php echo \app\core\form\Form::end() ?>
</div>
