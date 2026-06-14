<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/view_helpers.php';

$adminOrderMessage = null;
$adminOrderError = null;
$adminOrderTargetSection = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_action'])) {
    $orderAction = $_POST['order_action'];

    try {
        if ($orderAction === 'update_status') {
            $orderId = (int) ($_POST['ID_Com'] ?? 0);
            $status = trim($_POST['status_com'] ?? '');
            $allowedStatuses = ['en attente', 'en cours', 'livré', 'annulé'];

            if ($orderId <= 0 || !in_array($status, $allowedStatuses, true)) {
                throw new RuntimeException('Statut de commande invalide.');
            }

            $stmt = $pdo->prepare('UPDATE commande SET status_com = :status_com WHERE ID_Com = :ID_Com');
            $stmt->execute([
                'ID_Com' => $orderId,
                'status_com' => $status,
            ]);

            $adminOrderMessage = 'Statut de commande mis à jour.';
            $adminOrderTargetSection = 'commandes';
        }

        if ($orderAction === 'cancel') {
            $orderId = (int) ($_POST['ID_Com'] ?? 0);

            if ($orderId <= 0) {
                throw new RuntimeException('Commande introuvable.');
            }

            $stmt = $pdo->prepare("UPDATE commande SET status_com = 'annulé' WHERE ID_Com = :ID_Com");
            $stmt->execute(['ID_Com' => $orderId]);

            $adminOrderMessage = 'Commande annulée.';
            $adminOrderTargetSection = 'commandes';
        }

        if ($orderAction === 'delete_payment') {
            $paymentId = (int) ($_POST['ID_Pay'] ?? 0);

            if ($paymentId <= 0) {
                throw new RuntimeException('Paiement introuvable.');
            }

            $stmt = $pdo->prepare('DELETE FROM paiement WHERE ID_Pay = :ID_Pay');
            $stmt->execute(['ID_Pay' => $paymentId]);

            $adminOrderMessage = 'Paiement supprimé.';
            $adminOrderTargetSection = 'paimnt';
        }
    } catch (PDOException $e) {
        $adminOrderError = 'Erreur base de données: ' . $e->getMessage();
        $adminOrderTargetSection = $orderAction === 'delete_payment' ? 'paimnt' : 'commandes';
    } catch (RuntimeException $e) {
        $adminOrderError = $e->getMessage();
        $adminOrderTargetSection = $orderAction === 'delete_payment' ? 'paimnt' : 'commandes';
    }
}

$adminOrders = $pdo->query(
    'SELECT
        co.ID_Com,
        co.date_com,
        co.status_com,
        co.prix_total,
        client.ID_utili AS client_id,
        client.nom AS client_nom,
        client.prenom AS client_prenom,
        MIN(p.nom_Prod) AS product_name,
        MIN(p.Prod_img) AS product_img,
        MIN(producer.ID_utili) AS producer_id,
        MIN(producer.nom) AS producer_nom,
        MIN(producer.prenom) AS producer_prenom,
        MAX(pay.ID_Pay) AS ID_Pay,
        MAX(pay.mode_pay) AS mode_pay,
        MAX(pay.date_pay) AS date_pay
     FROM commande co
     INNER JOIN utilisateur client ON client.ID_utili = co.ID_utili
     LEFT JOIN ligne_commande lc ON lc.ID_Com = co.ID_Com
     LEFT JOIN produit p ON p.ID_Prod = lc.ID_Prod
     LEFT JOIN boutique b ON b.ID_boutique = p.ID_boutique
     LEFT JOIN utilisateur producer ON producer.ID_utili = b.ID_utili
     LEFT JOIN paiement pay ON pay.ID_Com = co.ID_Com
     GROUP BY co.ID_Com, co.date_com, co.status_com, co.prix_total, client.ID_utili, client.nom, client.prenom
     ORDER BY co.date_com DESC, co.ID_Com DESC'
)->fetchAll();

$adminPayments = $pdo->query(
    'SELECT
        pay.ID_Pay,
        pay.mode_pay,
        pay.montant,
        pay.date_pay,
        co.ID_Com,
        co.status_com,
        client.ID_utili AS client_id,
        client.nom AS client_nom,
        client.prenom AS client_prenom,
        MIN(producer.ID_utili) AS producer_id,
        MIN(producer.nom) AS producer_nom,
        MIN(producer.prenom) AS producer_prenom
     FROM paiement pay
     INNER JOIN commande co ON co.ID_Com = pay.ID_Com
     INNER JOIN utilisateur client ON client.ID_utili = co.ID_utili
     LEFT JOIN ligne_commande lc ON lc.ID_Com = co.ID_Com
     LEFT JOIN produit p ON p.ID_Prod = lc.ID_Prod
     LEFT JOIN boutique b ON b.ID_boutique = p.ID_boutique
     LEFT JOIN utilisateur producer ON producer.ID_utili = b.ID_utili
     GROUP BY pay.ID_Pay, pay.mode_pay, pay.montant, pay.date_pay, co.ID_Com, co.status_com, client.ID_utili, client.nom, client.prenom
     ORDER BY pay.date_pay DESC, pay.ID_Pay DESC'
)->fetchAll();

$adminOrderStats = [
    'total' => count($adminOrders),
    'pending' => 0,
    'delivered' => 0,
    'cancelled' => 0,
];

foreach ($adminOrders as $order) {
    if ($order['status_com'] === 'en attente') {
        $adminOrderStats['pending']++;
    }
    if ($order['status_com'] === 'livré') {
        $adminOrderStats['delivered']++;
    }
    if ($order['status_com'] === 'annulé') {
        $adminOrderStats['cancelled']++;
    }
}

$adminPaymentStats = [
    'total_amount' => array_sum(array_map(static fn($payment) => (float) $payment['montant'], $adminPayments)),
    'count' => count($adminPayments),
    'card' => 0,
    'paypal' => 0,
];

foreach ($adminPayments as $payment) {
    if (stripos($payment['mode_pay'], 'carte') !== false) {
        $adminPaymentStats['card']++;
    }
    if (stripos($payment['mode_pay'], 'paypal') !== false) {
        $adminPaymentStats['paypal']++;
    }
}

function admin_order_status_class(string $status): string {
    return match ($status) {
        'livré' => 'stock ok',
        'annulé' => 'stock out',
        'en cours' => 'stock low',
        default => 'enatent',
    };
}

function admin_payment_status_label(): string {
    return 'Payé';
}
?>
