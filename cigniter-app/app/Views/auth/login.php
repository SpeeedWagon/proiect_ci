<?= $this->include('templates/header') ?>

<div class="form-wrapper">
    <h1>Login</h1>
    <?php $errors = session()->getFlashdata('errors'); ?>

    <form action="/login" method="post">
        <?= csrf_field() ?>

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
        
        <div class="form-group" style="display: flex; align-items: center;">
            <input type="checkbox" name="remember" id="remember" style="width: auto; margin-right: 10px;">
            <label for="remember" style="margin: 0;">Remember Me</label>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
    </form>
</div>

<?= $this->include('templates/footer') ?>