<?php 
require_once 'config.php';
$alphas = range('A', 'Z');

if(isset($_GET['film']) ) {
	$expression=$connection->prepare("select filmovi.slika as slika, filmovi.naslov as naslov, filmovi.godina as godina, filmovi.trajanje as trajanje, zanr.naziv as zanr from filmovi join zanr  on filmovi.id_zanr=zanr.id where naslov like :naslov");
    $expression->execute(array(":naslov"=> $_GET['film'] . "%"));
	$filmovi = $expression->fetchAll(PDO::FETCH_OBJ);
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>

<a href="unos.php">Unesi novi film</a>

<br><br>

<?php foreach ($alphas as $alfabet): ?>
	<a href="<?php echo $_SERVER["PHP_SELF"]?>?film=<?php echo $alfabet; ?>"><?php echo $alfabet; ?></a>
<?php endforeach; ?>

<br><br>

<?php 
if (isset($filmovi)) :
foreach ($filmovi as $film): ?>
	<img src="img/<?php echo $film->slika; ?>" alt="slika" width="200">
	<p><?php echo $film->naslov; ?> (<?php echo $film->godina; ?>)</p>
	<p>Trajanje: <?php echo $film->trajanje; ?> min</p>
	<p>Žanr: <?php echo $film->zanr; ?></p>
<?php  endforeach; endif;?>




</body>
</html>
