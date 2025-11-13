// Lisätään event listener, joka odottaa DOM:n latautumista
document.addEventListener('DOMContentLoaded', function () {

    // Hamburger menu toiminnallisuus pienemmillä näytöillä
    const hamburger = document.getElementById('hamburger-menu');
    const navRight = document.querySelector('.nav-right');

    // Varmistetaan, että elementit ovat olemassa ennen event listenerin lisäämistä
    if (hamburger && navRight) {
        hamburger.addEventListener('click', function () {
            // Vaihdetaan 'active'-luokkaa, joka näyttää tai piilottaa valikon
            navRight.classList.toggle('active');

            // Päivitetään ARIA-attribuutti käyttöä varten
            const isExpanded = navRight.classList.contains('active');
            hamburger.setAttribute('aria-expanded', isExpanded);
        });
    }

    // Flatpickr-kalenterin alustus (index.php) 
    const datePicker = document.getElementById('date-range-picker');

    // Alustetaan kalenteri vain, jos elementti löytyy sivulta
    if (datePicker) {
        flatpickr(datePicker, {
            mode: "range", // Voidaan valita aikaväli
            dateFormat: "Y-m-d", // Päivämäärän muoto
            altInput: true, // Näytetään käyttäjäystävällisempi muoto
            altFormat: "d.m.Y", // Muoto, joka näytetään käyttäjälle

            // Kun käyttäjä valitsee päivämäärät, päivitetään piilotetut kentät
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    document.getElementById("start_date").value = instance.formatDate(selectedDates[0], "Y-m-d");
                    document.getElementById("end_date").value = instance.formatDate(selectedDates[1], "Y-m-d");
                }
            }
        });
    }

    // Varauksen vahvistusmodaalin toiminnallisuus (index.php)
    const reservationModal = document.getElementById('reservationModal'); // Haetaan modal tietdot
    if (reservationModal) {
        reservationModal.addEventListener('show.bs.modal', function (event) {
            // Nappi, joka käynnisti modaalin
            const button = event.relatedTarget;

            // Haetaan data-attribuutit napilta eli valitun huoneen tiedot
            const roomId = button.getAttribute('data-room-id');
            const roomName = button.getAttribute('data-room-name');
            const startDate = button.getAttribute('data-start-date');
            const endDate = button.getAttribute('data-end-date');

            // Haetaan modaalin elementit
            const modalRoomName = reservationModal.querySelector('#modal-room-name');
            const modalDateRange = reservationModal.querySelector('#modal-date-range');
            const modalRoomIdInput = reservationModal.querySelector('#modal-room-id');
            const modalStartDateInput = reservationModal.querySelector('#modal-start-date');
            const modalEndDateInput = reservationModal.querySelector('#modal-end-date');

            // Asetetaan tiedot modaaliin
            modalRoomName.textContent = roomName;
            modalDateRange.textContent = `${startDate} - ${endDate}`;
            modalRoomIdInput.value = roomId;
            modalStartDateInput.value = startDate;
            modalEndDateInput.value = endDate;
        });
    }

    // Varauksen poiston vahvistusmodaalin toiminnallisuus (reservations.php)
    const deleteReservationModal = document.getElementById('deleteReservationModal');
    if (deleteReservationModal) {
        deleteReservationModal.addEventListener('show.bs.modal', function (event) {
            // Nappi, joka käynnisti modaalin
            const button = event.relatedTarget;

            // Haetaan data-attribuutit napilta
            const reservationId = button.getAttribute('data-reservation-id');
            const roomName = button.getAttribute('data-room-name');
            const dateRange = button.getAttribute('data-date-range');

            // Haetaan modaalin elementit
            const modalRoomName = deleteReservationModal.querySelector('#modal-delete-room-name');
            const modalDateRange = deleteReservationModal.querySelector('#modal-delete-date-range');
            const modalReservationIdInput = deleteReservationModal.querySelector('#modal-delete-reservation-id');

            // Asetetaan tiedot modaaliin
            if (modalRoomName) modalRoomName.textContent = roomName;
            if (modalDateRange) modalDateRange.textContent = dateRange;
            if (modalReservationIdInput) modalReservationIdInput.value = reservationId;
        });
    }

    // "Näytä lisää" -napin toiminnallisuus (index.php)
    const showMoreBtn = document.getElementById('show-more-btn');
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            // Haetaan kaikki piilotetut huone-elementit
            const hiddenRooms = document.querySelectorAll('.room-item.room-hidden');
            
            // Poistetaan piilotusluokka jokaiselta elementiltä
            hiddenRooms.forEach(room => room.classList.remove('room-hidden'));

            // Piilotetaan "Näytä lisää" -nappi, kun kaikki on näytetty
            showMoreBtn.style.display = 'none';
        });
    }

    // Toast-ilmoituksen näyttäminen (reservations.php)
    const notificationToastEl = document.getElementById('notificationToast');
    if (notificationToastEl) {
        // Luodaan Bootstrap Toast -instanssi
        const notificationToast = new bootstrap.Toast(notificationToastEl, {
            delay: 7000 // Ilmoitus piilotetaan 7 sekunnin kuluttua
        });
        notificationToast.show(); // Näytetään ilmoitus
    }
});