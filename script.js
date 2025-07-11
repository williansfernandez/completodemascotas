document.querySelectorAll('.toggle-password').forEach(toggle => {
  toggle.style.cursor = 'pointer';
  toggle.addEventListener('click', () => {
    const input = toggle.closest('.input-box').querySelector('input');
    const icon  = toggle.querySelector('ion-icon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.setAttribute('name', 'lock-open-outline');
    } else {
      input.type = 'password';
      icon.setAttribute('name', 'lock-closed');
    }
  });
});


const emailBox = document.querySelector('.input-box input[type="email"]');
const emailIcon = emailBox.closest('.input-box').querySelector('ion-icon[name^="mail"]');

emailBox.addEventListener('input', () => {
  const val = emailBox.value.trim();
  const isGmail = /@gmail\.com$/i.test(val);
  
  if (isGmail) {
    emailIcon.setAttribute('name', 'mail-open-outline');
  } else {
    emailIcon.setAttribute('name', 'mail');
  }
});