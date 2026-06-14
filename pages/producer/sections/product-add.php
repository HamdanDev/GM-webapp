                <div class="section d-none" id="ajouter-produit">
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2 class="mb-1">Ajouter un produit</h2>
                                <p class="subtitle mb-0">Ajoutez facilement un nouveau produit.</p>
                            </div>
                            <button class="add-btn" data-section="produits" type="button">
                                <i class="bi bi-arrow-left me-2"></i>Retour
                            </button>
                        </div>
                        <div class="content-card">
                            <form>
                                <div class="row g-4">
                                    <h5 class="form-section-title">Informations produit</h5>
                                    <div class="col-12">
                                        <label class="form-label">Images du produit</label>
                                        <div class="upload-box text-center">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                            <h5 class="mt-3">Glissez vos images ici</h5>
                                            <p>ou cliquez pour sélectionner</p>
                                            <input hidden="" multiple="" type="file" />
                                        </div>
                                        <div class="preview-images mt-3">
                                            <img src="../assets/images/product-details/savonBeldi/savonBeldiNila.jpeg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nom du produit</label>
                                        <input class="form-control" name="nom_prod" placeholder="Nom du produit" type="text" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Catégorie</label>
                                        <select class="form-select" name="categorie">
                                            <option>Choisir catégorie</option>
                                            <option>Cosmétiques</option>
                                            <option>Produits Bio</option>
                                            <option>Artisanat</option>
                                            <option>Mode Traditionnelle</option>
                                        </select>
                                    </div>
                                    <h5 class="form-section-title">Stock &amp; Prix</h5>
                                    <div class="col-md-4">
                                        <label class="form-label">Prix (MAD)</label>
                                        <input class="form-control" name="prix" placeholder="0.00" type="number" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Quantité stock</label>
                                        <input class="form-control" name="stock" placeholder="0" type="number" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">ID Produit</label>
                                        <input class="form-control" disabled="" type="text" value="#PRD-001" />
                                    </div>
                                    <h5 class="form-section-title">Description</h5>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" placeholder="Description du produit..."></textarea>
                                    </div>
                                    <h5 class="form-section-title">Publication</h5>
                                    <div class="col-md-6">
                                        <label class="form-label">Statut</label>
                                        <input class="form-control" disabled="" type="text" value="En attente" />
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-3 mt-4">
                                            <button class="annul-btn" type="reset"><i class="bi bi-x-circle me-2"></i>Annuler</button>
                                            <button class="add-btn" type="submit"><i class="bi bi-check-circle me-2"></i>Ajouter produit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- MODIFIER PRODUIT -->
