<?php
/**
 * File: /views/auth/login.php
 * Konten Form Login. File ini dimuat di dalam /views/layout/auth.php
 */
?>

<?= Helper::flash('error') ?> 

<form action="<?= BASE_URL ?>/do_login" method="POST">
    <div class="mb-3">
        <input type="text" 
            class="form-control form-control-lg"
            name="username" 
            placeholder="Masukkan Username..." 
            required>
    </div>
    <div class="mb-4">
        <input type="password" 
            class="form-control form-control-lg"
            name="password" 
            placeholder="Password" 
            required>
    </div>
    <button type="submit" class="btn btn-primary btn-lg w-100">
        <i class="fas fa-sign-in-alt"></i> Login
    </button>
</form>