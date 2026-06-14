                <div class="section d-none" id="profil">
                    <h4 class="mb-4">Mon Profil</h4>
                    <div class="content-card">
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label small fw-bold">Nom</label><input class="form-control" type="text" value="<?php echo e($profileUser['nom'] ?? ''); ?>" /></div>
                            <div class="col-md-6"><label class="form-label small fw-bold">Prénom</label><input class="form-control" type="text" value="<?php echo e($profileUser['prenom'] ?? ''); ?>" /></div>
                            <div class="col-md-6"><label class="form-label small fw-bold">Email</label><input class="form-control" type="email" value="<?php echo e($profileUser['email'] ?? ''); ?>" /></div>
                            <div class="col-md-6"><label class="form-label small fw-bold">Téléphone</label><input class="form-control" type="tel" value="<?php echo e($profileUser['telephone'] ?? ''); ?>" /></div>
                            <div class="col-12"><label class="form-label small fw-bold">Adresse</label><input class="form-control" type="text" value="<?php echo e($profileUser['adresse'] ?? ''); ?>" /></div>
                            <div class="col-12"><hr /><h6 class="fw-bold mb-3">Changer mot de passe</h6></div>
                            <div class="col-md-4"><label class="form-label small fw-bold">Ancien</label><input class="form-control" placeholder="••••••" type="password" /></div>
                            <div class="col-md-4"><label class="form-label small fw-bold">Nouveau</label><input class="form-control" placeholder="••••••" type="password" /></div>
                            <div class="col-md-4"><label class="form-label small fw-bold">Confirmer</label><input class="form-control" placeholder="••••••" type="password" /></div>
                            <div class="col-12"><button class="btn text-white btn-save">Sauvegarder</button></div>
                        </div>
                    </div>
                </div>
