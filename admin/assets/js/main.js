document.addEventListener('DOMContentLoaded', function() {
    const userModal = document.getElementById('userModal');
    const deleteUserModal = document.getElementById('deleteUserModal');

    // Käyttäjän lisäys/muokkaus modaalin logiikka
    userModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const form = document.getElementById('userForm');
        const modalTitle = userModal.querySelector('.modal-title');
        const saveBtn = userModal.querySelector('#saveUserBtn');
        const salasanaHelp = document.getElementById('salasanaHelp');

        if (button.id === 'addUserBtn') {
            // Lisää uusi käyttäjä
            modalTitle.textContent = 'Lisää uusi käyttäjä';
            form.reset();
            document.getElementById('formAction').value = 'add';
            document.getElementById('userId').value = '';
            document.getElementById('salasana').required = true;
            salasanaHelp.style.display = 'none';
            saveBtn.textContent = 'Tallenna';
        } else {
            // Muokkaa käyttäjää
            modalTitle.textContent = 'Muokkaa käyttäjää';
            saveBtn.textContent = 'Tallenna muutokset';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('salasana').required = false;
            salasanaHelp.style.display = 'block';

            // Täytetään kentät data-attribuuteista
            document.getElementById('userId').value = button.dataset.id;
            document.getElementById('nimi').value = button.dataset.nimi;
            document.getElementById('gmail').value = button.dataset.gmail;
            document.getElementById('puhelin').value = button.dataset.puhelin;
            document.getElementById('rooli').value = button.dataset.rooli;
        }
    });

    // Käyttäjän poiston modaalin logiikka
    deleteUserModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        document.getElementById('deleteUserId').value = button.dataset.id;
        document.getElementById('deleteUserName').textContent = button.dataset.nimi;
    });

    // Näytetään toast-ilmoitukset
    const notificationToastEl = document.getElementById('notificationToast');
    if (notificationToastEl) new bootstrap.Toast(notificationToastEl, { delay: 5000 }).show();
    
    const errorToastEl = document.getElementById('errorToast');
    if (errorToastEl) new bootstrap.Toast(errorToastEl, { delay: 5000 }).show();
});
