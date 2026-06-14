            <div class="col-12 col-md-3">
                <div class="profile-sidebar p-3">
                    <div class="text-center mb-4">
                        <div class="avatar mx-auto mb-2"><?php echo e(substr($profileUser['prenom'] ?? 'C', 0, 1)); ?></div>
                        <h6 class="fw-bold mb-0"><?php echo e(($profileUser['prenom'] ?? '') . ' ' . ($profileUser['nom'] ?? '')); ?></h6>
                        <small class="text-muted"><?php echo e(ucfirst($profileUser['role'] ?? 'client')); ?></small>
                    </div>
                    <hr />
                    <div class="d-flex flex-column gap-1">
                        <button class="sidebar-link active" data-section="dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard</button>
                        <button class="sidebar-link" data-section="profil"><i class="bi bi-person me-2"></i>Mon Profil</button>
                        <button class="sidebar-link" data-section="commandes"><i class="bi bi-bag me-2"></i>Mes Commandes</button>
                        <button class="sidebar-link" data-section="avis"><i class="bi bi-star me-2"></i>Mes Avis</button>
                        <button class="sidebar-link" data-section="favoris"><i class="bi bi-heart me-2"></i>Mes Favoris</button>
                    </div>
                    <hr />
                    <a class="log-out text-danger" href="../actions/logout.php">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </a>
                </div>
            </div>
