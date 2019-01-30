<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>

    <div id="container">
        <?php if (isset($_SESSION['logged'])){ ?>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
                <a class="navbar-brand" href="#">Witaj, <?php echo $_SESSION['id']?></a>
                <!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">-->
                <!--                <span class="navbar-toggler-icon"></span>-->
                <!--            </button>-->

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Uzupełnij profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Panel Admina</a>
                        </li>

                    </ul>
                    <form action="?page=logout" method="POST">
                        <button type="submit" class="btn btn-primary btn-lg float-right" > Wyloguj się </button>
                    </form>
                </div>
            </nav>

        <?php } ?>

        <div class="main">
            <div id="header" >

                <span><h1 id="text">Foodtruck Localizator</h1></span>
                <span><img src="../../public/res/foodtruck.jpg" class="img-fluid" alt="Responsive image"   id="foodtruck"></span>

            </div>
            <div id="navigation-bar">
                <?php include(dirname(__DIR__).'/navbar.html') ?>
            </div>


        </div>


        <div class="fixed-bottom">
            <div id="footer">
                <h6>Copyright Mateusz Staniszewski</h6>
            </div>
        </div>

    </div>


</body>
</html>

