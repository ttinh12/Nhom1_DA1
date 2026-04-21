<div class="site-section">
  <div class="container">

    <div class="row mb-5">
      <div class="col-12 text-center">
        <h2 class="text-secondary fw-bold">Đăng ký</h2>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-4">

        <form method="POST" action="index.php?page=register" autocomplete="off">

          <!-- NAME -->
          <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Username"
              value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
            <small class="text-muted">Username</small>
          </div>

          <!-- EMAIL -->
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="name@example.com"
              value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <small class="text-muted">Email</small>
          </div>

          <!-- PASSWORD -->
          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <small class="text-muted">Mật khẩu</small>
          </div>

          <!-- CONFIRM PASSWORD -->
          <div class="mb-3">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            <small class="text-muted">Nhập lại mật khẩu</small>
          </div>

          <!-- BUTTON -->
          <button type="submit" class="btn btn-danger w-100">
            ĐĂNG KÝ
          </button>

          <!-- ERROR -->
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-3 text-center p-2">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <!-- SUCCESS (nếu bạn muốn thêm) -->
          <?php if (!empty($success)): ?>
            <div class="alert alert-success mt-3 text-center p-2">
              <?= htmlspecialchars($success) ?>
            </div>
          <?php endif; ?>

          <div class="text-center mt-3">
            <span class="text-muted">Đã có tài khoản?</span>
            <a href="index.php?page=login" class="text-danger">Đăng nhập</a>
          </div>

        </form>

      </div>
    </div>

  </div>
</div>