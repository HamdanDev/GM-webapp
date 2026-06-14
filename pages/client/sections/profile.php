                <div class="section d-none" id="profil">
                    <h4 class="mb-4">Mon Profil</h4>

                    <?php if ($profileMessage): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e($profileMessage); ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($profileError): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo e($profileError); ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <div class="content-card">
                        <form method="post">
                            <input name="profile_action" type="hidden" value="update_profile" />
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Nom</label>
                                    <input class="form-control" name="nom" required type="text" value="<?php echo e($profileUser['nom'] ?? ''); ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Prénom</label>
                                    <input class="form-control" name="prenom" required type="text" value="<?php echo e($profileUser['prenom'] ?? ''); ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email</label>
                                    <input class="form-control" name="email" required type="email" value="<?php echo e($profileUser['email'] ?? ''); ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Téléphone</label>
                                    <input class="form-control" name="telephone" type="tel" value="<?php echo e($profileUser['telephone'] ?? ''); ?>" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Adresse</label>
                                    <input class="form-control" name="adresse" type="text" value="<?php echo e($profileUser['adresse'] ?? ''); ?>" />
                                </div>

                                <div class="col-12">
                                    <hr />
                                    <h6 class="fw-bold mb-3">Changer mot de passe</h6>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Ancien</label>
                                    <input autocomplete="current-password" class="form-control" name="old_password" placeholder="Laisser vide si inchangé" type="password" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Nouveau</label>
                                    <input autocomplete="new-password" class="form-control" name="new_password" placeholder="Minimum 6 caractères" type="password" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Confirmer</label>
                                    <input autocomplete="new-password" class="form-control" name="confirm_password" placeholder="Confirmer" type="password" />
                                </div>

                                <div class="col-12">
                                    <button class="btn text-white btn-save" type="submit">
                                        <i class="bi bi-check-circle me-2"></i>Sauvegarder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if ($profileMessage || $profileError): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const profileLink = document.querySelector('.sidebar-link[data-section="profil"]');
                            const profileSection = document.getElementById('profil');

                            document.querySelectorAll('.section').forEach(function(section) {
                                section.classList.add('d-none');
                            });

                            document.querySelectorAll('.sidebar-link').forEach(function(link) {
                                link.classList.remove('active');
                            });

                            if (profileSection) {
                                profileSection.classList.remove('d-none');
                            }

                            if (profileLink) {
                                profileLink.classList.add('active');
                            }
                        });
                    </script>
                <?php endif; ?>
