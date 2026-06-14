<?php
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../includes/view_helpers.php';

$adminUserMessage = null;
$adminUserError = null;
$allowedUserRoles = ['client', 'producteur', 'admin'];
$currentAdmin = current_user();
$currentAdminId = (int) ($currentAdmin['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_action'])) {
    $userAction = $_POST['user_action'];
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $role = $_POST['role'] ?? 'client';
    $estActive = isset($_POST['est_active']) ? 1 : 0;

    try {
        if ($userAction === 'create') {
            $password = (string) ($_POST['mot_de_passe'] ?? '');

            if ($nom === '' || $prenom === '' || $email === '' || $password === '') {
                throw new RuntimeException('Nom, prénom, email et mot de passe sont obligatoires.');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new RuntimeException('Adresse email invalide.');
            }

            if (!in_array($role, $allowedUserRoles, true)) {
                throw new RuntimeException('Rôle invalide.');
            }

            $stmt = $pdo->prepare(
                'INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role, telephone, adresse, est_active)
                 VALUES (:nom, :prenom, :email, :mot_de_passe, :role, :telephone, :adresse, :est_active)'
            );
            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role,
                'telephone' => $telephone !== '' ? $telephone : null,
                'adresse' => $adresse !== '' ? $adresse : null,
                'est_active' => $estActive,
            ]);

            $adminUserMessage = 'Utilisateur ajouté avec succès.';
        }

        if ($userAction === 'update') {
            $userId = (int) ($_POST['ID_utili'] ?? 0);
            $password = trim((string) ($_POST['mot_de_passe'] ?? ''));

            if ($userId <= 0 || $nom === '' || $prenom === '' || $email === '') {
                throw new RuntimeException('Les informations principales sont obligatoires.');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new RuntimeException('Adresse email invalide.');
            }

            if (!in_array($role, $allowedUserRoles, true)) {
                throw new RuntimeException('Rôle invalide.');
            }

            // Keep the current admin active and admin to avoid locking yourself out.
            if ($userId === $currentAdminId) {
                $role = 'admin';
                $estActive = 1;
            }

            $params = [
                'ID_utili' => $userId,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'role' => $role,
                'telephone' => $telephone !== '' ? $telephone : null,
                'adresse' => $adresse !== '' ? $adresse : null,
                'est_active' => $estActive,
            ];

            $passwordSql = '';
            if ($password !== '') {
                $passwordSql = ', mot_de_passe = :mot_de_passe';
                $params['mot_de_passe'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $stmt = $pdo->prepare(
                "UPDATE utilisateur
                 SET nom = :nom, prenom = :prenom, email = :email, role = :role,
                     telephone = :telephone, adresse = :adresse, est_active = :est_active {$passwordSql}
                 WHERE ID_utili = :ID_utili"
            );
            $stmt->execute($params);

            $adminUserMessage = 'Utilisateur modifié avec succès.';
        }

        if ($userAction === 'delete') {
            $userId = (int) ($_POST['ID_utili'] ?? 0);

            if ($userId <= 0) {
                throw new RuntimeException('Utilisateur introuvable.');
            }

            if ($userId === $currentAdminId) {
                throw new RuntimeException('Vous ne pouvez pas supprimer votre propre compte admin.');
            }

            $stmt = $pdo->prepare('DELETE FROM utilisateur WHERE ID_utili = :ID_utili');
            $stmt->execute(['ID_utili' => $userId]);

            $adminUserMessage = 'Utilisateur supprimé avec succès.';
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            if ($userAction === 'delete') {
                $adminUserError = 'Impossible de supprimer cet utilisateur: il est lié à des commandes, produits ou avis.';
            } else {
                $adminUserError = 'Cette adresse email est déjà utilisée.';
            }
        } else {
            $adminUserError = 'Erreur base de données: ' . $e->getMessage();
        }
    } catch (RuntimeException $e) {
        $adminUserError = $e->getMessage();
    }
}

// Load fresh values after any create/update/delete operation.
$users = $pdo->query(
    'SELECT ID_utili, nom, prenom, email, role, telephone, adresse, est_active, created_at
     FROM utilisateur
     ORDER BY created_at DESC, ID_utili DESC'
)->fetchAll();

$userStats = $pdo->query(
    "SELECT
        COUNT(*) AS total_users,
        SUM(CASE WHEN est_active = 1 THEN 1 ELSE 0 END) AS active_users,
        SUM(CASE WHEN est_active = 0 THEN 1 ELSE 0 END) AS suspended_users,
        SUM(CASE WHEN role = 'producteur' THEN 1 ELSE 0 END) AS producer_users
     FROM utilisateur"
)->fetch();

function admin_user_role_label(string $role): string {
    return [
        'admin' => 'Admin',
        'producteur' => 'Producteur',
        'client' => 'Client',
    ][$role] ?? ucfirst($role);
}
?>

                <div class="section d-none" id="Comptes">
                    <?php if ($adminUserMessage): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= e($adminUserMessage) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($adminUserError): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= e($adminUserError) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-3 mb-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-people-fill"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total utilisateurs</p>
                                    <h2 class="fw-bold"><?= (int) $userStats['total_users'] ?></h2>
                                    <p class="growth">Tous <span>les comptes</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-person-check-fill"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Comptes actifs</p>
                                    <h2 class="fw-bold"><?= (int) $userStats['active_users'] ?></h2>
                                    <p class="growth">Disponibles <span>maintenant</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-person-x-fill"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Suspendus</p>
                                    <h2 class="fw-bold"><?= (int) $userStats['suspended_users'] ?></h2>
                                    <p class="growth">À revoir <span>par admin</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-shop"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Producteurs</p>
                                    <h2 class="fw-bold"><?= (int) $userStats['producer_users'] ?></h2>
                                    <p class="growth">Vendeurs <span>inscrits</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>
                                    Utilisateurs
                                    <span class="product-count">(<?= count($users) ?>)</span>
                                </h2>
                                <p class="subtitle">Gérez les utilisateurs et les comptes de la plateforme.</p>
                            </div>
                            <div class="header-actions">
                                <a class="btn-link" data-section="ajouter-utilisateur" href="#">
                                    <button class="add-btn" type="button">
                                        <i class="bi bi-person-plus me-2"></i>
                                        Ajouter utilisateur
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input data-user-search placeholder="Rechercher un utilisateur..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select data-user-role-filter>
                                    <option value="">Tous les utilisateurs</option>
                                    <option value="client">Client</option>
                                    <option value="producteur">Producteur</option>
                                    <option value="admin">Admin</option>
                                    <option value="suspendu">Suspendus</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Téléphone</th>
                                        <th>Statut</th>
                                        <th>Date inscription</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <?php
                                        $userId = (int) $user['ID_utili'];
                                        $fullName = trim($user['prenom'] . ' ' . $user['nom']);
                                        $statusClass = (int) $user['est_active'] === 1 ? 'stock ok' : 'stock low';
                                        $statusLabel = (int) $user['est_active'] === 1 ? 'Actif' : 'Suspendu';
                                        ?>
                                        <tr
                                            data-user-row
                                            data-user-search-value="<?= e(strtolower($fullName . ' ' . $user['email'])) ?>"
                                            data-user-role-value="<?= e($user['role']) ?>"
                                            data-user-status-value="<?= (int) $user['est_active'] === 1 ? 'actif' : 'suspendu' ?>"
                                        >
                                            <td>
                                                <div class="product-info">
                                                    <div>
                                                        <h6><?= e($fullName) ?></h6>
                                                        <small>#USR-<?= str_pad((string) $userId, 3, '0', STR_PAD_LEFT) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= e($user['email']) ?></td>
                                            <td><?= e(admin_user_role_label($user['role'])) ?></td>
                                            <td><?= e($user['telephone'] ?: '-') ?></td>
                                            <td><span class="<?= e($statusClass) ?>"><?= e($statusLabel) ?></span></td>
                                            <td><?= e(format_date_fr($user['created_at'])) ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button
                                                        class="icon-btn edit-btn"
                                                        data-user-edit
                                                        data-id="<?= $userId ?>"
                                                        data-nom="<?= e($user['nom']) ?>"
                                                        data-prenom="<?= e($user['prenom']) ?>"
                                                        data-email="<?= e($user['email']) ?>"
                                                        data-telephone="<?= e($user['telephone']) ?>"
                                                        data-adresse="<?= e($user['adresse']) ?>"
                                                        data-role="<?= e($user['role']) ?>"
                                                        data-active="<?= (int) $user['est_active'] ?>"
                                                        title="Modifier"
                                                        type="button"
                                                    >
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button
                                                        class="icon-btn remove-btn"
                                                        data-bs-target="#deleteUserModal"
                                                        data-bs-toggle="modal"
                                                        data-user-delete
                                                        data-id="<?= $userId ?>"
                                                        data-name="<?= e($fullName) ?>"
                                                        <?= $userId === $currentAdminId ? 'disabled' : '' ?>
                                                        title="Supprimer"
                                                        type="button"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="deleteUserModalLabel" class="modal fade" id="deleteUserModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post">
                                <input name="user_action" type="hidden" value="delete" />
                                <input data-delete-user-id name="ID_utili" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserModalLabel">Supprimer utilisateur</h5>
                                    <button aria-label="Fermer" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer <strong data-delete-user-name></strong> ?
                                    <p class="text-muted small mb-0 mt-2">
                                        Si cet utilisateur possède des commandes, produits ou avis, la suppression sera bloquée par la base de données.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="annul-btn" data-bs-dismiss="modal" type="button">Annuler</button>
                                    <button class="add-btn modal-delete-btn" type="submit">
                                        <i class="bi bi-trash me-2"></i> Supprimer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section d-none" id="ajouter-utilisateur">
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2 class="mb-1">Ajouter un utilisateur</h2>
                                <p class="subtitle mb-0">Créez un nouveau compte pour un client, producteur ou admin.</p>
                            </div>
                            <button class="add-btn" onclick="showSection('Comptes')" type="button">
                                <i class="bi bi-arrow-left me-2"></i> Retour
                            </button>
                        </div>
                        <div class="content-card">
                            <form method="post">
                                <input name="user_action" type="hidden" value="create" />
                                <div class="row g-4">
                                    <h5 class="form-section-title">Informations utilisateur</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Prénom</label>
                                        <input class="form-control" name="prenom" placeholder="Prénom" required type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nom</label>
                                        <input class="form-control" name="nom" placeholder="Nom" required type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" name="email" placeholder="email@example.com" required type="email" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mot de passe</label>
                                        <input class="form-control" name="mot_de_passe" placeholder="Mot de passe" required type="password" />
                                    </div>

                                    <h5 class="form-section-title">Rôle & statut</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Rôle</label>
                                        <select class="form-select" name="role" required>
                                            <option value="client">Client</option>
                                            <option value="producteur">Producteur</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Statut</label>
                                        <div class="form-check form-switch mt-3">
                                            <input checked class="form-check-input" id="addUserActive" name="est_active" type="checkbox" />
                                            <label class="form-check-label" for="addUserActive">Compte actif</label>
                                        </div>
                                    </div>

                                    <h5 class="form-section-title">Contact</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Téléphone</label>
                                        <input class="form-control" name="telephone" placeholder="+212..." type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Adresse</label>
                                        <input class="form-control" name="adresse" placeholder="Ville, adresse..." type="text" />
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-3 mt-4">
                                            <button class="annul-btn" type="reset">
                                                <i class="bi bi-x-circle me-2"></i> Annuler
                                            </button>
                                            <button class="add-btn" type="submit">
                                                <i class="bi bi-check-circle me-2"></i> Ajouter utilisateur
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section d-none" id="modifier-utilisateur">
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2 class="mb-1">Modifier utilisateur</h2>
                                <p class="subtitle mb-0">Mettez à jour les informations du compte sélectionné.</p>
                            </div>
                            <button class="add-btn" onclick="showSection('Comptes')" type="button">
                                <i class="bi bi-arrow-left me-2"></i> Retour
                            </button>
                        </div>
                        <div class="content-card">
                            <form method="post">
                                <input name="user_action" type="hidden" value="update" />
                                <input data-edit-user-id name="ID_utili" type="hidden" />
                                <div class="row g-4">
                                    <h5 class="form-section-title">Informations utilisateur</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Prénom</label>
                                        <input class="form-control" data-edit-user-prenom name="prenom" required type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nom</label>
                                        <input class="form-control" data-edit-user-nom name="nom" required type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" data-edit-user-email name="email" required type="email" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nouveau mot de passe</label>
                                        <input class="form-control" name="mot_de_passe" placeholder="Laisser vide pour garder l'actuel" type="password" />
                                    </div>

                                    <h5 class="form-section-title">Rôle & statut</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Rôle</label>
                                        <select class="form-select" data-edit-user-role name="role" required>
                                            <option value="client">Client</option>
                                            <option value="producteur">Producteur</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Statut</label>
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" data-edit-user-active id="editUserActive" name="est_active" type="checkbox" />
                                            <label class="form-check-label" for="editUserActive">Compte actif</label>
                                        </div>
                                    </div>

                                    <h5 class="form-section-title">Contact</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Téléphone</label>
                                        <input class="form-control" data-edit-user-telephone name="telephone" type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Adresse</label>
                                        <input class="form-control" data-edit-user-adresse name="adresse" type="text" />
                                    </div>

                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-3 mt-4">
                                            <button class="annul-btn" onclick="showSection('Comptes')" type="button">
                                                <i class="bi bi-x-circle me-2"></i> Annuler
                                            </button>
                                            <button class="add-btn" type="submit">
                                                <i class="bi bi-check-circle me-2"></i> Enregistrer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if ($adminUserMessage || $adminUserError): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if (typeof showSection === 'function') {
                                showSection('Comptes');
                            }
                        });
                    </script>
                <?php endif; ?>
