
<?php
// fonction redimage
function redimage($img_src,$img_dest,$dst_w,$dst_h) {
    // Lit les dimensions de l'image
    $size = GetImageSize("$img_src"); 
    $src_w = $size[0]; $src_h = $size[1]; 
    // Teste les dimensions tenant dans la zone
    $test_h = round(($dst_w / $src_w) * $src_h);
    $test_w = round(($dst_h / $src_h) * $src_w);
    // Crée une image vierge aux bonnes dimensions
    // $dst_im = ImageCreate($dst_w,$dst_h);
    $dst_im = ImageCreateTrueColor($dst_w,$dst_h); 
    // Copie dedans l'image initiale redimensionnée
    $src_im = ImageCreateFromJpeg("$img_src");
    //ImageCopyResized($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
    ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);
    // Sauve la nouvelle image
    ImageJpeg($dst_im,"$img_dest");
    // Détruis les tampons
    ImageDestroy($dst_im); 
    ImageDestroy($src_im);}

 $bdd= "ysadowski_pro"; // Base de données 
 $host= "lakartxela";
 $user= "ysadowski_pro"; // Utilisateur 
 $pass= "ysadowski_pro"; // mp
 $nomtable= "cd"; /* Connection bdd */ 

 $link=mysqli_connect($host,$user,$pass,$bdd) or die( "Impossible de se connecter à la base de 
données");


$query = "SELECT * FROM $nomtable";
$result= mysqli_query($link,$query);

if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

while ($donnees=mysqli_fetch_assoc($result)) {
    $ch1=$donnees["titre"];
    $ch2=$donnees["genre"];
    $ch3=$donnees["auteur_groupe"];
    $ch4=$donnees["prix"];
    $ch5=$donnees["image"];
    echo '<img src="'.$ch5.' " height="340" width="340"  /><br><br>';
    print "$ch1 <br>";
    print "$ch2 <br>";
    print "$ch3 <br>";
    print "$ch4 €<br>";
}
/*
//test
$donnees = $mysqli->query("SELECT * FROM cd ORDER BY id ASC");
if($donnees){
    $products_item = '<table border="1" bordercolor="white" style="color:white;"><th>ID</th><th>Product Code</th><th>Fandom</th><th>Category</th><th>Product Name</th><th>Price</th><th>Product Quantity</th>';
    while($obj = $donnees->fetch_object()) {
        $products_item .= <<<EOT
            <tr>
            <td><p align="center">{$obj->image}</p></td>
            <td><p align="center">{$obj->titre}</p></td>
            <td><p align="center">{$obj->genre}</p></td>
            <td><p align="center">{$obj->auteur_groupe}</p></td>
            <td><p align="center">{$obj->prix}</p></td>
            </tr>
            
        EOT;
    }
    $products_item .= '</table>';
    echo $products_item;
}*/
?>

