<?php include __DIR__ . '/partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pet->pet_ID) ? 'Edit Pet' : 'Add Pet' ?> | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        
        .form-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2.5rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        
        .form-title {
            color: #2563eb;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .form-subtitle {
            color: #6b7280;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }
        
        .btn-back {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 114, 128, 0.3);
            color: white;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }
        
        .input-group-text {
            background: #f8fafc;
            border: 2px solid #e5e7eb;
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .required-asterisk {
            color: #ef4444;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
<div class="container" style="margin-top: 120px;">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="form-container">
                <div class="text-center mb-4">
                    <a href="/PetSpot_clinic/public/pets" class="btn-back">
                        <i class="bi bi-arrow-left me-2"></i>Back to My Pets
                    </a>
                </div>
                
                <h1 class="form-title">
                    <i class="bi bi-paw me-2"></i><?= isset($pet->pet_ID) ? 'Edit Pet' : 'Add Pet' ?>
                </h1>
                <p class="form-subtitle">
                    <?= isset($pet->pet_ID) ? 'Update your pet\'s information below.' : 'Register your beloved pet with our clinic.' ?>
                </p>
                
                <?php if (!empty($pet->errors)): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <?php foreach ($pet->errors as $error): ?>
                            <div class="mt-1">• <?= htmlspecialchars($error) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif (!empty($success)): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>
                
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-heart me-2"></i>Pet Name <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-paw"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="e.g., Buddy, Fluffy" value="<?= htmlspecialchars($pet->name ?? '') ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-tag me-2"></i>Pet Type <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-paw"></i></span>
                                <input type="text" name="type" class="form-control" placeholder="e.g., Dog, Cat, Bird" value="<?= htmlspecialchars($pet->type ?? '') ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-palette me-2"></i>Color <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-circle-fill"></i></span>
                                <input type="text" name="color" class="form-control" placeholder="e.g., Brown, White, Mixed" value="<?= htmlspecialchars($pet->color ?? '') ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-gender-ambiguous me-2"></i>Gender <span class="required-asterisk">*</span>
                            </label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="male" <?= (isset($pet->gender) && $pet->gender === 'male') ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= (isset($pet->gender) && $pet->gender === 'female') ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-bookmark me-2"></i>Breed
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-award"></i></span>
                                <input type="text" name="breed" class="form-control" placeholder="e.g., Golden Retriever, Persian" value="<?= htmlspecialchars($pet->breed ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-star me-2"></i>Special Markings
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                <input type="text" name="special_markings" class="form-control" placeholder="Distinctive features, spots, etc." value="<?= htmlspecialchars($pet->special_markings ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-camera me-2"></i>Pet Photo
                        </label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>Upload a clear photo of your pet. Accepted formats: JPG, PNG, GIF
                        </div>
                    </div>
                    
                    <?php if (($pet->status ?? '') === 'lost'): ?>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Lost Pet Information</strong>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-geo-alt me-2"></i>Last Seen Location
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-map"></i></span>
                                    <input type="text" name="last_seen_location" class="form-control" placeholder="Where was your pet last seen?" value="<?= htmlspecialchars($pet->last_seen_location ?? '') ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="bi bi-calendar me-2"></i>Last Seen Date
                                </label>
                                <input type="date" name="last_seen_date" class="form-control" value="<?= htmlspecialchars($pet->last_seen_date ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-chat-text me-2"></i>Special Note
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                <input type="text" name="special_note" class="form-control" placeholder="Any additional information about your lost pet" value="<?= htmlspecialchars($pet->special_note ?? '') ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-circle me-2"></i><?= isset($pet->pet_ID) ? 'Update Pet' : 'Register Pet' ?>
                        </button>
                        <?php if (isset($pet->pet_ID)): ?>
                            <a href="/PetSpot_clinic/public/pets/delete?pet_ID=<?= $pet->pet_ID ?>" class="btn-delete"
                               onclick="return confirm('Are you sure you want to delete this pet?');">
                                <i class="bi bi-trash me-2"></i>Delete Pet
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<footer class="text-center">
    <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>