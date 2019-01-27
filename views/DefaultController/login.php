<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body id="body_back">

<div class="login">
    <div clas="row">
        <div class="col-sm-6 offset-sm-3">
            <h1 >Logowanie </h1>
            <hr>
            <?php if(isset($message)): ?>
                <?php foreach($message as $item): ?>
                    <div><?= $item ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form action="?page=login" method="POST">
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">email</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="E-mail" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">person</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Hasło" type="password" required/>
                    </div>
                </div>
                <input type="submit" value="Zaloguj się" class="btn btn-primary btn-lg float-right" />
            </form>
        </div>
    </div>
</div>

</body>
</html>

