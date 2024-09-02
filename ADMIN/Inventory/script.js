function openModal(modalId) {
  document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

function saveUpdates() {
  // Save logic here
  closeModal('update-modal');
}

function confirmDelete() {
  // Delete logic here
  closeModal('delete-modal');
}
