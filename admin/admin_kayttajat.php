<?php
include 'admin_check.php';
include '../includes/db_connect.php';
include 'includes/header_admin.php';

// Haetaan kaikki käyttäjät tietokannasta
$result = $conn->query("SELECT KayttajaID, Nimi, Gmail, PuhelinNro, Rooli FROM Kayttajat ORDER BY Nimi ASC");
$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>

<div class="main-content">
    <!-- Toast-ilmoitukset onnistumisille ja virheille -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div id="notificationToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex"><div class="toast-body"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex"><div class="toast-body"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div>
            </div>
        <?php endif; ?>
    </div>

    <header class="header">
        <h1>Käyttäjien hallinta</h1>
        <p>Täällä voit lisätä, muokata ja poistaa käyttäjiä.</p>
    </header>

    <div class="content-section">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal" id="addUserBtn">
            + Lisää uusi käyttäjä
        </button>

        <!-- Haetaan käyttäjät taulukoksi -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nimi</th>
                        <th>Sähköposti</th>
                        <th>Puhelinnumero</th>
                        <th>Rooli</th>
                        <th>Toiminnot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['Nimi']); ?></td>
                        <td><?php echo htmlspecialchars($user['Gmail']); ?></td>
                        <td><?php echo htmlspecialchars($user['PuhelinNro']); ?></td>
                        <td><span class="badge <?php echo $user['Rooli'] === 'admin' ? 'bg-success' : 'bg-secondary'; ?>"><?php echo htmlspecialchars($user['Rooli']); ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-user-btn"
                                    data-bs-toggle="modal" data-bs-target="#userModal"
                                    data-id="<?php echo $user['KayttajaID']; ?>"
                                    data-nimi="<?php echo htmlspecialchars($user['Nimi']); ?>"
                                    data-gmail="<?php echo htmlspecialchars($user['Gmail']); ?>"
                                    data-puhelin="<?php echo htmlspecialchars($user['PuhelinNro']); ?>"
                                    data-rooli="<?php echo htmlspecialchars($user['Rooli']); ?>">
                                Muokkaa
                            </button>
                            <button class="btn btn-sm btn-danger delete-user-btn"
                                    data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                    data-id="<?php echo $user['KayttajaID']; ?>"
                                    data-nimi="<?php echo htmlspecialchars($user['Nimi']); ?>">
                                Poista
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Käyttäjän lisäys/muokkaus modaali -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userForm" action="user_actions.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Lisää uusi käyttäjä</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="user_id" id="userId">

                    <div class="mb-3">
                        <label for="nimi" class="form-label">Nimi</label>
                        <input type="text" class="form-control" id="nimi" name="nimi" required>
                    </div>
                    <div class="mb-3">
                        <label for="gmail" class="form-label">Sähköposti</label>
                        <input type="email" class="form-control" id="gmail" name="gmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="puhelin" class="form-label">Puhelinnumero</label>
                        <input type="text" class="form-control" id="puhelin" name="puhelin">
                    </div>
                    <div class="mb-3">
                        <label for="salasana" class="form-label">Salasana</label>
                        <input type="password" class="form-control" id="salasana" name="salasana">
                        <small id="salasanaHelp" class="form-text text-muted">Jätä tyhjäksi, jos et halua muuttaa salasanaa.</small>
                    </div>
                    <div class="mb-3">
                        <label for="rooli" class="form-label">Rooli</label>
                        <select class="form-select" id="rooli" name="rooli" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Peruuta</button>
                    <button type="submit" class="btn btn-primary" id="saveUserBtn">Tallenna</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Käyttäjän poiston vahvistusmodaali -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteUserForm" action="user_actions.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Vahvista poisto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="user_id" id="deleteUserId">
                    <p>Oletko varma, että haluat poistaa käyttäjän <strong id="deleteUserName"></strong>?</p>
                    <p class="text-danger">Tämä toiminto poistaa käyttäjän pysyvästi. Toimintoa ei voi perua.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Peruuta</button>
                    <button type="submit" class="btn btn-danger">Vahvista poisto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../assets/js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
