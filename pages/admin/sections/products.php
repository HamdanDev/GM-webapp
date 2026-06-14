                <div class="section d-none" id="produits">
                    <?php if ($adminProductMessage && $adminProductTargetSection !== 'stock'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= e($adminProductMessage) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($adminProductError && $adminProductTargetSection !== 'stock'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= e($adminProductError) ?>
                            <button aria-label="Fermer" class="btn-close" data-bs-dismiss="alert" type="button"></button>
                        </div>
                    <?php endif; ?>

                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi-check-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Produits actifs</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['active'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi-slash-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Suspendus</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['inactive'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi-exclamation-triangle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Stock faible</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['low_stock'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-ca h-100">
                                <div class="icon"><i class="bi-x-circle"></i></div>
                                <div class="content">
                                    <p class="title fw-bold">Rupture</p>
                                    <h2 class="fw-bold"><?= (int) $adminProductStats['out_stock'] ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-page">
                        <div class="stock-header">
                            <div>
                                <h2>
                                    Tous les Produits
                                    <span class="product-count">(<?= (int) $adminProductStats['total'] ?>)</span>
                                </h2>
                                <p class="subtitle">Supervisez et gérez les produits de la plateforme.</p>
                            </div>
                            <div class="header-actions">
                                <button class="export-btn" type="button">
                                    <i class="bi bi-download me-2"></i>
                                    Exporter le rapport
                                </button>
                                <a class="btn-link" data-section="ajouter-produit" href="#">
                                    <button class="add-btn" type="button">
                                        <i class="bi bi-plus-lg me-2"></i>
                                        Ajouter un produit
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="top-bar">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input data-product-search placeholder="Rechercher un produit..." type="text" />
                            </div>
                            <div class="filter-box">
                                <i class="bi bi-funnel"></i>
                                <select data-product-category-filter>
                                    <option value="">Toutes catégories</option>
                                    <?php foreach ($adminCategories as $category): ?>
                                        <option value="<?= (int) $category['ID_Categ'] ?>"><?= e($category['nom_Categ']) ?></option>
                                    <?php endforeach; ?>
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
                                        <th>Producteur</th>
                                        <th>Statut</th>
                                        <th>Avis</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adminProducts as $product): ?>
                                        <?php
                                        $productId = (int) $product['ID_Prod'];
                                        $producerName = trim($product['producer_prenom'] . ' ' . $product['producer_nom']);
                                        ?>
                                        <tr
                                            data-product-row
                                            data-product-search-value="<?= e(strtolower($product['nom_Prod'] . ' ' . $product['nom_Categ'] . ' ' . $producerName)) ?>"
                                            data-product-category-value="<?= (int) $product['ID_Categ'] ?>"
                                        >
                                            <td>
                                                <div class="product-info">
                                                    <img alt="<?= e($product['nom_Prod']) ?>" src="<?= e(asset_url($product['Prod_img'])) ?>" />
                                                    <div>
                                                        <h6><?= e($product['nom_Prod']) ?></h6>
                                                        <small>#PRD-<?= str_pad((string) $productId, 3, '0', STR_PAD_LEFT) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= e($product['nom_Categ']) ?></td>
                                            <td><?= e(format_price($product['Prix'])) ?></td>
                                            <td><?= (int) $product['Stock'] ?></td>
                                            <td>
                                                <div class="product-info">
                                                    <div>
                                                        <h6><?= e($producerName) ?></h6>
                                                        <small><?= e($product['nom_boutique']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="<?= e(admin_product_status_class($product)) ?>"><?= e(admin_product_status_label($product)) ?></span></td>
                                            <td><?= (int) $product['review_count'] ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button
                                                        class="icon-btn edit-btn"
                                                        data-product-edit
                                                        data-id="<?= $productId ?>"
                                                        data-name="<?= e($product['nom_Prod']) ?>"
                                                        data-price="<?= e((string) $product['Prix']) ?>"
                                                        data-stock="<?= (int) $product['Stock'] ?>"
                                                        data-image="<?= e($product['Prod_img']) ?>"
                                                        data-category="<?= (int) $product['ID_Categ'] ?>"
                                                        data-shop="<?= (int) $product['ID_boutique'] ?>"
                                                        data-description="<?= e($product['description']) ?>"
                                                        data-active="<?= (int) $product['est_active'] ?>"
                                                        title="Modifier"
                                                        type="button"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button
                                                        class="icon-btn remove-btn"
                                                        data-bs-target="#deleteProductModal"
                                                        data-bs-toggle="modal"
                                                        data-product-delete
                                                        data-id="<?= $productId ?>"
                                                        data-name="<?= e($product['nom_Prod']) ?>"
                                                        title="Supprimer"
                                                        type="button"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div aria-hidden="true" aria-labelledby="deleteProductModalLabel" class="modal fade" id="deleteProductModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" method="post">
                                <input name="product_action" type="hidden" value="delete" />
                                <input data-delete-product-id name="ID_Prod" type="hidden" />
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProductModalLabel">Supprimer produit</h5>
                                    <button aria-label="Fermer" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer <strong data-delete-product-name></strong> ?
                                    <p class="text-muted small mb-0 mt-2">La suppression sera bloquée si ce produit est lié à des commandes, avis, paniers ou favoris.</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="annul-btn" data-bs-dismiss="modal" type="button">Annuler</button>
                                    <button class="add-btn" type="submit">
                                        <i class="bi bi-trash me-2"></i> Supprimer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- MES stock  -->
