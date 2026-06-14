                <div class="section d-none" id="paimnt">
                    <?php if ($adminOrderMessage && $adminOrderTargetSection === 'paimnt'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= e($adminOrderMessage) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($adminOrderError && $adminOrderTargetSection === 'paimnt'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= e($adminOrderError) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-cash-stack"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Total Paiements</p>
                                    <h2 class="fw-bold"><?= e(format_price($adminPaymentStats['total_amount'])) ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-check-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Réussis</p>
                                    <h2 class="fw-bold"><?= (int) $adminPaymentStats['count'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-credit-card"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Cartes</p>
                                    <h2 class="fw-bold"><?= (int) $adminPaymentStats['card'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-paypal"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">PayPal</p>
                                    <h2 class="fw-bold"><?= (int) $adminPaymentStats['paypal'] ?></h2>
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
                                <button class="add-btn" type="button"><i class="bi bi-download me-2"></i>Exporter le rapport</button>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input data-payment-search placeholder="Rechercher un paiement..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select data-payment-method-filter>
                                    <option value="">Toutes méthodes</option>
                                    <option value="carte">Carte bancaire</option>
                                    <option value="paypal">PayPal</option>
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
                                        <th>Facture</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adminPayments as $payment): ?>
                                        <?php
                                        $paymentId = (int) $payment['ID_Pay'];
                                        $clientName = trim($payment['client_prenom'] . ' ' . $payment['client_nom']);
                                        $producerName = trim(($payment['producer_prenom'] ?? '') . ' ' . ($payment['producer_nom'] ?? '')) ?: '-';
                                        ?>
                                        <tr
                                            data-payment-row
                                            data-payment-search-value="<?= e(strtolower($paymentId . ' ' . $payment['ID_Com'] . ' ' . $clientName . ' ' . $producerName . ' ' . $payment['mode_pay'])) ?>"
                                            data-payment-method-value="<?= e(strtolower($payment['mode_pay'])) ?>"
                                        >
                                            <td>#PAY-<?= str_pad((string) $paymentId, 4, '0', STR_PAD_LEFT) ?></td>
                                            <td>#CMD-<?= str_pad((string) $payment['ID_Com'], 4, '0', STR_PAD_LEFT) ?></td>
                                            <td><h6><?= e($clientName) ?></h6><small>#C-<?= str_pad((string) $payment['client_id'], 3, '0', STR_PAD_LEFT) ?></small></td>
                                            <td><h6><?= e($producerName) ?></h6><small>#P-<?= str_pad((string) ($payment['producer_id'] ?? 0), 3, '0', STR_PAD_LEFT) ?></small></td>
                                            <td><?= e(format_price($payment['montant'])) ?></td>
                                            <td><?= e($payment['mode_pay']) ?></td>
                                            <td><span class="stock ok"><?= e(admin_payment_status_label()) ?></span></td>
                                            <td><?= e(format_date_fr($payment['date_pay'])) ?></td>
                                            <td><button class="icon-btn export-btn" title="Télécharger" type="button"><i class="bi bi-download"></i></button></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="icon-btn remove-btn" data-bs-target="#deletePaymentModal" data-bs-toggle="modal" data-payment-delete data-id="<?= $paymentId ?>" title="Supprimer paiement" type="button"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="deletePaymentModalLabel" class="modal fade" id="deletePaymentModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post">
                                <input name="order_action" type="hidden" value="delete_payment" />
                                <input data-delete-payment-id name="ID_Pay" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePaymentModalLabel">Supprimer paiement</h5>
                                    <button aria-label="Fermer" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">Voulez-vous vraiment supprimer ce paiement ?</div>
                                <div class="modal-footer">
                                    <button class="annul-btn" data-bs-dismiss="modal" type="button">Annuler</button>
                                    <button class="add-btn" type="submit">Supprimer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if ($adminOrderTargetSection): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if (typeof showSection === 'function') {
                                showSection('<?= e($adminOrderTargetSection) ?>');
                            }
                        });
                    </script>
                <?php endif; ?>
                <!-- Reclamation -->
