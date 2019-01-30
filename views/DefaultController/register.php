<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>


<body id="register-back">
<div class="register-back">
    <form action="?page=register" method="post">

        <div class="register">
            <h1 class="form-group">Zarejestruj się</h1>
            <?php
            if (isset($_SESSION['success']))
            {
                echo '<div class="success">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }?>
            <div class="form-group">
            <label for="inputEmail">Adres e-mail</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Wprowadź e-mail"
            value="
            <?php
            if (isset($_SESSION['r_email']))
            {
                echo $_SESSION['r_email'];
                unset ($_SESSION['r_email']);
            }?>
            ">
                <?php
                if (isset($_SESSION['e_email']))
                {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
                }
                ?>

        </div>

       <div class="form-group">
            <label for="inputUsername">Nazwa użytkownika</label>
            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Wprowadź nazwę użytkownika, którą będziesz się posługiwać value="
           <?php
           if (isset($_SESSION['r_user']))
           {
               echo $_SESSION['r_user'];
               unset ($_SESSION['r_user']);
           }?>
           ">
        </div>
            <?php
            if (isset($_SESSION['e_nick']))
            {
                echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                unset($_SESSION['e_nick']);
            }
            ?>

        <div class="form-group">
            <label for="inputPass1">Hasło</label>
            <input type="password" class="form-control" id="inputPass1" name="pass1" placeholder="Wprowadź hasło" value="
            <?php
                   if (isset($_SESSION['r_pass']))
                   {
                       echo $_SESSION['r_pass'];
                       unset ($_SESSION['r_pass']);
                   }?>
            ">
            <?php
            if (isset($_SESSION['e_pass']))
            {
                echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
                unset($_SESSION['e_pass']);
            }
            ?>
        </div>

        <div class="form-group">
            <label for="inputPass2">Hasło</label>
            <input type="password" class="form-control" id="inputPass2" name="pass2" placeholder="Powtórz wprowadzone hasło">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="acceptance" name="accept"">
            <label class="form-check-label" for="acceptance">Akceptuję regulamin</label>
            <?php
            if (isset($_SESSION['e_accept']))
            {
                echo '<div class="error">'.$_SESSION['e_accept'].'</div>';
                unset($_SESSION['e_accept']);
            }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Zarejestruj</button>
        </div>

    </form>

</div>
</body>
</html>



