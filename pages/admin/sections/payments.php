                <div class="section d-none" id="paimnt">
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-cash-stack"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total Paiements</p>
                                    <h2 class="fw-bold">12 500 DH</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-check-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Réussis</p>
                                    <h2 class="fw-bold">245</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">En attente</p>
                                    <h2 class="fw-bold">12</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Remboursements</p>
                                    <h2 class="fw-bold">5</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>Paiements</h2>
                                <p class="subtitle">Gérez et surveillez tous les paiements de la plateforme.</p>
                            </div>
                            <div class="header-actions">
                                <button class="add-btn"><i class="bi bi-download me-2"></i>Exporter le rapport</button>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box"><i class="bi bi-search"></i><input placeholder="Rechercher un paiement..." type="text" /></div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select id="filterCategory">
                                    <option>Tous statuts</option>
                                    <option>Payé</option>
                                    <option>En attente</option>
                                    <option>Échoué</option>
                                    <option>Remboursé</option>
                                    <option>Litige</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="product-table">
                                <thead>
                                    <tr>
                                        <th>ID Paiement</th>
                                        <th>ID Commande</th>
                                        <th>Client</th>
                                        <th>Producteur</th>
                                        <th>Montant</th>
                                        <th>Méthode</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Remboursement</th>
                                        <th>Facture</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#PAY0188</td>
                                        <td>#CMD1524</td>
                                        <td>
                                            <h6>Sara Sarati</h6><small>#C-102</small>
                                        </td>
                                        <td>
                                            <h6>Ahmadi Ahmad</h6><small>#P-102</small>
                                        </td>
                                        <td>250.00 DH</td>
                                        <td>Visa</td>
                                        <td><span class="stock ok">Payé</span></td>
                                        <td>15/06/2025</td>
                                        <td><span class="stock ok">Effectué</span></td>
                                        <td><button class="icon-btn export-btn" title="Telecharger"><i class="bi bi-download"></i></button></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" title="view details"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn export-btn" disabled="" title="Confirmer"><i class="bi bi-check-circle"></i></button>
                                                <button class="icon-btn remove-btn" disabled="" title="refuser"><i class="bi bi-x-circle"></i></button>
                                                <button class="icon-btn refund-btn" disabled="" title="refund"><i class="bi bi-arrow-counterclockwise"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#PAY0189</td>
                                        <td>#CMD1525</td>
                                        <td>
                                            <h6>sara Sarati</h6><small>#C-103</small>
                                        </td>
                                        <td>
                                            <h6>ahmed Ahmadi</h6><small>#P-103</small>
                                        </td>
                                        <td>400.00 DH</td>
                                        <td>Visa</td>
                                        <td><span class="stock ok">payé</span></td>
                                        <td>16/06/2025</td>
                                        <td><span class="enatent">En attente</span></td>
                                        <td><button class="icon-btn export-btn" title="Telecharger"><i class="bi bi-download"></i></button></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" title="view details"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn export-btn" disabled="" title="Confirmer"><i class="bi bi-check-circle"></i></button>
                                                <button class="icon-btn remove-btn" disabled="" title="refuser"><i class="bi bi-x-circle"></i></button>
                                                <button class="icon-btn refund-btn" disabled="" title="refund"><i class="bi bi-arrow-counterclockwise"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#PAY0190</td>
                                        <td>#CMD1526</td>
                                        <td>
                                            <h6>sara Sarati</h6><small>#C-104</small>
                                        </td>
                                        <td>
                                            <h6>ahmed Ahmadi</h6><small>#P-104</small>
                                        </td>
                                        <td>150.00 DH</td>
                                        <td>Cash</td>
                                        <td><span class="enatent">En attente</span></td>
                                        <td>17/06/2025</td>
                                        <td>—</td>
                                        <td><button class="icon-btn export-btn" disabled="" title="Telecharger"><i class="bi bi-download"></i></button></td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="icon-btn view-btn" title="view details"><i class="bi bi-eye"></i></button>
                                                <button class="icon-btn export-btn" title="Confirmer"><i class="bi bi-check-circle"></i></button>
                                                <button class="icon-btn remove-btn" title="refuser"><i class="bi bi-x-circle"></i></button>
                                                <button class="icon-btn refund-btn" disabled="" title="refund"><i class="bi bi-arrow-counterclockwise"></i></button>
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
                <!-- Reclamation -->
