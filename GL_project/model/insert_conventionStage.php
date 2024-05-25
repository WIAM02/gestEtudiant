<?php

$conn = require_once "C:/xampp/htdocs/gestEtudiant/GL_project/model/database.php";

$dateSubmission = date("Y-m-d H:i:s");


$etudiantID = mysqli_real_escape_string($conn, $_POST['etudiantID']);
$typeDemande = mysqli_real_escape_string($conn, $_POST['typeDemande']);
$nomEntreprise = $_POST['nomEntreprise'];
$secteur = $_POST['secteur'];
$telephone = $_POST['telephone'];
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$ville = mysqli_real_escape_string($conn, $_POST['ville']);
$representant = mysqli_real_escape_string($conn, $_POST['representant']);
$superviseurEntreprise = mysqli_real_escape_string($conn, $_POST['superviseurEntreprise']);
$superviseurEnsa = mysqli_real_escape_string($conn, $_POST['superviseurEnsa']);
$dateDebut = mysqli_real_escape_string($conn, $_POST['dateDebut']);
$dateFin = mysqli_real_escape_string($conn, $_POST['dateFin']);
$sujet = mysqli_real_escape_string($conn, $_POST['sujet']);

$sql = mysqli_query($conn, "INSERT INTO demande (etudiantID, typeDemande , dateSubmission) 
                              VALUES ('{$etudiantID}', '{$typeDemande}','{$dateSubmission}')") or die();

$sql = mysqli_query($conn, "SELECT * FROM demande WHERE etudiantID = '{$etudiantID}' AND typeDemande = '{$typeDemande}' AND dateSubmission = '{$dateSubmission}'");

if (mysqli_num_rows($sql) > 0) {
  $row = mysqli_fetch_assoc($sql);
}

$demandeID = $row['id'];

$sql = mysqli_query($conn, "INSERT INTO conventionstage (demandeID, etudiantID, nomEntreprise , secteur, telephone, email, address, ville, representant, superviseurEntreprise , superviseurEnsa, dateDebut, dateFin , sujet) 
                            VALUES ('{$demandeID}', '{$etudiantID}', '{$nomEntreprise}','{$secteur}', '{$telephone}','{$email}', '{$address}', '{$ville}','{$representant}', '{$superviseurEntreprise}','{$superviseurEnsa}', '{$dateDebut}','{$dateFin}', '{$sujet}')") or die();