                <div class="section d-none" id="commandes">
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-cart-check"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total Commandes</p>
                                    <h2 class="fw-bold">320</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">En attente</p>
                                    <h2 class="fw-bold">18</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-truck"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Livrées</p>
                                    <h2 class="fw-bold">250</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-x-octagon"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Annulées</p>
                                    <h2 class="fw-bold">12</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>
                                    Gestion des commandes
                                    <span class="product-count">(320)</span>
                                </h2>
                                <p class="subtitle">
                                    Supervisez toutes les commandes de la plateforme.
                                </p>
                            </div>
                            <div class="header-actions">
                                <button class="add-btn">
                                    <i class="bi bi-download me-2"></i>
                                    Exporter le rapport
                                </button>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input placeholder="Rechercher une commande..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select id="filterCategory">
                                    <option>Toutes les commandes</option>
                                    <option>Livrées</option>
                                    <option>En attente</option>
                                    <option>Annulées</option>
                                    <option>Non payées</option>
                                </select>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Client</th>
                                        <th>Producteur</th>
                                        <th>Date</th>
                                        <th>Prix</th>
                                        <th>Paiement</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Tagine" src="../assets/images/product-details/tagineTerracotta/tagineTerracottaInside.jpg" />
                                                <div>
                                                    <h6>Tagine Terracotta</h6>
                                                    <small>#PRD-052</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Sara Sarati</h6>
                                                    <small>#c-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12 Mai 2026</td>
                                        <td>450 DH</td>
                                        <td><span class="stock ok">Payé</span></td>
                                        <td><span class="stock ok">Livré</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn" title="Voir commande">
                                                    <a class="btn-link view-btn" data-section="voir-commande" href="#">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </button>
                                                <button class="icon-btn edit-btn" title="Changer statut commande "><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="Annuler commande "><i class="bi bi-x-circle"></i></button>
                                                <button class="icon-btn export-btn" title="Générer facture"><i class="bi bi-file-earmark-pdf"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Tagine" src="../assets/images/product-details/tagineTerracotta/tagineTerracottaInside.jpg" />
                                                <div>
                                                    <h6>Tagine Terracotta</h6>
                                                    <small>#PRD-052</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Sara Sarati</h6>
                                                    <small>#c-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12 Mai 2026</td>
                                        <td>450 DH</td>
                                        <td><span class="stock out">Non payé</span></td>
                                        <td><span class="stock low">En cours</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn" title="Voir commande">
                                                    <a class="btn-link view-btn" data-section="voir-commande" href="#">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </button>
                                                <button class="icon-btn edit-btn" title="Changer statut commande "><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="Annuler commande "><i class="bi bi-x-circle"></i></button>
                                                <button class="icon-btn export-btn" disabled="" title="Générer facture"><i class="bi bi-file-earmark-pdf"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="custom-pagination">
                            <button class="pagination-arrow">«</button>
                            <button class="pagination-number active">1</button>
                            <button class="pagination-number">2</button>
                            <button class="pagination-number">3</button>
                            <button class="pagination-arrow">»</button>
                        </div>
                    </div>
                </div>
                <!-- Paymaint -->
