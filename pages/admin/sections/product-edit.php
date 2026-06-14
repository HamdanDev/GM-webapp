                <div class="section d-none" id="modifier-produit">
                    <div class="products-page">
                        <div class="stock-header">
                            <div class="d-flex align-items-center gap-3">
                                <div>
                                    <h2 class="mb-1">Modifier un produit</h2>
                                    <p class="subtitle mb-0">Modifiez les informations du produit sélectionné.</p>
                                </div>
                            </div>
                            <button class="add-btn" onclick="showSection('produits')" type="button">
                                <i class="bi bi-arrow-left me-2"></i> Retour
                            </button>
                        </div>
                        <div class="content-card">
                            <form method="post">
                                <input name="product_action" type="hidden" value="update" />
                                <input data-edit-product-id name="ID_Prod" type="hidden" />
                                <div class="row g-4">
                                    <h5 class="form-section-title">Informations produit</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Nom du produit</label>
                                        <input class="form-control" data-edit-product-name name="nom_Prod" required type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Chemin image</label>
                                        <input class="form-control" data-edit-product-image name="Prod_img" placeholder="assets/images/products/produit.png" type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Catégorie</label>
                                        <select class="form-select" data-edit-product-category name="ID_Categ" required>
                                            <?php foreach ($adminCategories as $category): ?>
                                                <option value="<?= (int) $category['ID_Categ'] ?>"><?= e($category['nom_Categ']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Boutique / Producteur</label>
                                        <select class="form-select" data-edit-product-shop name="ID_boutique" required>
                                            <?php foreach ($adminBoutiques as $shop): ?>
                                                <option value="<?= (int) $shop['ID_boutique'] ?>">
                                                    <?= e($shop['nom_boutique'] . ' - ' . $shop['prenom'] . ' ' . $shop['nom']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <h5 class="form-section-title">Stock &amp; Prix</h5>
                                    <div class="col-md-4">
                                        <label class="form-label">Prix</label>
                                        <input class="form-control" data-edit-product-price min="0" name="Prix" required step="0.01" type="number" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Quantité stock</label>
                                        <input class="form-control" data-edit-product-stock min="0" name="Stock" required type="number" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Statut</label>
                                        <div class="form-check form-switch mt-3">
                                            <input class="form-check-input" data-edit-product-active id="editProductActive" name="est_active" type="checkbox" />
                                            <label class="form-check-label" for="editProductActive">Produit actif</label>
                                        </div>
                                    </div>

                                    <h5 class="form-section-title">Description</h5>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" data-edit-product-description name="description" placeholder="Description du produit..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-3 mt-4">
                                            <button class="annul-btn" onclick="showSection('produits')" type="button">
                                                <i class="bi bi-x-circle me-2"></i> Annuler
                                            </button>
                                            <button class="add-btn" type="submit">
                                                <i class="bi bi-check-circle me-2"></i> Sauvegarder
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- voir Produit -->
