<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Page with Background Image Example</title>
  <link rel="stylesheet" href="<? echo assets('css/login/style.css') ?>">
</head>

<body>
  <div id="bg"></div>
  <form action="/login/secret/e10adc3949ba59abbe56e057f20f883e" method="POST">
    <div class="form-field">
      <input name="username" placeholder="Email / Username" required />
    </div>
    <div class="form-field">
      <input name="password" type="password" placeholder="Password" required />
    </div>
    <div class="form-field">
      <button class="btn" type="submit">Log in</button>
    </div>
  </form>
</body>

</html>