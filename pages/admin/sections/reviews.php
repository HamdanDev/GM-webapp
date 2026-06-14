                <div class="section d-none" id="avis">
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-chat-dots"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total Avis</p>
                                    <h2 class="fw-bold">845</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-hand-thumbs-up"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Avis Positifs</p>
                                    <h2 class="fw-bold">720</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-flag"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Signalés</p>
                                    <h2 class="fw-bold">12</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-trash"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Supprimés</p>
                                    <h2 class="fw-bold">5</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>Gestion des avis</h2>
                                <p class="subtitle">
                                    Surveillez et modérez les avis publiés sur la plateforme.
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
                                <input placeholder="Rechercher un avis..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select id="filterCategory">
                                    <option>Tous les avis</option>
                                    <option>5 étoiles</option>
                                    <option>Signalés</option>
                                    <option>Négatifs</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Produit</th>
                                        <th>Producteur</th>
                                        <th>Note</th>
                                        <th>Avis</th>
                                        <th>Date</th>
                                        <th>Signalement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>Sara Sarati</h6><small>#C-102</small>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Savon" src="../assets/images/product-details/savonBeldi/savonBeldiNila.jpeg" />
                                                <div>
                                                    <h6>Savon Beldi</h6>
                                                    <small>#PRD-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>Ahmadi Ahmad</h6><small>#P-102</small>
                                        </td>
                                        <td>
                                            <div class="table-stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </div>
                                        </td>
                                        <td>
                                            Excellent produit, très bonne qualité 👌</td>
                                        <td>15/06/2025</td>
                                        <td><span class="stock ok">Aucun</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" title="Voir détails"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn remove-btn" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6>Sara Sarati</h6><small>#C-102</small>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Savon" src="../assets/images/product-details/savonBeldi/savonBeldiAkarFasi.jpeg" />
                                                <div>
                                                    <h6>Savon Beldi</h6>
                                                    <small>#PRD-103</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>Ahmadi Ahmad</h6><small>#P-102</small>
                                        </td>
                                        <td>
                                            <div class="table-stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </div>
                                        </td>
                                        <td>Produit pas conforme à la description.</td>
                                        <td>16/06/2025</td>
                                        <td><span class="stock low">Signalé</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" title="Voir détails"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn remove-btn" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- PAGINATION -->
                        <div class="custom-pagination">
                            <button class="pagination-arrow">«</button>
                            <button class="pagination-number active">1</button>
                            <button class="pagination-number">2</button>
                            <button class="pagination-number">3</button>
                            <button class="pagination-arrow">»</button>
                        </div>
                    </div>
                </div>
                <!-- categorie -->
