<?php

$is_invalid = false;
$is_valid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $cin = $_POST["cin"];
  $email = $_POST["email"];
  $code_apogee = $_POST["code_apogee"];

  $mysqli = require "C:/xampp/htdocs/gestEtudiant/GL_project/model/database.php";

  $sql = sprintf(
    "SELECT * FROM etudiant
    WHERE cin = '%s'",
    $mysqli->real_escape_string($cin)
  );

  $result = $mysqli->query($sql);

  $student = $result->fetch_assoc();

  if ($student) {
    if ($email == $student["email"] && $code_apogee == $student["codeApogee"]) {
      $is_invalid = false;
      $is_valid = true;
      $etudiantID = $student["id"];
      $conn = require "C:/xampp/htdocs/gestEtudiant/GL_project/model/database.php";

      $sql = mysqli_query($conn, "SELECT * FROM etudiant WHERE id = $etudiantID");

      if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
      }

      $anneeAcademique = $row['anneeAcademique'];
    }
  }
  $is_invalid = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="gestEtudiant/GL_project/view/styles/demande.css" />
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body>
    <div class="login-container">
        <form class="form-intro" method="post">
            <img class="avatar" src="gestEtudiant\GL_project\images\login\avatar.svg">
            <h2>Bienvenue</h2>

            <?php if ($is_invalid && !$is_valid) : ?>
            <h4>Identifiant invalide !!</h4>
            <?php endif; ?>

            <div class="input-div-intro one">
                <div class="i">
                    <i class="fas fa-address-card"></i>
                </div>
                <div>
                    <h5>CIN</h5>
                    <input class="input-intro" type="text" name="cin" id="cin" required autofocus
                        value="<?= htmlspecialchars($cin ?? "") ?>" <?php if ($is_valid) : ?> readonly <?php endif ?> />
                </div>
            </div>

            <div class="input-div-intro two">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h5>Email institutionel</h5>
                    <input class="input-intro" type="email" name="email" id="email" required
                        value="<?= htmlspecialchars($email ?? "") ?>" <?php if ($is_valid) : ?> readonly
                        <?php endif ?> />
                </div>
            </div>

            <div class="input-div-intro three">
                <div class="i">
                    <i class="fa-solid fa-laptop-code"></i>
                </div>
                <div>
                    <h5>Code apogée</h5>
                    <input class="input-intro" type="text" name="code_apogee" id="code_apogee" required
                        value="<?= htmlspecialchars($code_apogee ?? "") ?>" <?php if ($is_valid) : ?> readonly
                        <?php endif ?> />
                </div>
            </div>

            <?php if (!$is_valid) : ?>
            <input class="btn-intro" type="submit" value="Suivant" />
            <?php endif ?>
        </form>
    </div>

    <?php if ($is_valid) : ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="http://localhost/gestEtudiant/GL_project/view/demande.php"><i
                class="fa-solid fa-house"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" onclick="showForm('convention'); Scroll('convention')">Convention de Stage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showForm('releve'); Scroll('releve')">Relevé de Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showForm('attestation'); Scroll('attestation')">Attestation de
                        Scolarité</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showForm('reussite'); Scroll('reussite')">Attestation de Réussite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showForm('reclamation'); Scroll('reclamation')">Réclamation</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div id="conventionForm" class="form-container">
            <h1>Convention de stage</h1>
            <form action="#" class="demande-form conventionStage-form" autocomplete="off" method="POST"
                onsubmit="return submitDemande('conventionStage',conventionStageForm);">
                <input type="number" name="etudiantID" value="<?php echo $etudiantID ?>" hidden>
                <input type="text" name="typeDemande" value="conventionstage" hidden>

                <h2>Section 1 : Informations sur l'entreprise et l'école</h2>

                <div class="input-div">
                    <input name="nomEntreprise" id="nomEntreprise" class="input" required></input>
                    <label for="nomEntreprise"> <i class="fa-solid fa-building"></i> &nbsp Nom de l'entreprise</label>
                </div>

                <div class="input-div">
                    <input name="secteur" id="secteur" class="input" required></input>
                    <label for="secteur"> <i class='fas fa-edit'></i> &nbsp Secteur de l'entreprise</label>
                </div>

                <div class="input-div">
                    <input type="tel" pattern="[+]?[0-9]+" title="exemple: +212670824364 or 0670824364" name="telephone"
                        id="telephone" class="input inputtest" required></input>
                    <label for="telephone"> <i class="fa-solid fa-phone"></i> &nbsp Téléphone de l'entreprise</label>
                </div>

                <div class="input-div">
                    <input type="email" title="exemple: test@test.test" name="email" id="email" class="input"
                        required></input>
                    <label for="email"> <i class="fa-solid fa-envelope"></i> &nbsp Email de l'entreprise</label>
                </div>

                <div class="input-div">
                    <input name="address" id="address" class="input" required></input>
                    <label for="address"> <i class="fa-solid fa-location-dot"></i> &nbsp Addresse de
                        l'entreprise</label>
                </div>

                <div class="input-div">
                    <input name="ville" id="ville" class="input" required></input>
                    <label for="ville"> <i class="fa-solid fa-city"></i> &nbsp Ville de l'entreprise</label>
                </div>

                <div class="input-div">
                    <input name="representant" id="representant" class="input" required></input>
                    <label for="representant"> <i class="fa-solid fa-user-tie"></i> &nbsp Representant de
                        l'entreprise</label>
                </div>

                <div class="input-div">
                    <input name="superviseurEntreprise" id="superviseurEntreprise" class="input" required></input>
                    <label for="superviseurEntreprise"> <i class="fa-solid fa-street-view"></i> &nbsp Supervisuer de
                        l'entreprise</label>
                </div>

                <div class="input-div">
                    <input name="superviseurEnsa" id="superviseurEnsa" class="input" required></input>
                    <label for="superviseurEnsa"> <i class="fa-solid fa-street-view"></i> &nbsp Supervisuer de
                        l'ENSA</label>
                </div>

                <h2>Section 2 : Informations sur le stage</h2>

                <div class="input-div">
                    <input type="date" name="dateDebut" id="dateDebut" class="input" required>
                    <label for="dateDebut"> <i class="fas fa-hourglass-start"></i> &nbsp Date de début</label>
                </div>

                <div class="input-div">
                    <input type="date" name="dateFin" id="dateFin" class="input" required>
                    <label for="dateFin"> <i class="fas fa-hourglass-end"></i> &nbsp Date de fin</label>
                </div>

                <div class="input-div">
                    <textarea name="sujet" id="sujet" class="input textarea" required></textarea>
                    <label for="sujet"> <i class="fa-solid fa-clipboard"></i> &nbsp Sujet du stage</label>
                </div>

                <input type="submit" value="Envoyer" class="send-demande-btn" />
            </form>
        </div>

        <div id="releveForm" class="form-container">
            <h1>Relevé de notes</h1>
            <form action="#" class="demande-form releveNotes-form" autocomplete="off" method="POST"
                onsubmit="return submitDemande('releveNotes', releveNotesForm)">
                <input type="number" name="etudiantID" value="<?php echo $etudiantID ?>" hidden>
                <input type="text" name="typeDemande" value="relevenotes" hidden>
                <div class="dropdown">
                    <div class="input-box input-box-1"></div>
                    <div class="list">
                        <div>
                            <input type="radio" name="anneeAcademique" id="id11" class="radio-1" value='1' />
                            <label for="id11">
                                <span class="name">1ère année cycle péparatoire</span>
                            </label>
                        </div>

                        <div <?php if ($anneeAcademique < 2) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id12" class="radio-1" value='2' />
                            <label for="id12">
                                <span class="name">2ème année cycle péparatoire</span>
                            </label>
                        </div>

                        <div <?php if ($anneeAcademique < 3) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id13" class="radio-1" value='3' />
                            <label for="id13">
                                <span class="name">1ère année cycle ingénieur</span>
                            </label>
                        </div>


                        <div <?php if ($anneeAcademique < 4) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id14" class="radio-1" value='4' />
                            <label for="id14">
                                <span class="name">2ème année cycle ingénieur</span>
                            </label>
                        </div>


                        <div <?php if ($anneeAcademique < 5) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id15" class="radio-1" value='5' />
                            <label for="id15">
                                <span class="name">3ème année cycle ingénieur</span>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Envoyer" class="send-demande-btn send-releve-notes-btn hidden" />
            </form>
        </div>

        <div id="attestationForm" class="form-container">
            <h1>Attestation de scolarité</h1>
            <form action="#" class="demande-form attestationScolarite-form" autocomplete="off" method="POST"
                onsubmit="return submitDemande('documentAcademique', attestationScolariteForm)">
                <input type="number" name="etudiantID" value="<?php echo $etudiantID ?>" hidden>
                <input type="text" name="typeDemande" value="attestationscolarite" hidden>
                <div class="dropdown">
                    <div class="input-box input-box-2"></div>
                    <div class="list">
                        <div>
                            <input type="radio" name="anneeAcademique" id="id21" class="radio-2" value='1' />
                            <label for="id21">
                                <span class="name">1ère année cycle péparatoire</span>
                            </label>
                        </div>

                        <div <?php if ($anneeAcademique < 2) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id22" class="radio-2" value='2' />
                            <label for="id22">
                                <span class="name">2ème année cycle péparatoire</span>
                            </label>
                        </div>

                        <div <?php if ($anneeAcademique < 3) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id23" class="radio-2" value='3' />
                            <label for="id23">
                                <span class="name">1ère année cycle ingénieur</span>
                            </label>
                        </div>


                        <div <?php if ($anneeAcademique < 4) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id24" class="radio-2" value='4' />
                            <label for="id24">
                                <span class="name">2ème année cycle ingénieur</span>
                            </label>
                        </div>


                        <div <?php if ($anneeAcademique < 5) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id25" class="radio-2" value='5' />
                            <label for="id25">
                                <span class="name">3ème année cycle ingénieur</span>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Envoyer" class="send-demande-btn send-attestation-scolarite-btn hidden" />
            </form>
        </div>


        <div id="reussiteForm" class="form-container">
            <h1>Attestation de reussite</h1>
            <form action="#" class="demande-form attestationReussite-form" autocomplete="off" method="POST"
                onsubmit="return submitDemande('documentAcademique', attestationReussiteForm)">
                <input type="number" name="etudiantID" value="<?php echo $etudiantID ?>" hidden>
                <input type="text" name="typeDemande" value="attestationreussite" hidden>
                <div class="dropdown">
                    <div class="input-box input-box-3"></div>
                    <div class="list">
                        <div>
                            <input type="radio" name="anneeAcademique" id="id31" class="radio-3" value='1' />
                            <label for="id31">
                                <span class="name">1ère année cycle péparatoire</span>
                            </label>
                        </div>

                        <div <?php if ($anneeAcademique < 2) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id32" class="radio-3" value='2' />
                            <label for="id32">
                                <span class="name">2ème année cycle péparatoire</span>
                            </label>
                        </div>

                        <div <?php if ($anneeAcademique < 3) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id33" class="radio-3" value='3' />
                            <label for="id33">
                                <span class="name">1ère année cycle ingénieur</span>
                            </label>
                        </div>


                        <div <?php if ($anneeAcademique < 4) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id34" class="radio-3" value='4' />
                            <label for="id34">
                                <span class="name">2ème année cycle ingénieur</span>
                            </label>
                        </div>


                        <div <?php if ($anneeAcademique < 5) echo 'class="hidden"' ?>>
                            <input type="radio" name="anneeAcademique" id="id35" class="radio-3" value='5' />
                            <label for="id35">
                                <span class="name">3ème année cycle ingénieur</span>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Envoyer" class="send-demande-btn send-attestation-reussite-btn hidden" />
            </form>
        </div>

        <div id="reclamationForm" class="form-container">
            <h1>Reclamation</h1>
            <form action="#" class="demande-form reclamation-form" autocomplete="off" method="POST"
                onsubmit="return submitDemande('reclamation', reclamationForm)">
                <input type="number" name="etudiantID" value="<?php echo $etudiantID ?>" hidden>

                <div class="dropdown dropdown-reclamation">
                    <div class="input-box input-box-4"></div>
                    <div class="list list-reclamation">
                        <?php
              include('C:/xampp/htdocs/gestEtudiant/GL_project/model/database.php');
              ?>
                    </div>
                </div>
                <div class="input-div input-div-reclamation hidden">
                    <textarea name="details" id="details" class="input textarea textarea-reclamation"
                        required></textarea>
                    <label for="details"> <i class="fa-solid fa-clipboard"></i> &nbsp Details de la réclamation</label>
                </div>
                <input type="submit" value="Envoyer" class="send-demande-btn send-reclamation-btn hidden" />
            </form>
        </div>
    </div>
    <?php endif; ?>
    <div class="overlay hidden"></div>

    <script src="gestEtudiant/GL_project/view/scripts/insert_demande.js"></script>
    <script src="gestEtudiant/GL_project/view/scripts/demande.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>