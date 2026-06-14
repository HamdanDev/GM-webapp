                <div class="section d-none" id="voir-commande">
                    <div class="products-page">
                        <!-- HEADER -->
                        <div class="stock-header">
                            <div class="d-flex align-items-center gap-3">
                                <div>
                                    <h2 class="mb-1">Détails de la commande</h2>
                                    <p class="subtitle mb-0">Consultez toutes les informations de la commande.</p>
                                </div>
                            </div>
                            <button class="add-btn" onclick="showSection('commandes')" type="button">
                                <i class="bi bi-arrow-left me-2"></i> Retour
                            </button>
                        </div>
                        <!-- CONTENT -->
                        <div class="content-card">
                            <div class="row g-4">
                                <!-- LEFT -->
                                <div class="col-lg-8">
                                    <!-- COMMANDE INFO -->
                                    <div class="view-description mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h4 class="fw-bold mb-1">Commande #CMD-1524</h4>
                                                <p class="text-muted mb-0">Passée le 15 Mai 2026</p>
                                            </div>
                                            <span class="stock ok">Livrée</span>
                                        </div>
                                        <!-- TABLE -->
                                        <div class="table-responsive mt-4">
                                            <table class="product-table">
                                                <thead>
                                                    <tr>
                                                        <th>Produit</th>
                                                        <th>Prix</th>
                                                        <th>Quantité</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="product-info">
                                                                <img alt="" src="../assets/images/product-details/savonBeldi/savonBeldiNila.jpeg" />
                                                                <div>
                                                                    <h6>Savon Beldi</h6>
                                                                    <small>#PRD-001</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>120 DH</td>
                                                        <td>2</td>
                                                        <td>240 DH</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="product-info">
                                                                <img alt="" src="../assets/images/product-details/arganOil/huileArganBio.png" />
                                                                <div>
                                                                    <h6>Huile d'Argan</h6>
                                                                    <small>#PRD-221</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>250 DH</td>
                                                        <td>1</td>
                                                        <td>250 DH</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- LIVRAISON -->
                                    <div class="livraison-section">
                                        <h5 class="form-section-title">Informations de livraison</h5>
                                        <div class="delivery-grid">
                                            <div class="delivery-card">
                                                <div class="delivery-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                                <div class="delivery-info">
                                                    <small>Adresse</small>
                                                    <h6>Marrakech, Maroc</h6>
                                                </div>
                                            </div>
                                            <div class="delivery-card">
                                                <div class="delivery-icon"><i class="bi bi-telephone-fill"></i></div>
                                                <div class="delivery-info">
                                                    <small>Téléphone</small>
                                                    <h6>+212 6 12 34 56 78</h6>
                                                </div>
                                            </div>
                                            <div class="delivery-card">
                                                <div class="delivery-icon"><i class="bi bi-envelope-fill"></i></div>
                                                <div class="delivery-info">
                                                    <small>Email</small>
                                                    <h6>sara@gmail.com</h6>
                                                </div>
                                            </div>
                                            <div class="delivery-card">
                                                <div class="delivery-icon"><i class="bi bi-calendar-check-fill"></i></div>
                                                <div class="delivery-info">
                                                    <small>Date de livraison</small>
                                                    <h6>16 Mai 2026</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- TIMELINE -->
                                        <div class="order-timeline mt-4">
                                            <div class="timeline-item done"><i class="bi bi-check-circle-fill"></i> Commande confirmée</div>
                                            <div class="timeline-item done"><i class="bi bi-box-seam"></i> Préparation</div>
                                            <div class="timeline-item done"><i class="bi bi-truck"></i> Expédiée</div>
                                            <div class="timeline-item active"><i class="bi bi-house-check-fill"></i> Livrée</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- RIGHT -->
                                <div class="col-lg-4">
                                    <!-- CLIENT -->
                                    <div class="view-box mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar">S</div>
                                            <div>
                                                <h6 class="fw-bold mb-1">Sara Alaoui</h6>
                                                <small class="text-muted">sara@gmail.com</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- PAYMENT -->
                                    <div class="view-box mb-4">
                                        <h5 class="form-section-title mb-3">Paiement</h5>
                                        <div class="mb-3">
                                            <small>Méthode</small>
                                            <h6>Visa</h6>
                                        </div>
                                        <div class="mb-3">
                                            <small>Statut</small>
                                            <h6 class="text-success">Payé</h6>
                                        </div>
                                        <div>
                                            <small>Total commande</small>
                                            <h4 class="fw-bold">490 DH</h4>
                                        </div>
                                    </div>
                                    <!-- ACTIONS -->
                                    <div class="d-grid gap-3">
                                        <button class="add-btn"><i class="bi bi-printer me-2"></i> Imprimer facture</button>
                                        <button class="annul-btn"><i class="bi bi-x-circle me-2"></i> Annuler commande</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MON PROFIL -->
