<!-- File: src/Template/Users/resetPass.ctp -->
<?= $this->Flash->render(); ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your new password.') ?></legend>

        <?= $this->Form->input('email', ['type'=>'hidden','label' => 'New Password','value'=>'devraghav78@gmail.com']) ?>

        <?= $this->Form->input('password', ['label' => 'New Password']) ?>

        <?= $this->Form->input('confirmpassword', ['type' => 'password', 'label' => 'Confirm New Password']) ?>

    </fieldset>
    <?= $this->Form->button(__('Update password')); ?>
<?= $this->Form->end() ?>