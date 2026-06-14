                <div class="section d-none" id="categorie">
                    <div class="row g-3 mb-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-grid-fill"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total catégories</p>
                                    <h2 class="fw-bold">12</h2>
                                    <p class="growth">+2 <span>ce mois</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-box-seam"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Produits classés</p>
                                    <h2 class="fw-bold">245</h2>
                                    <p class="growth">+18%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-star-fill"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Catégorie populaire</p>
                                    <h2 class="fw-bold">Cosmetics</h2>
                                    <p class="growth">85 produits</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>Catégories</h2>
                                <p class="subtitle">Gérez facilement les catégories de vos produits.</p>
                            </div>
                            <div class="header-actions">
                                <button class="export-btn">
                                    <i class="bi bi-download me-2"></i>
                                    Exporter le rapport
                                </button>
                                <button class="add-btn">
                                    <i class="bi bi-plus-lg me-2"></i>
                                    Ajouter un produit
                                </button>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input placeholder="Rechercher une catégorie..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select id="filterCategory">
                                    <option>Toutes catégories</option>
                                    <option>Cosmetics</option>
                                    <option>Artisanat</option>
                                    <option>Bio</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>CategID</th>
                                        <th>Categ_img</th>
                                        <th>Nom_Categ</th>
                                        <th>Nombre de Produits</th>
                                        <th>Description_Categ</th>
                                        <th>Date création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#CAT-001</td>
                                        <td><img alt="" class="category-img" src="../assets/images/placeholder-logo.png" /></td>
                                        <td>Cosmetics</td>
                                        <td>8</td>
                                        <td>Produits naturels et bio riches en vitamines.</td>
                                        <td>15/05/2026</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn edit-btn" title="modifier"><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="supprimer"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#CAT-002</td>
                                        <td><img alt="" class="category-img" src="../assets/images/placeholder-logo.png" /></td>
                                        <td>Artisanat</td>
                                        <td>12</td>
                                        <td>Produits faits main par artisans locaux.</td>
                                        <td>10/05/2026</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn edit-btn" title="modifier"><i class="bi bi-pencil"></i></button>
                                                <button class="icon-btn remove-btn" title="supprimer"><i class="bi bi-trash"></i></button>
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
                <!-- Notification -->
