<?php
	$author_name = "Peep Võtti";
	$todays_evaluation = null; //$todays_evaluation = "";
	$inserted_adjective = null;
	$adjective_error = null;
	
	//kontrollin, kas on klikitud submit nuppu
	if(isset($_POST["todays_adjective_input"])) {
	//	echo "Klikiti nuppu!";
	// Kas midagi kirjutati ka?
		if(!empty($_POST["adjective_input"])){
			$todays_evaluation = "<p> Tänane päev on <strong>" .$_POST["adjective_input"] . "</strong>.</p>";
			$inserted_adjective = $_POST["adjective_input"];
		} else {
			$adjective_error = "Palun kirjuta siia tänase ilma kohta sobiv omadussõna!";
		}
	}
	//var_dump($_POST);
	
	//loeme kataloogide sisu
	$photo_dir = "Photos/";
	$allowed_photo_types = ["image/jpeg", "image/png"];
	//$all_files = scandir($photo_dir);
	$all_files = array_slice(scandir($photo_dir), 2);
	//echo $all_files - Ei sobi!
	//var_dump($all_files);
	$photo_files = [];
	foreach($all_files as $file){
		$file_info = getimagesize($photo_dir .$file);
		if(isset($file_info["mime"])){
			if(in_array($file_info["mime"], $allowed_photo_types)){
				array_push($photo_files, $file);
			}
		}
	}
	
	//if($muutuja > 8 and $muutuja <= 18);
	//$only_files = array_slice($all_files, 2);
	//var_dump($only_files);
	$limit = count($photo_files);
	$pic_num = mt_rand(0, $limit - 1);
	$pic_file = $photo_files[$pic_num];
	//<img src="tlulogo.gif" alt="Tallinna Ülikooli logo">
	$pic_html = '<img src="' .$photo_dir .$pic_file .'" alt="Tallinna Ülikooli logo">';
	
	//fotode nimekiri
	//<p>Valida on järgmised fotod: <strong>foto1.jpg</strong>, <strong>foto2.jpg</strong>, <strong>foto3.jpg</strong>.</p>
	//<ul>Valida on järgmised fotod: <li>foto1.jpg</li>, <lifoto2.jpg</li>, <li>foto3.jpg</li></ul>
	$list_html = "<ul> \n";
	for($i = 0; $i < $limit; $i ++){
		$list_html .= "<li>" .$photo_files[$i] ."</li> \n";
	}
	$list_html .= "</ul>";
	
	$photo_select_html = '<select name="photo_select">' ."\n";
	$photo_select_html .='option value="0">Valige pilt</option' . "\n";
	for($i = 0; $i < $limit; $i ++){
		//option value="0">fail.jpg</option>
		$i = $i + 0;
		$photo_select_html .= '<option value="' .$i .'">' .$photo_files[$i] ."</option>";
	
	}
	$photo_select_html .= '</select><input type="submit" name="picture_choice_input" value="Vali">';
	if(isset($POST['picture_choice_input'])){
		if(!empty($POST['photo_select'])){
			$pic_choice_num = $POST['photo_select'];
			var_dump($_POST);
			$pic_choice_num -= 1;
			$pic_choice_file = $photo_files[$pic_choice_num];
			$pic_choice_html = 'img src="' . $photo_dir . $pic_choice_file . '"alt="TLÜ õppehoone">';
			echo $pic_choice_html;
		}else{
			$picture_choice_error = "Vali õige pilt";
		}
	}
	$photo_select_html .= "</select>"
?>
<!DOCTYPE html>
<html lang="et">

<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p><b>See leht on valminud õppetöö raames ja ei sisalda mingit tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<img src="tlulogo.gif" alt="Tallinna Ülikooli logo"> 
	<hr>
	<form method="POST">
		<input type="text" name="adjective_input" placeholder="Omadussõna tänase kohta" value ="<?php echo $inserted_adjective; ?>">
		<input type="submit" name="todays_adjective_input" value="Saada">
		<span><?php echo $adjective_error; ?></span>
	</form>
	<hr>
	<?php 
		echo $todays_evaluation;
		
	?>
	<form method="POST">
		<?php echo $photo_select_html; ?>
	</form>
	<?php
		echo $list_html;
		echo $pic_html; 
	
	
	?>
	
<p><i>Ma lisan siia veel ühe mitte tõsiseltvõetava teksti, sest seda lehte ei ole tegelikult olemas. Ausalt.</i></p>
</b>
</body>





</html>