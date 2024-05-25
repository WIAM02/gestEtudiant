<?php
session_start();
if (isset($_SESSION['id'])) {
  $conn = require_once "C:/xampp/htdocs/gestEtudiant/GL_project/model/database.php";

  $dateSubmission = date("Y-m-d H:i:s");

  $etudiantID = mysqli_real_escape_string($conn, $_POST['etudiantID']);
  $typeDemande = mysqli_real_escape_string($conn, $_POST['typeDemande']);
  $anneeAcademique = mysqli_real_escape_string($conn, $_POST['anneeAcademique']);

  $sql = mysqli_query($conn, "INSERT INTO demande (etudiantID, typeDemande , dateSubmission) 
                              VALUES ('{$etudiantID}', '{$typeDemande}','{$dateSubmission}')") or die();

  $sql = mysqli_query($conn, "SELECT * FROM demande WHERE etudiantID = '{$etudiantID}' AND typeDemande = '{$typeDemande}' AND dateSubmission = '{$dateSubmission}'");

  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }

  $demandeID = $row['id'];

  $sql = mysqli_query($conn, "SELECT * FROM etudiant WHERE id = '{$etudiantID}'");

  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }

  $nomEtudiant = $row['nomEtudiant'];
  $cin = $row['cin'];
  $dateNaissance = $row['dateNaissance'];
  $address = $row['address'];

  $sql = mysqli_query($conn, "INSERT INTO documentAcademique (demandeID, etudiantID, typeDocument,nomEtudiant,cin,dateNaissance,address,anneeAcademique) 
                            VALUES ('{$demandeID}', '{$etudiantID}', '{$typeDemande}', '{$nomEtudiant}', '{$cin}', '{$dateNaissance}', '{$address}', '{$anneeAcademique}')") or die();
} else {
  header("Location: gestEtudiant/GL_project/view/login.php");
}