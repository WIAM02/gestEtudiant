'use strict';

const formContainers = document.querySelectorAll('.form-container');
const releveNotesBtn = document.querySelector('.send-releve-notes-btn');
const attestationScolariteBtn = document.querySelector('.send-attestation-scolarite-btn');
const attestationReussiteBtn = document.querySelector('.send-attestation-reussite-btn');
const reclamationBtn = document.querySelector('.send-reclamation-btn');
const inputBox1 = document.querySelector('.input-box-1');
const inputBox2 = document.querySelector('.input-box-2');
const inputBox3 = document.querySelector('.input-box-3');
const inputBox4 = document.querySelector('.input-box-4');
const radios1 = document.querySelectorAll('.radio-1');
const radios2 = document.querySelectorAll('.radio-2');
const radios3 = document.querySelectorAll('.radio-3');
const radios4 = document.querySelectorAll('.radio-4');
const listReclamation = document.querySelector('.list-reclamation');
const inputDivReclamation = document.querySelector('.input-div-reclamation');
const overlay = document.querySelector('.overlay');
const lists = document.querySelectorAll('.list');
const inputBoxes = document.querySelectorAll('.input-box');
const inputsIntro = document.querySelectorAll('.input-intro');
const navbar = document.querySelector('.navbar');
const navlinks = document.querySelectorAll('.nav-link');
const navItems = document.querySelectorAll('.nav-item');

function Scroll(formId) {
  const form = document.getElementById(`${formId}Form`);
  const coords = form.getBoundingClientRect();
  window.scrollTo({
    left: coords.left + window.pageXOffset,
    top: coords.top + window.pageYOffset - navbar.offsetHeight,
    behavior: 'smooth',
  });
}

inputsIntro.forEach(input => {
  if (input.value != '') input.parentNode.parentNode.classList.add('focus');
});

function focusFunc() {
  let parent = this.parentNode.parentNode;
  parent.classList.add('focus');
}

function blurFunc() {
  let parent = this.parentNode.parentNode;
  if (this.value == '') parent.classList.remove('focus');
}

inputsIntro.forEach(input => {
  input.addEventListener('focus', focusFunc);
  input.addEventListener('blur', blurFunc);
});

function showForm(formId) {
  formContainers.forEach(form => {
    form.classList.remove('active');
  });
  document.getElementById(`${formId}Form`).classList.add('active');
}

const openDropdown = function () {
  overlay.classList.toggle('hidden');
  this.classList.toggle('open');
  let list = this.nextElementSibling;
  if (list.style.maxHeight) {
    list.style.maxHeight = null;
    list.style.boxShadow = null;
  } else {
    list.style.maxHeight = '250px';
    list.style.boxShadow = '0 1px 2px 0 rgba(0, 0, 0, 0.15),0 1px 3px 1px rgba(0, 0, 0, 0.1)';
  }
};

const selectElementInDropdown = function (e, item, inputBox, sendBtn) {
  inputBox.innerHTML = item.nextElementSibling.innerHTML;
  inputBox.click();
  inputBox.classList.add('selected');
  sendBtn.classList.remove('hidden');
};

inputBox1.onclick = openDropdown;
inputBox2.onclick = openDropdown;
inputBox3.onclick = openDropdown;
inputBox4.onclick = openDropdown;

radios1.forEach(item => {
  item.addEventListener('change', e => selectElementInDropdown(e, item, inputBox1, releveNotesBtn));
});

radios2.forEach(item => {
  item.addEventListener('change', e =>
    selectElementInDropdown(e, item, inputBox2, attestationScolariteBtn)
  );
});

radios3.forEach(item => {
  item.addEventListener('change', e =>
    selectElementInDropdown(e, item, inputBox3, attestationReussiteBtn)
  );
});

radios4.forEach(item => {
  item.addEventListener('change', () => {
    inputBox4.innerHTML = item.nextElementSibling.innerHTML;
    inputBox4.click();
    reclamationBtn.classList.remove('hidden');
    inputDivReclamation.classList.remove('hidden');
    inputBox4.classList.add('selected');
  });
});

overlay.addEventListener('click', function () {
  overlay.classList.toggle('hidden');
  inputBoxes.forEach(inputbox => inputbox.classList.remove('open'));
  lists.forEach(list => {
    list.style.maxHeight = null;
    list.style.boxShadow = null;
  });
});

navItems.forEach(navItem =>
  navItem.addEventListener('click', function () {
    overlay.classList.add('hidden');
    inputBoxes.forEach(inputbox => inputbox.classList.remove('open'));
    lists.forEach(list => {
      list.style.maxHeight = null;
      list.style.boxShadow = null;
    });
  })
);
