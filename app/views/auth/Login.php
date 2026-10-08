<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?= asset("css/bootstrap.css") ?>">
  <link rel="stylesheet" href="<?= asset("css/global.css") ?>">
</head>

<body>
  <?php include __DIR__ . "/../components/Navbar.php" ?>


  <section id="Login" class="">

    <div class="container my-5">
      <form class="w-25 m-auto" method="POST" action="<?= route('/auth/login') ?>">
        <h2 class="text-success text-center mb-4">Login</h2>
        <?= getSessionMsg('invalid') ?>

        <div class="mb-3">
          <label for="Email" class="form-label">Email :</label>
          <input type="email" class="form-control" name="email" id="Email" value="<?= old('email') ?>">
        </div>
        <?= getError('email') ?>
        <div class="mb-3">
          <label for="Password" class="form-label">Password :</label>
          <input type="password" class="form-control" name="password" id="Password" value="<?= old('password') ?>">
        </div>
        
        <button type="submit" class="btn btn-success w-100">Login</button>
      </form>
    </div>
  </section>


  <script src="<?= asset("js/bootstrap.js") ?>"></script>
  <script src="<?= asset("js/jquery.js") ?>"></script>
</body>

</html>