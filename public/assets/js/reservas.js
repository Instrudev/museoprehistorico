document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('reservation-form');
  if (!form) {
    return;
  }

  form.addEventListener('submit', () => {
    const submitButton = form.querySelector('button[type="submit"]');
    if (submitButton) {
      submitButton.setAttribute('aria-busy', 'true');
      submitButton.disabled = true;
    }
  });
});
