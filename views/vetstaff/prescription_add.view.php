<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\prescription_add.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Prescription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-body">
            <h2 class="text-center text-primary mb-4"><i class="bi bi-file-medical"></i> Add Prescription</h2>
            
            <!-- Owner Dropdown -->
            <form method="get" class="mb-4">
                <div class="mb-3">
                    <label for="owner_dropdown" class="form-label"><i class="bi bi-person"></i> Select Owner:</label>
                    <select name="user_ID" id="owner_dropdown" class="form-select" onchange="if(this.value) window.location='?user_ID='+this.value;">
                        <option value="">-- Select Owner --</option>
                        <?php if (!empty($allUsers)): ?>
                            <?php foreach ($allUsers as $user): ?>
                                <option value="<?= $user->user_ID ?>" <?= (isset($_GET['user_ID']) && $_GET['user_ID'] == $user->user_ID) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user->fullname) ?> (<?= htmlspecialchars($user->email) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </form>

            <!-- Search Owner -->
            <form method="get" class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" name="owner_name" id="owner_name" class="form-control" placeholder="Search Owner Name" value="<?= htmlspecialchars($_GET['owner_name'] ?? '') ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            <?php if (!empty($users) && !$selectedOwner): ?>
                <div class="alert alert-info">Multiple owners found. Please refine your search.</div>
                <ul class="list-group">
                    <?php foreach ($users as $user): ?>
                        <li class="list-group-item"><?= htmlspecialchars($user->fullname) ?> (<?= htmlspecialchars($user->email) ?>)</li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($selectedOwner): ?>
                <div class="alert alert-secondary">
                    <strong>Owner:</strong> <?= htmlspecialchars($selectedOwner->fullname) ?> (<?= htmlspecialchars($selectedOwner->email) ?>)
                </div>
                <?php if (!empty($pets)): ?>
                    <form method="post">
                        <input type="hidden" name="user_ID" value="<?= $selectedOwner->user_ID ?>">
                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-shield"></i> Select Pet:</label><br>
                            <?php foreach ($pets as $pet): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input pet-radio" type="radio" name="pet_ID" id="pet<?= $pet->pet_ID ?>" value="<?= $pet->pet_ID ?>" required>
                                    <label class="form-check-label" for="pet<?= $pet->pet_ID ?>"><?= htmlspecialchars($pet->name) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mb-4" id="appointment-select-wrapper" style="display:none;">
                            <label class="form-label"><i class="bi bi-calendar-event"></i> Select Appointment:</label>
                            <select name="appointment_ID" id="appointment-select" class="form-select" required>
                                <option value="">-- Select Appointment --</option>
                                <!-- Options will be filled by JS -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-capsule"></i> Medicines, Dosage & Drink Times</label>
                            <table class="table table-bordered table-hover" id="medicines-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Medicine</th>
                                        <th>Dosage</th>
                                        <th>Drink Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="medicines[]" class="form-control" required></td>
                                        <td><input type="text" name="dosages[]" class="form-control" required></td>
                                        <td><input type="text" name="drink_times[]" class="form-control" required></td>
                                        <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-trash"></i> Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-secondary btn-sm" id="add-medicine"><i class="bi bi-plus-circle"></i> Add Medicine</button>
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-chat-left-text"></i> Note</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Add Prescription</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning">This owner has no pets registered.</div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success mt-4"><i class="bi bi-check-circle"></i> Prescription added successfully!</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById('add-medicine').addEventListener('click', function() {
    var table = document.getElementById('medicines-table').getElementsByTagName('tbody')[0];
    var newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    table.appendChild(newRow);
});

document.getElementById('medicines-table').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-row')) {
        var table = document.getElementById('medicines-table').getElementsByTagName('tbody')[0];
        if (table.rows.length > 1) {
            e.target.closest('tr').remove();
        }
    }
});

const appointmentsByPet = <?= json_encode($appointmentsByPet ?? []) ?>;
document.querySelectorAll('.pet-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        const petId = this.value;
        const select = document.getElementById('appointment-select');
        select.innerHTML = '<option value="">-- Select Appointment --</option>';
        if (appointmentsByPet[petId] && appointmentsByPet[petId].length > 0) {
            appointmentsByPet[petId].forEach(app => {
                const option = document.createElement('option');
                option.value = app.appointment_ID;
                option.text = `${app.time} | ${app.reason}`;
                select.appendChild(option);
            });
            document.getElementById('appointment-select-wrapper').style.display = '';
            select.required = true;
        } else {
            document.getElementById('appointment-select-wrapper').style.display = 'none';
            select.required = false;
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>