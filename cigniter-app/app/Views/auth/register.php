<?= $this->include('templates/header') ?>

<div class="form-wrapper">
    <h1>Register</h1>
    <?php $errors = session()->getFlashdata('errors'); ?>

    <form action="/register" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= old('username') ?>">
            <?php if (isset($errors['username'])): ?>
                <div class="validation-error"><?= esc($errors['username']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= old('email') ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="validation-error"><?= esc($errors['email']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <?php if (isset($errors['password'])): ?>
                <div class="validation-error"><?= esc($errors['password']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="pass_confirm">Confirm Password</label>
            <input type="password" name="pass_confirm" id="pass_confirm">
             <?php if (isset($errors['pass_confirm'])): ?>
                <div class="validation-error"><?= esc($errors['pass_confirm']) ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
    </form>
</div>

<?= $this->include('templates/footer') ?>