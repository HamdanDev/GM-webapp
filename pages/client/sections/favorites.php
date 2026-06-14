                <div class="section d-none" id="favoris">
                    <h4 class="mb-4">Mes Favoris</h4>
                    <div class="row g-3">
                        <?php foreach ($favoriteProducts as $product): ?>
                            <div class="col-6 col-md-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <img alt="<?php echo e($product['nom_Prod']); ?>" class="card-img-top product-img" src="<?php echo e(asset_url($product['Prod_img'])); ?>" />
                                    <div class="card-body">
                                        <small class="text-muted"><?php echo e($product['nom_Categ']); ?></small>
                                        <h6 class="card-title mt-1"><?php echo e($product['nom_Prod']); ?></h6>
                                        <div class="mb-1"><?php echo render_stars((float) $product['average_rating']); ?> <small class="text-muted">(<?php echo (int) $product['review_count']; ?>)</small></div>
                                        <p class="text-success fw-bold mb-2"><?php echo e(format_price($product['Prix'])); ?></p>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm w-75 btn-voir" href="product-details.php?id=<?php echo (int) $product['ID_Prod']; ?>">Voir</a>
                                            <button class="btn btn-sm text-white btn-add w-25"><i class="bi bi-cart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
