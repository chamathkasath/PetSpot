<?php include __DIR__ . '/partials/header.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
 <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
</head>
<body>


<!-- Hero Section -->
<section class="hero-section position-relative center-section">
    <div class="hero-slideshow">
        <div class="hero-slide"></div>
        <div class="hero-slide"></div>
        <div class="hero-slide"></div>
        <div class="hero-slide"></div>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content container">
        <h1>Committed to Excellence in Pet Care</h1>
        <p>We care for your pets like family. Trusted Pet Clinic in Piliyandala, Sri Lanka.</p>
        <a href="#about" class="hero-btn">Enquire Now</a>
    </div>
</section>

<!-- Services Section -->
<section class="services-section center-section" id="services">
    <div class="container">
        <h2 class="mb-5" style="color:#38b000;font-family:Pacifico,cursive;">Services</h2>
        <div class="row justify-content-center g-4">
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/h8.jpg" class="service-img" alt="General Checkup" style="width: 250px; height: 250px;"> <!-- Increased size -->
                <div class="service-title">General Checkup</div>
                <div class="text-muted small">Routine health assessments to monitor your pet’s overall well-being and detect any issues early for a healthier, happier life.</div>
            </div>
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/b5.jpg" class="service-img" alt="Vaccinations" style="width: 250px; height: 250px;"> <!-- Increased size -->
                <div class="service-title">Vaccinations</div>
                <div class="text-muted small">Essential vaccinations to protect your pets from common diseases and ensure their long-term health and safety.</div>
            </div>
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/pet2.jpg" class="service-img" alt="Emergency Care" style="width: 250px; height: 250px;"> <!-- Increased size -->
                <div class="service-title">Emergency Care</div>
                <div class="text-muted small">Immediate and professional care for urgent medical situations, providing your pet with the attention they need in emergencies.</div>
            </div>
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/b3.jpg" class="service-img" alt="Adoption Pets" style="width: 250px; height: 250px;"> <!-- Increased size -->
                <div class="service-title">Adoption Pets</div>
                <div class="text-muted small">Looking to add a new member to your family? We help connect loving families with pets in need of a forever home.</div>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->


<section class="about-us-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <video class="home-video" src="/PetSpot_clinic/public/assets/images/petvideo1.mp4" controls autoplay muted loop playsinline disablepictureinpicture controlslist="nodownload nofullscreen noremoteplayback"></video>
            </div>
            <div class="col-md-6 text-center text-md-start">
                <h2 class="about-title mb-3">About Us</h2>
                <p class="about-desc mb-3">
                    At <strong>PetSpot Clinic</strong>, we offer compassionate veterinary care for pets of all kinds. 
                    From regular check-ups and vaccinations to advanced treatments, our dedicated team ensures that your furry family members stay happy and healthy.
                </p>
                <p class="about-desc">
                    We also provide grooming, nutritional advice, and emergency services—because your pet deserves the very best care every day.
                </p>
                <a href="/PetSpot_clinic/public/aboutus" class="btn btn-primary">View More</a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5 text-center">
    <div class="container">
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-search feature-icon"></i>
                    </div>
                    <h3 class="feature-title">Lost Pet Report</h3>
                    <p class="feature-desc">Report your lost pet to help us locate and reunite you with your beloved companion.</p>
                    <a href="/PetSpot_clinic/public/pets/lost" class="btn btn-dark">Read More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-paw feature-icon"></i>
                    </div>
                    <h3 class="feature-title">Found Pet Report</h3>
                    <p class="feature-desc">Notify us about a pet you’ve found to help connect them with their rightful owner.</p>
                    <a href="/PetSpot_clinic/public/found-pet" class="btn btn-dark">Read More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-home feature-icon"></i>
                    </div>
                    <h3 class="feature-title">Adopt a Pet</h3>
                    <p class="feature-desc">Find your perfect furry friend and give them a loving home through our adoption program.</p>
                    <a href="/PetSpot_clinic/public/found-pet" class="btn btn-dark">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Doctors Section -->
<section class="doctors-section center-section text-center" id="doctors" style="background: #f8fafc; padding: 60px 0;">
    <div class="container">
        <h2 class="doctors-title mb-5" style="color:#2563eb;font-family:'Pacifico',cursive;">Our Doctors</h2>
        <div class="row justify-content-center g-5">
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/doc1.jpg" class="doctor-photo" alt="Dr Nalinika Obeysekere" style="border: 4px solid #38b000; box-shadow: 0 2px 12px rgba(44,83,100,0.10);">
                <div class="doctor-name mt-3" style="font-weight:700; font-size:1.15rem; color:#222;">Dr Nalinika Obeysekere</div>
                <div class="doctor-qual mb-2" style="color:#555;">MVS (Aus), BVSc.(SL), FSL CVS</div>
                <div class="doctor-desc" style="color:#444;">WSAVA One Medicine One Health (2015), WSAVA Animal Welfare (2018) awarded by the World Small Animal Veterinary Association</div>
            </div>
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/doc2.jpg" class="doctor-photo" alt="Dr Nalinika Obeysekere" style="border: 4px solid #38b000; box-shadow: 0 2px 12px rgba(44,83,100,0.10);">
                <div class="doctor-name mt-3" style="font-weight:700; font-size:1.15rem; color:#222;">Dr Janaki Collure</div>
                <div class="doctor-qual mb-2" style="color:#555;">BVSc (Hons) SL</div>
                <div class="doctor-desc" style="color:#444; font-style:italic;">‘The [human-animal bond] is among the most amazing relationships on our planet. It ensures unconditional love, affection, happiness, and companionship - always!’</div>
            </div>
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/doc3.jpg" class="doctor-photo" alt="Dr Nalinika Obeysekere" style="border: 4px solid #38b000; box-shadow: 0 2px 12px rgba(44,83,100,0.10);">
                <div class="doctor-name mt-3" style="font-weight:700; font-size:1.15rem; color:#222;">Dr Vipuli Kulasekera</div>
                <div class="doctor-qual mb-2" style="color:#555;">BVSc (SL), MVS (SL)</div>
                <div class="doctor-desc" style="color:#444;">Specializes in small animal medicine and surgery. Passionate about animal welfare and client education.</div>
            </div>
            <div class="col-md-3 col-6 d-flex flex-column align-items-center">
                <img src="/PetSpot_clinic/public/assets/images/doc4.jpg" class="doctor-photo" alt="Dr Nalinika Obeysekere" style="border: 4px solid #38b000; box-shadow: 0 2px 12px rgba(44,83,100,0.10);">
                <div class="doctor-name mt-3" style="font-weight:700; font-size:1.15rem; color:#222;">Dr Chamara Perera</div>
                <div class="doctor-qual mb-2" style="color:#555;">BVSc (SL)</div>
                <div class="doctor-desc" style="color:#444; font-style:italic;">"Dedicated to providing compassionate care and ensuring the well-being of every pet that visits our clinic."</div>
            </div>
        </div>
    </div>
</section>
<!-- Popup Iframe -->
<div class="chat-icon" onclick="toggleGlobalChatPopup()" style="position: fixed; bottom: 30px; right: 30px; z-index: 9999;">
    <i class="fa-regular fa-comments"></i>
    <span id="chat-badge" style="background:red;color:#fff;border-radius:50%;padding:2px 7px;font-size:13px;display:none;position:absolute;top:8px;right:8px;min-width:20px;text-align:center;font-weight:bold;box-shadow:0 2px 6px rgba(0,0,0,0.15);">0</span>
</div>

<!-- Chat Popup -->
<div id="global-chat-popup-container" style="display:none; position:fixed; bottom:100px; right:30px; width:370px; height:540px; border-radius:20px; border:1px solid #e0e0e0; box-shadow: 0 8px 32px rgba(44,83,100,0.18); z-index:10000; background:#fff; overflow:hidden;">
    <iframe id="global-chat-popup-frame" src="/PetSpot_clinic/public/chat" style="width:100%; height:100%; border:none; border-radius:20px;"></iframe>
</div>
<script>
function toggleGlobalChatPopup() {
    const popup = document.getElementById('global-chat-popup-container');
    popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';

    if (popup.style.display === 'block') {
        const chatBadge = document.getElementById('chat-badge');
        if (chatBadge) chatBadge.style.display = 'none';
        notifCount = 0;
    }
}
</script>

<!-- Latest Tips & News Section -->
<section class="tips-news-section py-5" style="padding: 40px 0;"> <!-- Keep padding unchanged -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <img src="/PetSpot_clinic/public/assets/images/ho3.jpg" class="img-fluid rounded" alt="Pet Tips" style="max-height: 400px; object-fit: cover;"> <!-- Increased height -->
            </div>
            <div class="col-md-6 text-center text-md-start">
                <h2 class="tips-title mb-3" style="font-family: 'Roboto', sans-serif;">Latest Tips & News</h2>
                <div class="tip" style="color: white; font-family: 'Roboto', sans-serif;">
                    <h3>Keep Your Pet Hydrated</h3>
                    <p>Always provide fresh water, especially during hot days, to keep your pet healthy and energetic.</p>
                </div>
                <div class="tip" style="color: white; font-family: 'Roboto', sans-serif;">
                    <h3>Balanced Diet is Key</h3>
                    <p>Feed your pet a balanced diet suitable for their age, size, and health needs.</p>
                </div>
                <div class="tip" style="color: white; font-family: 'Roboto', sans-serif;">
                    <h3>Regular Vet Checkups</h3>
                    <p>Schedule routine visits to the vet to catch any health issues early.</p>
                </div>
                <a href="/PetSpot_clinic/public/blogs" class="btn btn-primary">See More</a>
            </div>
        </div>
    </div>
</section>
<!-- Pet Promise Section -->
<section class="pet-promise-section py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                <div class="pet-promise-img-wrapper">
                    <img src="/PetSpot_clinic/public/assets/images/b2.jpg" alt="Happy Pet" class="pet-promise-img">
                    <div class="pet-promise-img-text">
                        Happy pets,<br>happy humans
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-start">
    <div class="pet-promise-label mb-2">Our Commitment to Care</div>
    <h2 class="pet-promise-title mb-3">Healthy Pets,<br>Happy Families</h2>
    <p class="pet-promise-desc mb-2">
        At PetSpot Clinic, we believe every pet deserves the best care and every family deserves peace of mind. 
        From vaccinations to wellness check-ups, we’re here to keep tails wagging and hearts happy.
    </p>
    <p class="pet-promise-desc">
        Join us in creating a healthier, happier life for your beloved pets. Because their happiness is our passion!
    </p>
</div>

        </div>
    </div>

<footer class="text-center">
    
   <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


