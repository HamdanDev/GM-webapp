                <div class="section d-none" id="stock">
                    <?php if ($adminProductMessage && $adminProductTargetSection === 'stock'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= e($adminProductMessage) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($adminProductError && $adminProductTargetSection === 'stock'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= e($adminProductError) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-box-seam"></i></div>
                                <div class="content">
                                    <p class="title fw-bold light">Total produits</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['total'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Stock faible</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['low_stock'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi bi-x-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Rupture</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['out_stock'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi-columns-gap"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Top catégorie</p>
                                    <h2 class="fw-bold"><?= e($adminTopCategoryName) ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($adminProductStats['low_stock'] + $adminProductStats['out_stock'] > 0): ?>
                        <div class="alert-box">
                            <i class="bi bi-exclamation-circle"></i>
                            <?= (int) ($adminProductStats['low_stock'] + $adminProductStats['out_stock']) ?> produits nécessitent une vérification immédiate.
                        </div>
                    <?php endif; ?>

                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>Stock</h2>
                                <p class="subtitle">Supervisez l'inventaire global des producteurs.</p>
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
                                <input data-stock-search placeholder="Rechercher un produit..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select data-stock-status-filter>
                                    <option value="">Tous les produits</option>
                                    <option value="ok">En stock</option>
                                    <option value="low">Stock faible</option>
                                    <option value="out">Rupture de stock</option>
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
                                        <th>Mise à jour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adminProducts as $product): ?>
                                        <?php
                                        $stock = (int) $product['Stock'];
                                        $stockStatus = $stock <= 0 ? 'out' : ($stock <= $adminStockMinimum ? 'low' : 'ok');
                                        $producerName = trim($product['producer_prenom'] . ' ' . $product['producer_nom']);
                                        ?>
                                        <tr
                                            data-stock-row
                                            data-stock-search-value="<?= e(strtolower($product['nom_Prod'] . ' ' . $producerName . ' ' . $product['nom_Categ'])) ?>"
                                            data-stock-status-value="<?= e($stockStatus) ?>"
                                        >
                                            <td>
                                                <div class="product-info">
                                                    <img alt="<?= e($product['nom_Prod']) ?>" src="<?= e(asset_url($product['Prod_img'])) ?>" />
                                                    <div>
                                                        <h6><?= e($product['nom_Prod']) ?></h6>
                                                        <small>#PRD-<?= str_pad((string) $product['ID_Prod'], 3, '0', STR_PAD_LEFT) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-info">
                                                    <div>
                                                        <h6><?= e($producerName) ?></h6>
                                                        <small><?= e($product['nom_boutique']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $stock ?> unités</td>
                                            <td><?= $adminStockMinimum ?> unités</td>
                                            <td>
                                                <span class="<?= e(admin_stock_status_class($stock, $adminStockMinimum)) ?>">
                                                    <?= e(admin_stock_status_label($stock, $adminStockMinimum)) ?>
                                                </span>
                                            </td>
                                            <td><?= e(format_date_fr($product['created_at'])) ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button
                                                        class="icon-btn export-btn"
                                                        data-bs-target="#updateStockModal"
                                                        data-bs-toggle="modal"
                                                        data-stock-edit
                                                        data-id="<?= (int) $product['ID_Prod'] ?>"
                                                        data-name="<?= e($product['nom_Prod']) ?>"
                                                        data-stock="<?= $stock ?>"
                                                        title="Modifier stock"
                                                        type="button"
                                                    >
                                                        <i class="bi bi-box-seam"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="updateStockModalLabel" class="modal fade" id="updateStockModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post">
                                <input name="product_action" type="hidden" value="update_stock" />
                                <input data-stock-product-id name="ID_Prod" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStockModalLabel">Mettre à jour le stock</h5>
                                    <button aria-label="Fermer" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-3">Produit: <strong data-stock-product-name></strong></p>
                                    <label class="form-label">Nouvelle quantité</label>
                                    <input class="form-control" data-stock-product-value min="0" name="Stock" required type="number" />
                                </div>
                                <div class="modal-footer">
                                    <button class="annul-btn" data-bs-dismiss="modal" type="button">Annuler</button>
                                    <button class="add-btn" type="submit">
                                        <i class="bi bi-check-circle me-2"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if ($adminProductTargetSection): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if (typeof showSection === 'function') {
                                showSection('<?= e($adminProductTargetSection) ?>');
                            }
                        });
                    </script>
                <?php endif; ?>
                <!-- MES COMMANDES -->
