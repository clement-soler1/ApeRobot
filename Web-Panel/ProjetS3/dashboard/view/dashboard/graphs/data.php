<?php
 	$con = mysqli_connect('webinfo.iutmontp.univ-montp2.fr','sornayj','<wxcvbn,;:!123','sornayj');
//	$new_csv = fopen('E:/pleasework/www/ProjetS3/Web-Panel/ProjetS3/dashboard/view/dashboard/graphs/csv/test.csv', 'w');

	$query = "SELECT DISTINCT rel.`date`, rel.`time`, vhc.`marque`, vhc.`modele`, vhc.`immatriculation`, cpt.`nomCapteur`, dat.`donnee`
						  INTO OUTFILE 'E:/pleasework/www/ProjetS3/Web-Panel/ProjetS3/dashboard/view/dashboard/graphs/csv/test.csv'
						  FIELDS TERMINATED BY ',' 
						  LINES TERMINATED BY '\n'
						  FROM Ap_Releve rel
						  JOIN Ap_Data dat ON dat.`idReleve` = rel.`idReleve`
						  JOIN Ap_Capteur cpt ON cpt.`typeCapteur` = rel.`typeCapteur`
						  JOIN Ap_Vehicule vhc ON vhc.`idVehicule` = rel.`idVehicule`
						  JOIN Ap_PossesVehicule pss ON vhc.`idVehicule` = pss.`idVehicule`
						  JOIN Ap_User usr ON usr.`idUser` = pss.`idUser`
						  WHERE usr.`idUser` = 2";

	$exec = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($exec)){
	    echo $row;
	    //fputcsv($new_csv, $row);
	}
	
//	fclose($new_csv);

	// output headers so that the file is downloaded rather than displayed
//	header("Content-type: text/csv");
//	header("Content-disposition: attachment; filename = report.csv");
