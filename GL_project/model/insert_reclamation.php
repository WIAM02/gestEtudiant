<?php

$conn = require_once "C:/xampp/htdocs/gestEtudiant/GL_project/model/database.php";

$dateSubmission = date("Y-m-d H:i:s");

$demandeID = mysqli_real_escape_string($conn, $_POST['demandeID']);
$etudiantID = mysqli_real_escape_string($conn, $_POST['etudiantID']);
$details = mysqli_real_escape_string($conn, $_POST['details']);


$sql = mysqli_query($conn, "INSERT INTO reclamation (demandeID, etudiantID , dateSubmission, details) 
                              VALUES ('{$demandeID}', '{$etudiantID}','{$dateSubmission}','{$details}')") or die();