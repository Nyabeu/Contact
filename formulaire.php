<?php

    require_once 'ContactForm.class.php';

    //instanciation : création d'un objet d'un certain type avec new
    $form = new ContactForm();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="author" content=" Oriane NJILIE">
	<meta name="description" content="Formulaire de contact">
	<link rel="shortcut icon" href="photos/iconOriane.ico" type="image/x-icon">
    <title>FORMULAIRE DE CONTACT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <h1 class="text-center">FORMULAIRE</h1>
    <main class="container">
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-lg-2 col-lg-offset-1">Nom : </label>
                <div class="col-lg-7 col-lg-offset-1">
                    <input type="text" class="form-control" name="lastname" value="<?= $form->getFields()['lastname']['value'];?>">
                </div>
            </div><br>
            <div class="form-group">
                <label class="control-label col-lg-2 col-lg-offset-1">Prénom : </label>
                <div class="col-lg-7 col-lg-offset-1">
                    <input type="text" class="form-control" name="firstname" value="<?= $form->getFields()['firstname']['value'];?>">
                </div>
            </div><br>
            <div class="form-group">
                <label class="control-label col-lg-2 col-lg-offset-1">Email : </label>
                <div class="col-lg-7 col-lg-offset-1">
                    <input type="email" class="form-control" name="email" value="<?= $form->getFields()['email']['value'];?>">
                </div>
            </div><br>
            <div class="form-group">
                <label class="control-label col-lg-3">J'aime le PHP ? </label>

                <div class="col-lg-8 col-lg-offset-1">

                    <div class="col-lg-3"><input type="radio" class="col-lg-2" name="php" value="y" <?= $form->checkRadio('php','y');?>>
                        <label class="control-label  col-lg-1">Oui </label></div>
                    <div class="col-lg-3"><input type="radio" class="col-lg-2" name="php" value="n" <?= $form->checkRadio('php','n');?>>
                        <label class="control-label col-lg-1">Non</label></div>
                    <div class="col-lg-5"><input type="radio" class="col-lg-1" name="php" value="p" <?= $form->checkRadio('php','p');?>>
                        <label class="control-label col-lg-7">Peut-être </label></div>

                </div>
            </div><br>
            <div class="form-group">
                <label class="control-label col-lg-3 ">Vos loisirs :</label>
                <div class="col-lg-9">
                    <div class="col-lg-3 col-lg-offset-1"><input type="checkbox"  name="hobbies[]" value="1" <?= $form->checkBox('hobbies',1);?>>
                    <label class="control-label">Musique</label></div>
                    <div class="col-lg-3 col-lg-offset-1"><input type="checkbox" name="hobbies[]" value="2" <?= $form->checkBox('hobbies',2);?>>
                    <label class="control-label">Cinéma</label></div>
                    <div class="col-lg-3 col-lg-offset-1"><input type="checkbox"  name="hobbies[]" value="3" <?= $form->checkBox('hobbies',3);?>>
                     <label class="control-label">Lecture</label></div>
                </div>
            </div><br>
            <div class="form-group">
                <label class="control-label col-lg-3">Pays : </label>
                <select name="country" class="col-lg-7 form-control col-lg-offset-1" style="width: 60%">
                    <option value=""></option>
                    <option value="fr" <?= $form->selectOption('country','fr');?>>France</option>
                    <option value="es" <?= $form->selectOption('country','es');?>>Espagne</option>
                    <option value="de" <?= $form->selectOption('country','de');?>>Allemagne</option>
                    <option value="it" <?= $form->selectOption('country','it');?>>Italie</option>
                    <option value="cm" <?= $form->selectOption('country','cm');?>>Cameroun</option>
                </select>
            </div>
            <div class="form-group">
                <div class=" col-lg-2 col-lg-offset-9">
                    <input type="submit" name="submit" class="btn btn-danger" value="Enregistrer">
                </div>
            </div>
        </form>

        <ul>
             <?php
                foreach ($form->getMessage() as $value){
                    echo "<li>$value</li>";
                }
             ?>
        </ul>
    </main>
    <script src="js/jquery.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

</body>
</html>
