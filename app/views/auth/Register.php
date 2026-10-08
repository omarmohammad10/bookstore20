<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="<?= asset("css/bootstrap.css") ?>">
  <link rel="stylesheet" href="<?= asset("css/global.css") ?>">
</head>

<body>
  <?php include __DIR__ . "/../components/Navbar.php" ?>

  <section id="Register" class="">

    <div class="container my-5">
      <form class="w-25 m-auto" method="POST" action="<?= route("/auth/register") ?>">
        <h1 class="text-success text-center mb-4">Register</h1>
        <?= getSessionMsg('correct', false) ?>
        <?= getSessionMsg('invalid') ?>
        <div class="mb-3">
          <label for="Role" class="form-label">Role :</label>
          <select class="form-control" name="role" id="Role">
            <option value="" <?= oldSelect('role','') ?> hidden></option>
            <?php
            $select = oldSelect('role', 'admin', true);
            if (isAuth('admin')) {
              echo "<option value='admin' {$select}>Admin</option>";
            } else {
              $select = oldSelect('role', 'customer' , true);
              echo "<option value='customer' {$select}>Customer</option>";
            }
            ?>
          </select>
          <?= getError('role') ?>
        </div>
        <div class="mb-3">
          <label for="Name" class="form-label">Name :</label>
          <input type="text" class="form-control" name="name" id="Name" value="<?= old('name') ?>">
        </div>
        <?= getError('name') ?>
        <div class="mb-3">
          <label for="Email" class="form-label">Email :</label>
          <input type="email" class="form-control" name="email" id="Email" value="<?= old('email') ?>">
        </div>
        <?= getError('email') ?>
        <div class="mb-3">
          <label for="Password" class="form-label">Password :</label>
          <input type="password" class="form-control" name="password" id="Password" value="<?= old('password') ?>">
        </div>
        <?= getError('password') ?>
        <div class="mb-3">
          <label for="Phone" class="form-label">Phone :</label>
          <input type="text" class="form-control" name="phone" id="Phone" value="<?= old('phone') ?>">
        </div>
        <?= getError('phone') ?>
        <div class="mb-3">
          <label for="Gender" class="form-label">Gender :</label>
          <select class="form-control" name="gender" id="Gender">
            <option value="" <?= oldSelect('gender', "") ?> hidden></option>
            <option value="male" <?= oldSelect('gender', "male") ?>>Male</option>
            <option value="female" <?= oldSelect('gender', "female") ?>>Female</option>
          </select>
        </div>
        <?= getError('gender') ?>
        <button type="submit" class="btn btn-success w-100">Register</button>
      </form>
    </div>
  </section>


  <script src="<?= asset("js/bootstrap.js") ?>"></script>
  <script src="<?= asset("js/jquery.js") ?>"></script>
</body>

</html>