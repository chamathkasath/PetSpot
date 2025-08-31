<?php
// Only include header for regular users, not for managers
if (!isset($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
    include __DIR__ . '/../partials/header.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Found Pet | PetSpot Clinic</title>
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
<?php if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Manager'): ?>
    <div class="container mt-3">
        <a href="/PetSpot_clinic/public/manager/manager-found" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left me-2"></i>Go Back
        </a>
    </div>
<?php endif; ?>
<div class="container" style="margin-top: <?php echo (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Manager') ? '20px' : '120px'; ?>;">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="form-container">
                <div class="text-center mb-4">
                    <a href="/PetSpot_clinic/public/view-found-pets" class="btn-back">
                        <i class="bi bi-arrow-left me-2"></i>Back to Found Pets
                    </a>
                </div>
                
                <h1 class="form-title">
                    <i class="bi bi-paw me-2"></i>Report Found Pet
                </h1>
                <p class="form-subtitle">
                    Help us reunite lost pets with their families by providing detailed information about the pet you found.
                </p>
                
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-tag me-2"></i>Pet Type <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-paw"></i></span>
                                <input type="text" name="type" class="form-control" placeholder="e.g., Dog, Cat, Bird" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-bookmark me-2"></i>Breed <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-award"></i></span>
                                <input type="text" name="breed" class="form-control" placeholder="e.g., Golden Retriever, Persian" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-gender-ambiguous me-2"></i>Gender <span class="required-asterisk">*</span>
                            </label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-palette me-2"></i>Color <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-circle-fill"></i></span>
                                <input type="text" name="color" class="form-control" placeholder="e.g., Brown, White, Mixed" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-star me-2"></i>Special Markings
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                            <input type="text" name="special_markings" class="form-control" placeholder="Describe any distinctive features, spots, scars, etc.">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-calendar me-2"></i>Found Date <span class="required-asterisk">*</span>
                            </label>
                            <input type="date" name="found_date" class="form-control" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-envelope me-2"></i>Your Email <span class="required-asterisk">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-at"></i></span>
                                <input type="email" name="reporter_email" class="form-control" placeholder="your.email@example.com" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-geo-alt me-2"></i>Found Location <span class="required-asterisk">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-map"></i></span>
                            <input type="text" name="found_location" class="form-control" placeholder="Where exactly did you find this pet?" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-camera me-2"></i>Pet Photo <span class="required-asterisk">*</span>
                        </label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>Please upload a clear photo of the pet. Accepted formats: JPG, PNG, GIF
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-circle me-2"></i>Submit Report
                        </button>
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
    <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>