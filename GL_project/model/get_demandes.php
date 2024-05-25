<?php
$sql = "SELECT * FROM demande WHERE etudiantID =$etudiantID";

$query = mysqli_query($conn, $sql);

$output = "";

$digit = 1;

if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_array($query)) {
    switch ($row['typeDemande']) {
      case "conventionstage":
        $typeDemande = "Convention de stage";
        break;
      case "attestationscolarite":
        $typeDemande = "Attestation de scolarité";
        break;
      case "attestationreussite":
        $typeDemande = "Attestation de reussite";
        break;
      case "relevenotes":
        $typeDemande = "Relevé de notes";
        break;
      default:
        $typeDemande = "Unknown";
    }

    $output .= ' <div>
     <input type="radio" name="demandeID" id="id' . $digit . $row['id'] . '" class="radio-4" value=\'' . $row['id'] . '\' />
     <label class="label-reclamation" for="id' . $digit . $row['id'] . '">
     <span class="name">' . $typeDemande . '</span>
     <span class="name">' . $row['dateSubmission'] . '</span>
     </label>
     </div>';
    $digit++;
  }
}

echo $output;
