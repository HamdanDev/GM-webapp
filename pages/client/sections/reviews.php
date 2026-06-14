                <div class="section d-none" id="avis">
                    <h4 class="mb-4">Mes Avis</h4>
                    <div class="content-card">
                        <div class="d-flex flex-column gap-3">
                            <?php foreach ($clientReviews as $index => $review): ?>
                                <?php if ($index > 0): ?><hr class="my-1" /><?php endif; ?>
                                <div class="avis-item">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold mb-1"><?php echo e($review['nom_Prod']); ?></h6>
                                        <small class="text-muted"><?php echo e(format_date_fr($review['created_at'])); ?></small>
                                    </div>
                                    <div class="text-warning mb-1"><?php echo render_stars((float) $review['note']); ?></div>
                                    <p class="text-muted small mb-0"><?php echo e($review['commentaire']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
