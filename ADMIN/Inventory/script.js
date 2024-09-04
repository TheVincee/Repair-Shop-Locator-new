function openModal(action, id) {
  const modal = document.getElementById('modal');
  const modalTitle = document.getElementById('modal-title');
  const modalMessage = document.getElementById('modal-message');
  const modalForm = document.getElementById('modal-form');
  const modalBack = document.getElementById('modal-back');
  const modalConfirm = document.getElementById('modal-confirm');

  modalTitle.textContent = `${action} Part`;
  if (action === 'Add') {
      modalMessage.style.display = 'none';
      modalForm.style.display = 'block';
      modalBack.style.display = 'none';
      modalConfirm.textContent = 'Add';
  } else if (action === 'Edit') {
      modalMessage.textContent = `Editing Part ID ${id}`;
      modalMessage.style.display = 'block';
      modalForm.style.display = 'none';
      modalBack.style.display = 'block';
      modalConfirm.textContent = 'Save';
  } else if (action === 'Delete') {
      modalMessage.textContent = `Are you sure you want to delete Part ID ${id}?`;
      modalMessage.style.display = 'block';
      modalForm.style.display = 'none';
      modalBack.style.display = 'none';
      modalConfirm.textContent = 'Delete';
  } else if (action === 'View') {
      modalMessage.textContent = `Viewing details for Part ID ${id}`;
      modalMessage.style.display = 'block';
      modalForm.style.display = 'none';
      modalBack.style.display = 'block';
      modalConfirm.style.display = 'none';
  }

  modal.style.display = 'block';
}

function closeModal() {
  document.getElementById('modal').style.display = 'none';
}

function goBack() {
  const modalBack = document.getElementById('modal-back');
  modalBack.style.display = 'none'; // Hide Back button
  const modalConfirm = document.getElementById('modal-confirm');
  modalConfirm.style.display = 'block'; // Show Confirm button
  document.getElementById('modal-message').style.display = 'block';
  document.getElementById('modal-form').style.display = 'none';
}
