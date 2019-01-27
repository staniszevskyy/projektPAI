<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>


<body id="register-back">
<div class="register-back">
    <form>

        <div class="register">
            <h1 class="form-group">Zarejestruj się</h1>


            <div class="form-group">
            <label for="inputEmail">Adres e-mail</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Wprowadź e-mail">

        </div>
        <div class="form-group">
            <label for="inputUsername">Nazwa użytkownika</label>
            <input type="text" class="form-control" id="inputUsername" placeholder="Wprowadź nazwę użytkownika, którą będziesz się posługiwać">
        </div>

        <div class="form-group">
            <label for="inputPass1">Hasło</label>
            <input type="password" class="form-control" id="inputPass1" placeholder="Wprowadź hasło">
        </div>

        <div class="form-group">
            <label for="inputPass2">Hasło</label>
            <input type="password" class="form-control" id="inputPass2" placeholder="Powtórz wprowadzone hasło">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="acceptance">
            <label class="form-check-label" for="acceptance">Akceptuję regulamin</label>
        </div>
        <button type="submit" class="btn btn-primary">Zarejestruj</button>
        </div>

    </form>

</div>
</body>
</html>



