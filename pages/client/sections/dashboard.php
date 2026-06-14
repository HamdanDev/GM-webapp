                <div class="section" id="dashboard">
                    <h4 class="mb-4">Bonjour, <?php echo e($profileUser['prenom'] ?? 'Client'); ?>!</h4>
                    <div class="row g-3 mb-4">
                        <div class="col-4"><div class="stat-card"><small class="text-muted">Commandes</small><h3 class="text-success mb-0"><?php echo count($clientOrders); ?></h3></div></div>
                        <div class="col-4"><div class="stat-card"><small class="text-muted">Total dépensé</small><h3 class="text-success mb-0"><?php echo e(format_price($totalSpent)); ?></h3></div></div>
                        <div class="col-4"><div class="stat-card"><small class="text-muted">Avis laissés</small><h3 class="text-success mb-0"><?php echo count($clientReviews); ?></h3></div></div>
                    </div>
                    <div class="content-card">
                        <h6 class="fw-bold mb-3">Dernières commandes</h6>
                        <table class="table table-borderless">
                            <thead><tr class="text-muted small"><th>Produit</th><th>Date</th><th>Prix</th><th>Statut</th></tr></thead>
                            <tbody>
                                <?php foreach (array_slice($clientOrders, 0, 3) as $order): ?>
                                    <tr>
                                        <td><?php echo e($order['product_name'] ?? 'Commande'); ?></td>
                                        <td><?php echo e(format_date_fr($order['date_com'])); ?></td>
                                        <td><?php echo e(format_price($order['prix_total'])); ?></td>
                                        <td><span class="badge-statut"><?php echo e($order['status_com']); ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
