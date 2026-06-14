                <div class="section d-none" id="commandes">
                    <?php if ($adminOrderMessage && $adminOrderTargetSection === 'commandes'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= e($adminOrderMessage) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($adminOrderError && $adminOrderTargetSection === 'commandes'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= e($adminOrderError) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-cart-check"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total Commandes</p>
                                    <h2 class="fw-bold"><?= (int) $adminOrderStats['total'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">En attente</p>
                                    <h2 class="fw-bold"><?= (int) $adminOrderStats['pending'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-truck"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Livrées</p>
                                    <h2 class="fw-bold"><?= (int) $adminOrderStats['delivered'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-x-octagon"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Annulées</p>
                                    <h2 class="fw-bold"><?= (int) $adminOrderStats['cancelled'] ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>
                                    Gestion des commandes
                                    <span class="product-count">(<?= count($adminOrders) ?>)</span>
                                </h2>
                                <p class="subtitle">Supervisez toutes les commandes de la plateforme.</p>
                            </div>
                            <div class="header-actions">
                                <button class="add-btn" type="button">
                                    <i class="bi bi-download me-2"></i>
                                    Exporter le rapport
                                </button>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input data-order-search placeholder="Rechercher une commande..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select data-order-status-filter>
                                    <option value="">Toutes les commandes</option>
                                    <option value="livré">Livrées</option>
                                    <option value="en attente">En attente</option>
                                    <option value="en cours">En cours</option>
                                    <option value="annulé">Annulées</option>
                                    <option value="non_payee">Non payées</option>
                                </select>
                            </div>
                        </div>
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
                                    <?php foreach ($adminOrders as $order): ?>
                                        <?php
                                        $orderId = (int) $order['ID_Com'];
                                        $clientName = trim($order['client_prenom'] . ' ' . $order['client_nom']);
                                        $producerName = trim(($order['producer_prenom'] ?? '') . ' ' . ($order['producer_nom'] ?? '')) ?: '-';
                                        $isPaid = !empty($order['ID_Pay']);
                                        ?>
                                        <tr
                                            data-order-row
                                            data-order-search-value="<?= e(strtolower($orderId . ' ' . $order['product_name'] . ' ' . $clientName . ' ' . $producerName)) ?>"
                                            data-order-status-value="<?= e($order['status_com']) ?>"
                                            data-order-paid-value="<?= $isPaid ? 'payee' : 'non_payee' ?>"
                                        >
                                            <td>
                                                <div class="product-info">
                                                    <img alt="<?= e($order['product_name'] ?? 'Commande') ?>" src="<?= e(asset_url($order['product_img'])) ?>" />
                                                    <div>
                                                        <h6><?= e($order['product_name'] ?? 'Commande') ?></h6>
                                                        <small>#CMD-<?= str_pad((string) $orderId, 4, '0', STR_PAD_LEFT) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-info">
                                                    <div>
                                                        <h6><?= e($clientName) ?></h6>
                                                        <small>#C-<?= str_pad((string) $order['client_id'], 3, '0', STR_PAD_LEFT) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-info">
                                                    <div>
                                                        <h6><?= e($producerName) ?></h6>
                                                        <small>#P-<?= str_pad((string) ($order['producer_id'] ?? 0), 3, '0', STR_PAD_LEFT) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= e(format_date_fr($order['date_com'])) ?></td>
                                            <td><?= e(format_price($order['prix_total'])) ?></td>
                                            <td><span class="<?= $isPaid ? 'stock ok' : 'stock out' ?>"><?= $isPaid ? 'Payé' : 'Non payé' ?></span></td>
                                            <td><span class="<?= e(admin_order_status_class($order['status_com'])) ?>"><?= e(ucfirst($order['status_com'])) ?></span></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="icon-btn edit-btn" data-bs-target="#updateOrderStatusModal" data-bs-toggle="modal" data-order-status-edit data-id="<?= $orderId ?>" data-status="<?= e($order['status_com']) ?>" title="Changer statut commande" type="button"><i class="bi bi-pencil"></i></button>
                                                    <button class="icon-btn remove-btn" data-bs-target="#cancelOrderModal" data-bs-toggle="modal" data-order-cancel data-id="<?= $orderId ?>" title="Annuler commande" type="button"><i class="bi bi-x-circle"></i></button>
                                                    <button class="icon-btn export-btn" <?= $isPaid ? '' : 'disabled' ?> title="Générer facture" type="button"><i class="bi bi-file-earmark-pdf"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="updateOrderStatusModalLabel" class="modal fade" id="updateOrderStatusModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post">
                                <input name="order_action" type="hidden" value="update_status" />
                                <input data-order-status-id name="ID_Com" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateOrderStatusModalLabel">Changer statut commande</h5>
                                    <button aria-label="Fermer" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Statut</label>
                                    <select class="form-select" data-order-status-value name="status_com" required>
                                        <option value="en attente">En attente</option>
                                        <option value="en cours">En cours</option>
                                        <option value="livré">Livré</option>
                                        <option value="annulé">Annulé</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button class="annul-btn" data-bs-dismiss="modal" type="button">Annuler</button>
                                    <button class="add-btn" type="submit">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="cancelOrderModalLabel" class="modal fade" id="cancelOrderModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post">
                                <input name="order_action" type="hidden" value="cancel" />
                                <input data-cancel-order-id name="ID_Com" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelOrderModalLabel">Annuler commande</h5>
                                    <button aria-label="Fermer" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">Voulez-vous vraiment annuler cette commande ?</div>
                                <div class="modal-footer">
                                    <button class="annul-btn" data-bs-dismiss="modal" type="button">Retour</button>
                                    <button class="add-btn" type="submit">Annuler commande</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Paymaint -->
