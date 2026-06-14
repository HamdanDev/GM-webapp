                <div class="section d-none" id="commandes">
                    <h4 class="mb-4">Mes Commandes</h4>
                    <div class="content-card">
                        <table class="table table-borderless">
                            <thead><tr class="text-muted small"><th>Produit</th><th>Date</th><th>Prix</th><th>Statut</th></tr></thead>
                            <tbody>
                                <?php foreach ($clientOrders as $order): ?>
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
