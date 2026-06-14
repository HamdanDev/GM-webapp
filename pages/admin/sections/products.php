                <div class="section d-none" id="produits">
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi-check-circle"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">Produits validés</p>
                                    <h2 class="fw-bold">120</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi-hourglass-split"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">En attente</p>
                                    <h2 class="fw-bold">10</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi-exclamation-triangle"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">Signalés</p>
                                    <h2 class="fw-bold">3</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi-slash-circle"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">Suspendus</p>
                                    <h2 class="fw-bold">5</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>
                                    Tous les Produits
                                    <span class="product-count">(24)</span>
                                </h2>
                                <p class="subtitle">
                                    Supervisez et gérez les produits de la plateforme.
                                </p>
                            </div>
                            <div class="header-actions">
                                <button class="export-btn">
                                    <i class="bi bi-download me-2"></i>
                                    Exporter le rapport
                                </button>
                                <button class="add-btn">
                                    <a class="btn-link" data-section="ajouter-produit" href="#">
                                        <i class="bi bi-plus-lg me-2"></i>
                                        Ajouter un produit
                                    </a>
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
                                    <option>tous categories</option>
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
                                        <th>Producteur</th>
                                        <th>Statut</th>
                                        <th>Signalements</th>
                                        <th>Actions</th>
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
                                        <td>Cosmétiques</td>
                                        <td>120 DH</td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="stock ok">Validé</span></td>
                                        <td>0</td>
                                        <td>
                                            <div class="action-buttons">
                                                <div class="action-buttons">
                                                    <button class="icon-btn title=" details"="" voir="">
                                                        <a class="btn-link view-btn" data-section="voir-produit" href="#">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </button>
                                                    <button class="icon-btn export-btn" disabled="" title="Confirmer"><i class="bi bi-check-circle"></i></button>
                                                    <button class="icon-btn" title="modifier">
                                                        <a class="btn-link edit-btn" data-section="modifier-produit" href="#">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    </button>
                                                    <button class="icon-btn remove-btn" title="supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Huile" src="../assets/images/product-details/arganOil/huileArganBio.png" />
                                                <div>
                                                    <h6>Huile d'Argan</h6>
                                                    <small>#PRD-221</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Cosmétiques</td>
                                        <td>250 DH</td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="enatent">En attente</span></td>
                                        <td>2</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn title=" details"="" voir="">
                                                    <a class="btn-link view-btn" data-section="voir-produit" href="#">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </button>
                                                <button class="icon-btn export-btn" title="Confirmer"><i class="bi bi-check-circle"></i></button>
                                                <button class="icon-btn" title="modifier">
                                                    <a class="btn-link edit-btn" data-section="modifier-produit" href="#">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </button>
                                                <button class="icon-btn remove-btn" title="supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img alt="Tagine Terracotta" src="../assets/images/product-details/tagineTerracotta/" />
                                                <div>
                                                    <h6>Tagine Terracotta</h6>
                                                    <small>#PRD-310</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Mode Traditionnelle</td>
                                        <td>180 DH</td>
                                        <td>
                                            <div class="product-info">
                                                <div>
                                                    <h6>Ahmadi Ahmad</h6>
                                                    <small>#P-102</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="stock out">Refusé</span></td>
                                        <td>1</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn title=" details"="" voir="">
                                                    <a class="btn-link view-btn" data-section="voir-produit" href="#">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </button>
                                                <button class="icon-btn export-btn" disabled="" title="Confirmer"><i class="bi bi-check-circle"></i></button>
                                                <button class="icon-btn" disabled="" title="modifier">
                                                    <a class="btn-link edit-btn" data-section="modifier-produit" href="#">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </button>
                                                <button class="icon-btn remove-btn" title="supprimer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
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
                <!-- MES stock  -->
