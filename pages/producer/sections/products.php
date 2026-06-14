                <div class="section d-none" id="produits">
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-lg-3">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-box-seam"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total Produits</p>
                                    <h2 class="fw-bold">80</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Stock faible</p>
                                    <h2 class="fw-bold">30</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-x-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Rupture</p>
                                    <h2 class="fw-bold">15</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-grid"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Top Catégorie</p>
                                    <h2 class="fw-bold">355</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>Mes Produits <span class="product-count">(24)</span></h2>
                                <p class="subtitle">Gérez facilement vos produits et leur stock.</p>
                            </div>
                            <div class="header-actions">
                                <button class="export-btn"><i class="bi bi-download me-2"></i>Exporter</button>
                                <button class="add-btn" data-section="ajouter-produit"><i class="bi bi-plus-lg me-2"></i>Ajouter un produit</button>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input placeholder="Rechercher un produit..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select>
                                    <option>Toutes catégories</option>
                                    <option>Artisanat</option>
                                    <option>Cosmétiques</option>
                                    <option>Mode Traditionnelle</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Catégorie</th>
                                        <th>Prix</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Savon" src="../assets/images/product-details/savonBeldi/savonBeldiNila.jpeg" />
                                                <div>
                                                    <h6>Savon Beldi</h6><small>#PRD-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Cosmétiques</td>
                                        <td>120 MAD</td>
                                        <td><span class="stock ok">8 en stock</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" data-section="voir-produit" title="Voir détails"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn edit-btn" data-section="modifier-produit" title="Modifier"><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Huile" src="../assets/images/product-details/arganOil/huileArganBio.png" />
                                                <div>
                                                    <h6>Huile d'Argan</h6><small>#PRD-221</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Cosmétiques</td>
                                        <td>250 MAD</td>
                                        <td><span class="stock low">Stock faible</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" data-section="voir-produit" title="Voir détails"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn edit-btn" data-section="modifier-produit" title="Modifier"><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Tagine" src="../assets/images/product-details/tagineTerracotta/tagineTerracottaInside.jpg" />
                                                <div>
                                                    <h6>Tagine Terracotta</h6><small>#PRD-310</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Artisanat</td>
                                        <td>180 MAD</td>
                                        <td><span class="stock out">Rupture</span></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" data-section="voir-produit" title="Voir détails"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn edit-btn" data-section="modifier-produit" title="Modifier"><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="Supprimer"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="custom-pagination">
                            <button class="pagination-arrow">«</button>
                            <button class="pagination-number active">1</button>
                            <button class="pagination-number">2</button>
                            <button class="pagination-number">3</button>
                            <button class="pagination-arrow">»</button>
                        </div>
                    </div>
                </div>
                <!-- STOCK -->
