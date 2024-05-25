'use strict';

const conventionStageForm = document.querySelector('.conventionStage-form');
const releveNotesForm = document.querySelector('.releveNotes-form');
const attestationScolariteForm = document.querySelector('.attestationScolarite-form');
const attestationReussiteForm = document.querySelector('.attestationReussite-form');
const reclamationForm = document.querySelector('.reclamation-form');
const inputs = document.querySelectorAll('.input');

const submitDemande = function (typeDemande, form) {
  Swal.fire({
    title: 'êtes-vous sûr ?',
    text: 'Vous ne pourrez pas revenir en arrière!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#68C237',
    cancelButtonColor: '#6E7881',
    confirmButtonText: 'Oui',
  }).then(result => {
    if (result.isConfirmed) {
      let xhr = new XMLHttpRequest();
      xhr.open('POST', `/GL_project/model/insert_${typeDemande}.php`, true);
      let formData = new FormData(form);
      xhr.send(formData);
      for (let i = 0; i < inputs.length; i++) inputs[i].value = '';
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'La demande a bien été envoyé',
        showConfirmButton: false,
        timer: 1500,
      });
    }
  });
  return false;
};
