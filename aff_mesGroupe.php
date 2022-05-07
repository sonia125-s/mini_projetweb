<?php
 session_start();
 
     //$classe=$_REQUEST['classe'];
     $id=$_SESSION['id'];
   
include("connexion.php");
$req="SELECT * FROM enseignant_groupe  ";

$reponse = $pdo->query($req);

if($reponse->rowCount()>0) {
	$outputs["etudiants"]=array();




	
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
     if($row["id_prof"]==$id){
        $etudiant = array();
        $etudiant["id"] = $row["id_prof"];
        $etudiant["matiere"] = $row["matiere"];
        $etudiant["classe"] = $row["classe"];
        
         array_push($outputs["etudiants"], $etudiant);
     }
    }
    // success
    if($outputs["etudiants"]!=[])
    {
    $outputs["success"] = 1;
    }
    else{
     $outputs["success"] = 0;  
    }
     echo json_encode($outputs);
     
}
else {
    $outputs["success"] = 0;
    $outputs["message"] = "Pas d'étudiants";
    // echo no users JSON
    echo json_encode($outputs);
   
}

?>