<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <main class="form-signin w-100" style="max-width: 330px;">

    <form method="POST" action="index.php?page=login" autocomplete="off">
      <h1 class="h3 mb-3 fw-normal text-center">Đăng nhập</h1>

      <!-- EMAIL -->
      <div class="form-floating mb-2">
        <input type="email" name="email" class="form-control" placeholder="name@example.com"
          value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        <label>Email</label>
      </div>

      <!-- PASSWORD -->
      <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <label>Mật khẩu</label>
      </div>

      <!-- REMEMBER -->
      <div class="form-check text-start mb-3">
        <input class="form-check-input" type="checkbox" name="remember">
        <label class="form-check-label">
          Ghi nhớ đăng nhập
        </label>
      </div>

      <!-- BUTTON -->
      <button class="btn btn-primary w-100 py-2" type="submit">
        Đăng nhập
      </button>

      <!-- ERROR -->
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger mt-3 text-center p-2">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <p class="mt-3 text-center">
        Chưa có tài khoản?
        <a href="index.php?page=register">Đăng ký</a>
      </p>
    </form>

  </main>
</div>