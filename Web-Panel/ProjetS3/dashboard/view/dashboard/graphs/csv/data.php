<?php
	session_start();

	$con = mysqli_connect('webinfo.iutmontp.univ-montp2.fr','sornayj','<wxcvbn,;:!123','sornayj');
 	$con->set_charset("utf8");
	$num = 0;
	$sql = "SELECT rel.`date`, rel.`time`, vhc.`marque`, vhc.`modele`, vhc.`immatriculation`, cpt.`nomCapteur`, dat.`donnee`
							  FROM Ap_Releve rel
							  JOIN Ap_Data dat ON dat.`idReleve` = rel.`idReleve`
							  JOIN Ap_Capteur cpt ON cpt.`typeCapteur` = rel.`typeCapteur`
							  JOIN Ap_Vehicule vhc ON vhc.`idVehicule` = rel.`idVehicule`
							  JOIN Ap_PossesVehicule pss ON vhc.`idVehicule` = pss.`idVehicule`
							  JOIN Ap_User usr ON usr.`idUser` = pss.`idUser`
							  WHERE usr.`idUser` = " . $_SESSION['userID'] .
							  " ORDER BY rel.`date` DESC, rel.`time` DESC, vhc.`immatriculation`";
	if($result = $con->query($sql)) {
	     while($resultat = $result->fetch_array()) {
	         $input[$num]['date']         		= $resultat['date'];
	         $input[$num]['time']        		= $resultat['time'];
	         $input[$num]['marque'] 			= $resultat['marque'];
	         $input[$num]['modele'] 			= $resultat['modele'];
	         $input[$num]['immatriculation'] 	= $resultat['immatriculation'];
	         $input[$num]['nomCapteur'] 		= $resultat['nomCapteur'];
	         $input[$num]['donnee'] 			= $resultat['donnee'];
	         $num++;        
	    }
	 }
	$output = fopen("php://output",'w') or die("Impossible d'ouvrir php://output");
	header("Content-Type:application/csv"); 
	header("Content-Disposition:attachment;filename=Données.csv"); 
	fputcsv($output, array('date','time','marque', 'modele', 'immatriculation', 'nomCapteur', 'donnee'));
	foreach($input as $inputcsv) {
	    fputcsv($output, $inputcsv);
	}
	fclose($output) or die("Impossible de fermer php://output");