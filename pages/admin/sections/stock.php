                <div class="section d-none" id="stock">
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-box-seam"></i></div>
                                <div class="content">
                                    <p class="title fw-bold light">Total Products</p>
                                    <h2 class="fw-bold">133</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Low Stock</p>
                                    <h2 class="fw-bold">30</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-x-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Out Of Stock</p>
                                    <h2 class="fw-bold">15</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi-columns-gap"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Top Category</p>
                                    <h2 class="fw-bold">355</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert-box">
                        <i class="bi bi-exclamation-circle"></i>
                        12 produits nécessitent une vérification immédiate.
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>Stock</h2>
                                <p class="subtitle">Supervisez l'inventaire global des producteurs.</p>
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
                                <input placeholder="Rechercher un produit..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select id="filterCategory">
                                    <option>Tous les produits</option>
                                    <option>En stock</option>
                                    <option>Stock faible</option>
                                    <option>Rupture de stock</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Producteur</th>
                                        <th>Stock actuel</th>
                                        <th>Stock min.</th>
                                        <th>Statut</th>
                                        <th>Dernière mise à jour</th>
                                        <th>mise à jour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                            <div class="product-info">
                                                <div>
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>5 unités</td>
                                        <td>10 unités</td>
                                        <td><span class="stock low">Stock faible</span></td>
                                        <td>15/06/2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn export-btn" title="modifier"><i class="bi bi-box-seam"></i></button>
                                                <button class="icon-btn remove-btn" title="supprimer"><i class="bi bi-trash"></i></button>
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
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>0 unité</td>
                                        <td>5 unités</td>
                                        <td><span class="stock out">Rupture de stock</span></td>
                                        <td>15/06/2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn export-btn" title="modifier"><i class="bi bi-box-seam"></i></button>
                                                <button class="icon-btn remove-btn" title="supprimer"><i class="bi bi-trash"></i></button>
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
                <!-- MES COMMANDES -->
