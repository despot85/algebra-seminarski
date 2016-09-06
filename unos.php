<?php 
require_once 'config.php';

if(isset($_POST['spremi']) ) {
	$expression=$connection->prepare("insert into filmovi 
      (naslov,id_zanr,godina,trajanje) 
      values 
      (:naslov,:id_zanr, :godina,:trajanje)"); 
	$expression->bindParam(':naslov', $_POST['naslov']);
	$expression->bindParam(':id_zanr', $_POST['zanr']);
	$expression->bindParam(':godina', $_POST['godina']);
	$expression->bindParam(':trajanje', $_POST['trajanje']);        
    $expression->execute();

    $filmId = $connection->lastInsertId();

    if(isset($_FILES["slika"]) && $_FILES["slika"]["name"] != ""){
		$n = explode(".",$_FILES["slika"]["name"]);
		$nazivDatateke = "slika_" . $filmId . "_" . date("U") . "." 
		. $n[count($n)-1];
		move_uploaded_file($_FILES["slika"]["tmp_name"], 
		"img/" . $nazivDatateke);
		$expression=$connection->prepare("update filmovi set slika=:slika 
		where id=:id;");
		$expression->bindParam("slika",$nazivDatateke);
		$expression->bindParam("id",$filmId);		
		$expression->execute();
	}

    header("location: unos.php");
}


$expression=$connection->prepare("select * from zanr");
$expression->execute();
$zanrovi = $expression->fetchAll(PDO::FETCH_OBJ);

$expression=$connection->prepare("select * from filmovi order by naslov ASC");
$expression->execute();
$filmovi = $expression->fetchAll(PDO::FETCH_OBJ);




if(isset($_GET['brisanje']) ) {
	$expression=$connection->prepare("delete from filmovi where id=:id");
	$expression->bindParam(':id', $_GET['brisanje']);
	$expression->execute();
	header("location: unos.php");

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Unos</title>
	<style type="text/css" media="screen">
		table {
	   	 	width: 100%;
      		border-collapse: collapse;
		}

		th {
		    height: 50px;
		}
		table, th, td {
		    border: 1px solid black;
		}
	</style>
</head>
<body>
<h3>Unos</h3>

<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
	<label for="naslov">Naslov</label>
	<input type="text" name="naslov" id="naslov" value="<?php echo isset($_POST['naslov']) ? $_POST['naslov'] : "" ?>" required />

	<br /><br />

	<label for="zanr">Žanr</label>
	  <select id="zanr" name="zanr"> 
		  <?php 
	        foreach ($zanrovi as $zanr):
		  ?>
		    <option value="<?php echo $zanr->id; ?>" 
			<?php 
				if(isset($_REQUEST["zanr"]) && $_REQUEST["zanr"]==$zanr->id){
					echo " selected=\"selected\" ";
				}
			?>
		    required ><?php echo $zanr->naziv; ?>
		    </option>
		   <?php endforeach; ?>
	  </select>

	  <br /><br />

	  <label for="godina">Godina</label>
	  <select id="godina" name="godina">
		  <?php 
	        for($i=1900; $i<= date('Y'); $i++):
		  ?>
		    <option value="<?php echo $i; ?>" 
			<?php 
				if(isset($_REQUEST["godina"]) && $_REQUEST["godina"]==$i){
					echo " selected=\"selected\" ";
				}
			?>
		    required ><?php echo $i; ?>
		    </option>
		   <?php endfor; ?>
	  </select>

	  <br /><br />

	<label for="trajanje">Trajanje</label>
	<input type="number" name="trajanje" id="trajanje" value="<?php echo isset($_POST['trajanje']) ? $_POST['trajanje'] : "" ?>" required/>

	<br /><br />

	<label for="slika">Slika</label>
	<input type="file" name="slika" id="slika" accept="image/*" required/>	

	<br /><br />

	<input type="submit" name="spremi" value="Spremi" />

</form>
<br /><br />
<table>
	<thead>
		<tr>
			<th>Slika</th>
			<th>Naslov filma</th>
			<th>Godina</th>
			<th>Trajanje</th>
			<th>Akcija</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($filmovi as $film): ?>
		<tr>
			<td><img src="img/<?php echo $film->slika; ?>" alt="slika" width="100"></td>
			<td><?php echo $film->naslov; ?></td>
			<td><?php echo $film->godina; ?></td>
			<td><?php echo $film->trajanje; ?> min</td>
			<td><a href="<?php echo $_SERVER["PHP_SELF"]?>?brisanje=<?php echo $film->id; ?>">Obriši</a></td>
		</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>

</body>
</html>
