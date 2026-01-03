document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('reservation-form');
  if (!form) {
    return;
  }

  const submitButton = form.querySelector('button[type="submit"]');
  const defaultButtonText = submitButton ? submitButton.textContent : '';

  const setSubmittingState = (isSubmitting) => {
    if (!submitButton) {
      return;
    }

    if (isSubmitting) {
      submitButton.setAttribute('aria-busy', 'true');
      submitButton.disabled = true;
      submitButton.textContent = 'Guardando reserva...';
    } else {
      submitButton.removeAttribute('aria-busy');
      submitButton.disabled = false;
      submitButton.textContent = defaultButtonText;
    }
  };

  const showAlert = async ({ icon, title, html, confirmButtonText }) => {
    if (!window.Swal) {
      return;
    }

    await window.Swal.fire({
      icon,
      title,
      html,
      confirmButtonText,
      confirmButtonColor: '#F07F1A',
    });
  };

  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    setSubmittingState(true);

    try {
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        body: formData,
      });

      const payload = await response.json();

      if (!response.ok) {
        await showAlert({
          icon: 'error',
          title: 'No pudimos registrar tu reserva',
          html: payload.message || 'Revisa los datos e inténtalo nuevamente.',
          confirmButtonText: 'Entendido',
        });
        return;
      }

      await showAlert({
        icon: 'success',
        title: payload.title || '¡Reserva guardada con éxito!',
        html: payload.message || 'Tu reserva ha sido registrada correctamente.',
        confirmButtonText: payload.confirm_text || 'Continuar',
      });

      if (payload.whatsapp_url) {
        window.location.href = payload.whatsapp_url;
      }

      form.reset();
    } catch (error) {
      await showAlert({
        icon: 'error',
        title: 'Ocurrió un problema',
        html: 'No logramos guardar tu reserva. Por favor intenta nuevamente.',
        confirmButtonText: 'Cerrar',
      });
    } finally {
      setSubmittingState(false);
    }
  });
});
