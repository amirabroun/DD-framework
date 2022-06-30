<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<? echo assets('css/login/style.css') ?>">
</head>

<body>
    <div id="bg"></div>
    <form action="<? echo '/login/secret/' . md5(secretKey('secret_login')) ?>" method="POST">
        <div class="form-field">
            <input name="username" placeholder="Email / Username" required />
        </div>
        <div class="form-field">
            <input name="password" type="password" placeholder="Password" required />
        </div>
        <? if (isset($error)) { ?>
            <div class="form-field">
                <? echo $error ?>
            </div>
        <?
        } ?>
        <div class="form-field">
            <button class="btn" type="submit">Log in</button>
        </div>
    </form>
</body>

<script src="<? echo jsFiles('auth/login.js') ?>"></script>

</html>