<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center text-white py-3" style="background-color: #ABDACA;">
            <h2 class="mb-0">Gestion des commandes</h2>
        </div>
        <div class="card-body p-4">
            <table class="table table-hover table-striped align-middle">
                <thead style="background-color: #2C3E50;" class="table-dark text-center">
                    <tr>
                        <th>ID Commande</th>
                        <th>Nom de l'utilisateur</th>
                        <th>Produits</th>
                        <th>Prix total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
    <?php if (empty($orders)): ?>
        <tr>
            <td colspan="6" class="text-muted">Aucune commande trouvée</td>
        </tr>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= esc($order['id']) ?></td>
                <td><?= esc($order['user_name']) ?></td> <!-- Display user name -->
                <td><?= esc($order['product_names']) ?></td> <!-- Display product names -->
                <td><?= esc($order['total_price']) ?> MAD</td>
                <td><?= ucfirst($order['status']) ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Order Actions">
                        <button class="btn btn-sm btn-success validate-order" data-order-id="<?= esc($order['id']) ?>">Valider</button>
                        <button class="btn btn-sm btn-danger decline-order" data-order-id="<?= esc($order['id']) ?>">Décliner</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>

            </table>
        </div>
    </div>
</div>

<!-- Decline Modal -->
<div class="modal" id="declineModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Raison du refus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Veuillez sélectionner la raison du refus :</p>
                <select id="declineReason" class="form-control">
                    <option value="out_of_stock">Rupture de stock</option>
                    <option value="closed">Fermé</option>
                    <option value="other">Autre</option>
                </select>
                <textarea id="declineOtherReason" class="form-control mt-3" placeholder="Autre raison (optionnel)" style="display: none;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmDecline">Confirmer</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<script>
    let declineOrderId = null;

    // Show modal when "Decline" button is clicked
    document.querySelectorAll('.decline-order').forEach(button => {
        button.addEventListener('click', function () {
            declineOrderId = this.getAttribute('data-order-id');
            document.getElementById('declineModal').style.display = 'block'; // Show modal
        });
    });

    // Show "Other" text area if "Other" is selected
    document.getElementById('declineReason').addEventListener('change', function () {
        const otherReasonField = document.getElementById('declineOtherReason');
        if (this.value === 'other') {
            otherReasonField.style.display = 'block';
        } else {
            otherReasonField.style.display = 'none';
        }
    });

    // Handle "Confirm Decline" button
    document.getElementById('confirmDecline').addEventListener('click', function () {
        const reasonSelect = document.getElementById('declineReason');
        const otherReasonField = document.getElementById('declineOtherReason');
        const reason = reasonSelect.value === 'other' ? otherReasonField.value : reasonSelect.value;

        if (!reason) {
            alert('Veuillez fournir une raison pour le refus.');
            return;
        }

        fetch(`<?= base_url('order/updateStatus') ?>`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ id: declineOrderId, status: 'declined', reason: reason }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erreur: ' + data.error);
                }
            })
            .catch(error => {
                console.error(error);
                alert('Erreur: Une erreur inattendue s\'est produite.');
            });

        // Hide modal
        document.getElementById('declineModal').style.display = 'none';
    });

    // Handle "Validate" button click
    document.querySelectorAll('.validate-order').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id'); // Get order ID

            // Send validation request
            fetch(`<?= base_url('order/updateStatus') ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ id: orderId, status: 'validated' }), // Send validation status
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload the page to reflect changes
                    } else {
                        alert('Erreur: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Erreur: Une erreur inattendue s\'est produite.');
                });
        });
    });
</script>

<!-- Add custom styles for button layout -->
<style>
    /* Ensure the buttons are next to each other */
    .btn-group {
        display: flex;
        gap: 10px; /* Adds space between the buttons */
        justify-content: center;
    }

    .btn-group .btn {
        width: auto; /* Ensure buttons only take necessary space */
    }

    /* Optional: Add hover effect to both buttons */
    .btn-group .btn:hover {
        opacity: 0.85;
    }
    
    /* Add custom styling for the buttons if needed */
    .btn-group .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-group .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<?= $this->endSection() ?>
