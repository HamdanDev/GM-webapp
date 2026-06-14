                <div class="section d-none" id="Reclamation">
                    <div class="row g-3 mb-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi bi-chat-dots-fill"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">Réclamations actives</p>
                                    <h2 class="fw-bold">14</h2>
                                    <p class="growth">+3 <span>aujourd’hui</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">Résolues</p>
                                    <h2 class="fw-bold">32</h2>
                                    <p class="growth">+12% <span>ce mois</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                </div>
                                <div class="content">
                                    <p class="title fw-bold">Urgentes</p>
                                    <h2 class="fw-bold">5</h2>
                                    <p class="growth">À traiter rapidement</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>
                                    Réclamations
                                    <span class="product-count">(14)</span>
                                </h2>
                                <p class="subtitle">
                                    Gérez les réclamations et problèmes signalés par les clients.
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
                                <input placeholder="Rechercher une réclamation..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select id="filterCategory">
                                    <option>Toutes</option>
                                    <option>En attente</option>
                                    <option>Résolues</option>
                                    <option>Urgentes</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Commande</th>
                                        <th>Sujet</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#REC-102</td>
                                        <td>Sara Alaoui</td>
                                        <td>#CMD-552</td>
                                        <td>Produit non reçu</td>
                                        <td>15/05/2026</td>
                                        <td>
                                            <span class="stock low">
                                                En attente
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn edit-btn" title="valider">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                                <button class="icon-btn remove-btn" title="refuser">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#REC-221</td>
                                        <td>Ahmed Karim</td>
                                        <td>#CMD-331</td>
                                        <td>Paiement échoué</td>
                                        <td>14/05/2026</td>
                                        <td>
                                            <span class="stock ok">
                                                Résolue
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn edit-btn" title="valider">
                                                    <i class="bi bi-check-circle"></i>
                                                </button>
                                                <button class="icon-btn remove-btn" title="refuser">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="custom-pagination">
                            <button class="pagination-arrow">
                                «
                            </button>
                            <button class="pagination-number active">
                                1
                            </button>
                            <button class="pagination-number">
                                2
                            </button>
                            <button class="pagination-number">
                                3
                            </button>
                            <button class="pagination-arrow">
                                »
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Avis -->
