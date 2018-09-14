<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.10/css/mdb.min.css" rel="stylesheet">    <!-- <link rel="stylesheet" type="text/css" href="../css/style.css">-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<h1 class="text-center">Télécharger votre PDF</h1>
<?php
//  <embed src=\" ../document / ".$files[$i]."\" width=\"680px\" height=\"800px\">
if(isset($_POST['envoyer'])) {
    $dossier = '../document';
    $fichier = $_FILES['upload']['name'];
    $taille_maxi = 1000000;
    $fichier_temp = $_FILES['upload']['tmp_name'];
    $taille = $_FILES['upload']['size'];
    $extensions = array('.pdf');
    // on compte le nombre de fichier envoyés
    $nbfichiersEnvoyes = count($fichier_temp);
    for($i=0; $i<$nbfichiersEnvoyes; $i++) {
        //Début des vérifications de sécurité...
        if(!in_array(strrchr($fichier[$i], '.'), $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $error = '<span>Vous devez uploader un fichier de type pdf</span></br>';
        }
        if($taille[$i]>$taille_maxi)
        {
            $error = 'Le fichier est trop gros...';
        }
        if(!isset($error)) //S'il n'y a pas d'error, on upload
        {
            $ext = uniqid().strrchr($fichier[$i], '.');
            $pathImg = '../document/caldex'.$ext;
            if(move_uploaded_file($fichier_temp[$i],$pathImg )) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                //require_once 'test.php';
                echo "<div class=\"alert alert-success\" role=\"alert\">Upload effectué avec succès !</div></br>";
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo '<span class="non">Echec de l\'upload !</span>';
            }
        }
        else
        {
            echo "<div class=\"alert alert-danger\" role=\"alert\">".$error." </div>";
        }
    }
}
?>
<br><br><br><br><br><br>
<div class="col-lg-12">
    <div class="form-group text-center">
        <form method="POST" action="index.php" enctype="multipart/form-data">
            <label id="largeFile" for="file">
                <input type="file" id="file" name="upload[]" multiple = "multiple"/>
                <input type="submit" name="envoyer" value="Envoyer">
            </label>

        </form>
    </div>
</div>
<div class="row">
    <?php
    $document = '../document/';
    $files = scandir($document);
    for ($i=2; $i < count($files) ; $i++) {
        if (isset ($_POST[$i])) {
            $path = "../document/".$files[$i];
            unlink($path);
        }
        else{
            echo "
  <div class=\"col-xs-6 col-md-3\">
      <!--<img src=\"../document/".$files[$i]."\"width=\"auto\" height=\"190\" >-->
      <div data=\"../document/'.files[$i].'\" type=\"application/pdf\">
          <div class='col-md-8'>
               <form action=\"download.php\" method=\"post\">
                    <input type=\"hidden\" name=\"filePdf\" value=\"$files[$i]\">
                    <p>Télécharger : <button type='submit'>\"$files[$i]\"</button></p>
               </form>
           </div>
           <div class='col-md-4'>
                <form action=\"view.php\" method=\"post\">
                    <input type=\"hidden\" name=\"filePdf\" value=\"$files[$i]\">
                    <button type='submit'><i class=\"far fa-eye\"></i></button>
                </form>
           </div>
      </div>
      <div class='col-md-4'>
          <form action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">
          <button type=\"submit\" name=\"".$i."\" class=\"btn btn-warning\">Supprimer</button>
          </form>
      </div>
  </div>";
        }
    }
    ?>
</div>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.10/js/mdb.min.js"></script>

</body>
</html>