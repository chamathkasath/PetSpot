<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/aboutus.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
   
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <section class="aboutus-section py-5">
        <div class="container">
            <h1 class="aboutus-title text-center mb-5">About <span class="aboutus-highlight">PetSpot Clinic</span></h1>
            <div class="row justify-content-center mb-5">
                <div class="col-md-6">
                    <p class="lead text-center">
                        Welcome to <span class="aboutus-highlight">PetSpot Clinic</span>! We are passionate about providing the best care for your beloved pets. 
                        Our team is dedicated to ensuring your furry friends are healthy, happy, and part of a loving community.
                    </p>
                </div>
            </div>
            <div class="row g-4 justify-content-center aboutus-img-grid">
                <div class="col-6 col-md-3">
                    <img src="/PetSpot_clinic/public/assets/images/pet3.jpg" class="img-fluid aboutus-img" alt="Pet 3">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/PetSpot_clinic/public/assets/images/pet2.jpg" class="img-fluid aboutus-img" alt="Pet 2">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/PetSpot_clinic/public/assets/images/pet5.jpg" class="img-fluid aboutus-img" alt="Pet 5">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/PetSpot_clinic/public/assets/images/pet7.jpg" class="img-fluid aboutus-img" alt="Pet 7">
                </div>
            </div>

            <!-- Mission & Vision Section with Wavy SVG Background -->
            <section class="mission-vision-wave-section position-relative py-5 mb-5">
                <div class="container position-relative" style="z-index:2;">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h3 class="fw-bold mb-3">Mission</h3>
                            <p class="lead mb-2" style="font-size:1.05rem;">
                                To continue to be the preferred clinical destination for pets.
                            </p>
                            <div style="font-size:0.98rem;">
                                <span class="fw-bold">We will accomplish our mission by:</span>
                                <ul class="aboutus-mission-list text-start mx-auto mt-2">
                                    <li>Providing sensitive care in a clinic purposely designed to minimise pain and stress of pets</li>
                                    <li>Utilising state-of-the-art technology, and offering cutting-edge treatment options</li>
                                    <li>Staffing our teams with qualified, experienced, and compassionate doctors and nurses</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="fw-bold mb-3">Vision</h3>
                            <p class="lead mb-0" style="font-size:1.05rem;">
                                To foster a world where the symbiotic bond between humans and animals is valued and celebrated.
                            </p>
                            <div class="mt-2" style="font-size:0.98rem;">
                                <em>We dream of a future where every pet and owner share a joyful, healthy life together.</em>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- History Section (centered, no box) -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-9">
                    <h3 class="aboutus-highlight text-center mb-3">Our History</h3>
                    <p class="lead text-center aboutus-history-text">
                        Founded with love and compassion, PetSpot Clinic in Piliyandala has been a trusted haven for pets and their owners since its inception. What began as a small local clinic has grown into a full-service pet care center dedicated to keeping tails wagging and purrs going strong. With a passionate team of veterinarians, caregivers, and support staff, we offer expert medical care, wellness check-ups, vaccinations, and personalized attention for every furry friend. At PetSpot, we believe pets are family — and every family deserves care that’s heartfelt, reliable, and always there when needed.
                    </p>
                </div>
            </div>

            <!-- Our Doctors Section -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <h3 class="aboutus-highlight text-center mb-4">Meet Our Expert Team</h3>
                    <div class="row g-4">
                        <!-- Doctor 1 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="doctor-card text-center" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                                <div class="doctor-image mb-3">
                                    <img src="/PetSpot_clinic/public/assets/images/doc1.jpg" alt="Dr. Sarah Johnson" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <h5 class="doctor-name" style="color: #2c3e50; font-weight: 600; margin-bottom: 8px;">Dr. Sarah Johnson</h5>
                                <p class="doctor-specialty" style="color: #17a2b8; font-weight: 500; margin-bottom: 10px;">Lead Veterinarian</p>
                                <p class="doctor-description" style="color: #6c757d; font-size: 0.9rem; line-height: 1.5;">
                                    Specialized in small animal medicine with over 12 years of experience in pet healthcare and surgery.
                                </p>
                            </div>
                        </div>

                        <!-- Doctor 2 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="doctor-card text-center" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                                <div class="doctor-image mb-3">
                                    <img src="/PetSpot_clinic/public/assets/images/doc2.jpg" alt="Dr. Michael Chen" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <h5 class="doctor-name" style="color: #2c3e50; font-weight: 600; margin-bottom: 8px;">Dr. Michael Chen</h5>
                                <p class="doctor-specialty" style="color: #17a2b8; font-weight: 500; margin-bottom: 10px;">Surgery Specialist</p>
                                <p class="doctor-description" style="color: #6c757d; font-size: 0.9rem; line-height: 1.5;">
                                    Expert in advanced surgical procedures and emergency care with a focus on minimally invasive techniques.
                                </p>
                            </div>
                        </div>

                        <!-- Doctor 3 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="doctor-card text-center" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                                <div class="doctor-image mb-3">
                                    <img src="/PetSpot_clinic/public/assets/images/doc3.jpg" alt="Dr. Emily Rodriguez" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <h5 class="doctor-name" style="color: #2c3e50; font-weight: 600; margin-bottom: 8px;">Dr. Emily Rodriguez</h5>
                                <p class="doctor-specialty" style="color: #17a2b8; font-weight: 500; margin-bottom: 10px;">Dermatology Expert</p>
                                <p class="doctor-description" style="color: #6c757d; font-size: 0.9rem; line-height: 1.5;">
                                    Specializes in pet dermatology and allergies, helping pets achieve healthy skin and coat.
                                </p>
                            </div>
                        </div>

                        <!-- Doctor 4 -->
                        <div class="col-lg-3 col-md-6">
                            <div class="doctor-card text-center" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                                <div class="doctor-image mb-3">
                                    <img src="/PetSpot_clinic/public/assets/images/doc4.jpg" alt="Dr. James Wilson" class="img-fluid rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <h5 class="doctor-name" style="color: #2c3e50; font-weight: 600; margin-bottom: 8px;">Dr. James Wilson</h5>
                                <p class="doctor-specialty" style="color: #17a2b8; font-weight: 500; margin-bottom: 10px;">Cardiology Specialist</p>
                                <p class="doctor-description" style="color: #6c757d; font-size: 0.9rem; line-height: 1.5;">
                                    Focuses on cardiovascular health and diagnostic imaging for comprehensive cardiac care.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Principles Section (percentages small and attractive) -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <h2 class="aboutus-title text-center mb-4">Our Principles</h2>
                    <div class="aboutus-principles row g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="principle p-3 h-100 rounded-4 shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="principle-title">Compassion</span>
                                    <span class="principle-percent-badge">100%</span>
                                </div>
                                <div class="principle-progress-bar w-100"></div>
                                <div class="principle-desc small">
                                    We are animal lovers and pet owners ourselves so we understand the power of providing treatment in a kind and empathetic manner. This approach filters through everything we do.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="principle p-3 h-100 rounded-4 shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="principle-title">Integrity</span>
                                    <span class="principle-percent-badge">100%</span>
                                </div>
                                <div class="principle-progress-bar w-100"></div>
                                <div class="principle-desc small">
                                    We are obsessed with doing the right thing. We respect the trust placed in us by our patients’ owners and so undertake to be transparent and fair.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="principle p-3 h-100 rounded-4 shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="principle-title">Responsibility</span>
                                    <span class="principle-percent-badge">100%</span>
                                </div>
                                <div class="principle-progress-bar w-100"></div>
                                <div class="principle-desc small">
                                    We are serious about our responsibility to our patients and their owners. So we are always doing our best in providing world-class treatment.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="principle p-3 h-100 rounded-4 shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="principle-title">Excellence</span>
                                    <span class="principle-percent-badge">100%</span>
                                </div>
                                <div class="principle-progress-bar w-100"></div>
                                <div class="principle-desc small">
                                    We are dedicated to providing outstanding excellence in all our services.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="principle p-3 h-100 rounded-4 shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="principle-title">Teamwork</span>
                                    <span class="principle-percent-badge">100%</span>
                                </div>
                                <div class="principle-progress-bar w-100"></div>
                                <div class="principle-desc small">
                                    We celebrate the unique backgrounds, specialisations and experiences of our diverse team. We function as a holistic and supportive community aligned by mutual respect for each other, the animals we care for and their loving owners.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 text-center">
                    <a href="/PetSpot_clinic/public/feedback/add" class="btn btn-secondary">Leave Feedback</a>
                </div>
            </div>

            <!-- Feedback Section -->
            <div class="feedback-section">
                <?php if (!empty($_SESSION['user_ID'])): ?>
                    <div class="container" style="max-width: 600px;">
                        <div class="feedback-form-card">
                            <h4 class="feedback-title">Share Your Experience</h4>
                            <form method="post" action="/PetSpot_clinic/public/feedback/submit" class="feedback-form">
                                <div class="mb-4 text-center">
                                    <label class="star-rating-label">How would you rate our service?</label>
                                    <div id="star-rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <input type="radio" id="star<?= $i ?>" name="rate" value="<?= $i ?>" style="display:none;">
                                            <label for="star<?= $i ?>">&#9733;</label>
                                        <?php endfor; ?>
                                    </div>
                                    <small class="text-muted">Click on the stars to rate your experience</small>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="form-label">Tell us about your experience</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="5" maxlength="300" placeholder="We'd love to hear about your experience with our clinic. Your feedback helps us improve our services..."></textarea>
                                    <div class="form-text text-end mt-1">
                                        <small class="text-muted">Maximum 300 characters</small>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="feedback-submit-btn">Submit Feedback</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="container" style="max-width: 500px;">
                        <div class="login-message">
                            <h5 class="mb-2">Share Your Feedback</h5>
                            <p class="mb-0">Please <a href="/PetSpot_clinic/public/login">login</a> to share your experience and help us improve our services.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <script>
        // Star rating logic: leftmost is 1, rightmost is 5
        const stars = document.querySelectorAll('#star-rating label');
        const radios = document.querySelectorAll('#star-rating input[type="radio"]');
        let selected = 0;

        function highlightStars(count) {
            stars.forEach((star, idx) => {
                star.style.color = idx < count ? '#ffc107' : '#ffd700';
            });
        }

        stars.forEach((star, idx) => {
            const rate = idx + 1; // leftmost is 1
            star.addEventListener('mouseover', () => highlightStars(rate));
            star.addEventListener('mouseout', () => highlightStars(selected));
            star.addEventListener('click', () => {
                selected = rate;
                radios[idx].checked = true;
                highlightStars(selected);
            });
        });

        // On page load, highlight if already selected (for edit forms)
        document.addEventListener('DOMContentLoaded', () => {
            const checked = Array.from(radios).findIndex(radio => radio.checked);
            if (checked >= 0) {
                selected = checked + 1;
                highlightStars(selected);
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
require_once __DIR__ . '/../models/Feedback.php';
require_once __DIR__ . '/../models/User.php';
$feedbackModel = new Feedback();
$userModel = new User();
$confirmedFeedbacks = $feedbackModel->where(['confirmed' => 1]);
?>

<!-- Testimonials Section -->
<section class="testimonials-section py-5" style="background-color: #126572ff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title" style="color: #dce5eeff; font-weight: 600; margin-bottom: 15px;">What Our Clients Say</h2>
            <p class="section-subtitle" style="color: #dee8f1ff; font-size: 1.1rem;">Real experiences from pet owners who trust us with their beloved companions</p>
        </div>
        
        <?php if (empty($confirmedFeedbacks)): ?>
            <div class="text-center">
                <div class="no-testimonials" style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <h5 class="mb-3" style="color: #2c3e50;">Be the First to Share</h5>
                    <p class="mb-0" style="color: #6c757d;">No testimonials yet. Be the first to share your experience with our clinic!</p>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <?php foreach ($confirmedFeedbacks as $fb): ?>
                    <?php
                        $user = $userModel->first(['user_ID' => $fb->user_ID]);
                        $firstName = $user->first_name ?? '';
                        $lastName = $user->last_name ?? '';
                        $fullName = trim($firstName . ' ' . $lastName);
                    ?>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="testimonial-card" style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); height: 100%;">
                            <div class="testimonial-rating mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span style="color: <?= $i <= $fb->rate ? '#ffc107' : '#e9ecef' ?>; font-size: 1.1rem;">★</span>
                                <?php endfor; ?>
                            </div>
                            
                            <div class="testimonial-content mb-3">
                                <p class="testimonial-text" style="color: #495057; font-style: italic; line-height: 1.5; margin-bottom: 0; font-size: 0.95rem;">
                                    "<?= htmlspecialchars($fb->comment ?? '') ?>"
                                </p>
                            </div>
                            
                            <div class="testimonial-author">
                                <div class="d-flex align-items-center">
                                    <div class="author-avatar" style="width: 40px; height: 40px; background: #17a2b8; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <span style="color: white; font-weight: 600; font-size: 1rem;">
                                            <?= strtoupper(substr($firstName, 0, 1)) ?><?= $lastName ? strtoupper(substr($lastName, 0, 1)) : '' ?>
                                        </span>
                                    </div>
                                    <div>
                                        <div class="author-name" style="color: #2c3e50; font-weight: 500; font-size: 0.9rem;">
                                            <?= htmlspecialchars($fullName) ?>
                                        </div>
                                        <div class="author-date" style="color: #9ca3af; font-size: 0.8rem;">
                                            <?= date('M d, Y', strtotime($fb->created_at)) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter Section with Wavy Background -->

<footer class="text-center">
    
   <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>