<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/view_helpers.php';

$adminProductMessage = null;
$adminProductError = null;
$adminProductTargetSection = null;
$adminStockMinimum = 10;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_action'])) {
    $productAction = $_POST['product_action'];

    try {
        if ($productAction === 'create' || $productAction === 'update') {
            $name = trim($_POST['nom_Prod'] ?? '');
            $price = (float) ($_POST['Prix'] ?? 0);
            $stock = (int) ($_POST['Stock'] ?? 0);
            $image = trim($_POST['Prod_img'] ?? '');
            $categoryId = (int) ($_POST['ID_Categ'] ?? 0);
            $shopId = (int) ($_POST['ID_boutique'] ?? 0);
            $description = trim($_POST['description'] ?? '');
            $isActive = isset($_POST['est_active']) ? 1 : 0;

            if ($name === '' || $price <= 0 || $categoryId <= 0 || $shopId <= 0) {
                throw new RuntimeException('Nom, prix, catégorie et boutique sont obligatoires.');
            }

            if ($stock < 0) {
                throw new RuntimeException('Le stock ne peut pas être négatif.');
            }

            if ($productAction === 'create') {
                $stmt = $pdo->prepare(
                    'INSERT INTO produit (nom_Prod, Prix, Stock, Prod_img, ID_boutique, ID_Categ, description, est_active)
                     VALUES (:nom_Prod, :Prix, :Stock, :Prod_img, :ID_boutique, :ID_Categ, :description, :est_active)'
                );
                $stmt->execute([
                    'nom_Prod' => $name,
                    'Prix' => $price,
                    'Stock' => $stock,
                    'Prod_img' => $image !== '' ? $image : null,
                    'ID_boutique' => $shopId,
                    'ID_Categ' => $categoryId,
                    'description' => $description !== '' ? $description : null,
                    'est_active' => $isActive,
                ]);

                $adminProductMessage = 'Produit ajouté avec succès.';
            }

            if ($productAction === 'update') {
                $productId = (int) ($_POST['ID_Prod'] ?? 0);

                if ($productId <= 0) {
                    throw new RuntimeException('Produit introuvable.');
                }

                $stmt = $pdo->prepare(
                    'UPDATE produit
                     SET nom_Prod = :nom_Prod, Prix = :Prix, Stock = :Stock, Prod_img = :Prod_img,
                         ID_boutique = :ID_boutique, ID_Categ = :ID_Categ, description = :description,
                         est_active = :est_active
                     WHERE ID_Prod = :ID_Prod'
                );
                $stmt->execute([
                    'ID_Prod' => $productId,
                    'nom_Prod' => $name,
                    'Prix' => $price,
                    'Stock' => $stock,
                    'Prod_img' => $image !== '' ? $image : null,
                    'ID_boutique' => $shopId,
                    'ID_Categ' => $categoryId,
                    'description' => $description !== '' ? $description : null,
                    'est_active' => $isActive,
                ]);

                $adminProductMessage = 'Produit modifié avec succès.';
            }

            $adminProductTargetSection = 'produits';
        }

        if ($productAction === 'delete') {
            $productId = (int) ($_POST['ID_Prod'] ?? 0);

            if ($productId <= 0) {
                throw new RuntimeException('Produit introuvable.');
            }

            $stmt = $pdo->prepare('DELETE FROM produit WHERE ID_Prod = :ID_Prod');
            $stmt->execute(['ID_Prod' => $productId]);

            $adminProductMessage = 'Produit supprimé avec succès.';
            $adminProductTargetSection = 'produits';
        }

        if ($productAction === 'update_stock') {
            $productId = (int) ($_POST['ID_Prod'] ?? 0);
            $stock = (int) ($_POST['Stock'] ?? 0);

            if ($productId <= 0) {
                throw new RuntimeException('Produit introuvable.');
            }

            if ($stock < 0) {
                throw new RuntimeException('Le stock ne peut pas être négatif.');
            }

            $stmt = $pdo->prepare('UPDATE produit SET Stock = :Stock WHERE ID_Prod = :ID_Prod');
            $stmt->execute([
                'ID_Prod' => $productId,
                'Stock' => $stock,
            ]);

            $adminProductMessage = 'Stock mis à jour avec succès.';
            $adminProductTargetSection = 'stock';
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            $adminProductError = 'Impossible de supprimer ce produit: il est lié à des commandes, avis, favoris ou paniers.';
        } else {
            $adminProductError = 'Erreur base de données: ' . $e->getMessage();
        }
        $adminProductTargetSection = $productAction === 'update_stock' ? 'stock' : 'produits';
    } catch (RuntimeException $e) {
        $adminProductError = $e->getMessage();
        $adminProductTargetSection = $productAction === 'update_stock' ? 'stock' : 'produits';
    }
}

$adminCategories = $pdo->query('SELECT ID_Categ, nom_Categ FROM categorie ORDER BY nom_Categ')->fetchAll();
$adminBoutiques = $pdo->query(
    'SELECT b.ID_boutique, b.nom_boutique, b.ville, u.ID_utili, u.nom, u.prenom
     FROM boutique b
     INNER JOIN utilisateur u ON u.ID_utili = b.ID_utili
     ORDER BY b.nom_boutique'
)->fetchAll();

$adminProducts = $pdo->query(
    'SELECT p.ID_Prod, p.nom_Prod, p.Prix, p.Stock, p.Prod_img, p.description, p.est_active, p.created_at,
            c.ID_Categ, c.nom_Categ,
            b.ID_boutique, b.nom_boutique,
            u.ID_utili, u.nom AS producer_nom, u.prenom AS producer_prenom,
            (SELECT COUNT(*) FROM avis a WHERE a.ID_Prod = p.ID_Prod) AS review_count
     FROM produit p
     INNER JOIN categorie c ON c.ID_Categ = p.ID_Categ
     INNER JOIN boutique b ON b.ID_boutique = p.ID_boutique
     INNER JOIN utilisateur u ON u.ID_utili = b.ID_utili
     ORDER BY p.created_at DESC, p.ID_Prod DESC'
)->fetchAll();

$adminProductStats = [
    'total' => count($adminProducts),
    'active' => 0,
    'inactive' => 0,
    'low_stock' => 0,
    'out_stock' => 0,
];

$categoryCounts = [];
foreach ($adminProducts as $product) {
    if ((int) $product['est_active'] === 1) {
        $adminProductStats['active']++;
    } else {
        $adminProductStats['inactive']++;
    }

    if ((int) $product['Stock'] === 0) {
        $adminProductStats['out_stock']++;
    } elseif ((int) $product['Stock'] <= $adminStockMinimum) {
        $adminProductStats['low_stock']++;
    }

    $categoryName = $product['nom_Categ'];
    $categoryCounts[$categoryName] = ($categoryCounts[$categoryName] ?? 0) + 1;
}

arsort($categoryCounts);
$adminTopCategoryName = array_key_first($categoryCounts) ?: '-';

function admin_product_status_class(array $product): string {
    return (int) $product['est_active'] === 1 ? 'stock ok' : 'stock out';
}

function admin_product_status_label(array $product): string {
    return (int) $product['est_active'] === 1 ? 'Actif' : 'Suspendu';
}

function admin_stock_status_class(int $stock, int $minimum): string {
    if ($stock <= 0) {
        return 'stock out';
    }

    if ($stock <= $minimum) {
        return 'stock low';
    }

    return 'stock ok';
}

function admin_stock_status_label(int $stock, int $minimum): string {
    if ($stock <= 0) {
        return 'Rupture de stock';
    }

    if ($stock <= $minimum) {
        return 'Stock faible';
    }

    return 'En stock';
}
?>
