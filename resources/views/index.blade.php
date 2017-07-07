@extends('header')
    <body>
<header>


<div class="col-md-4"></div>
    <form class="form col-md-4">
        <h1>Authorization</h1>
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form__input form-control" placeholder="Enter your login" name="login" required>
        </div>
        <div class="form-group">
            <label for="passwd">Password</label>
            <input type="password" class="form__input form-control" placeholder="Enter your password" name="passwd" required>
        </div>

        <button class="btn btn-primary">Регистрация</button>
        <button type="submit" class="btn btn-success">Войти</button>
    </form>
<div class="col-md-4"></div>
</header>
    </body>
</html>
