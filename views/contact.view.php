<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Header CSS -->
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <!-- Custom Contact CSS (if you want to separate) -->
    <!-- <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/contact.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Open Sans', Arial, sans-serif;
        }
        .contact-title {
            font-family: 'Pacifico', cursive;
            font-size: 2rem;
            color: #231f20;
        }
        .contact-label {
            font-weight: 600;
            color:rgb(47, 159, 234);
        }
        .contact-info-icon {
            color:rgb(41, 152, 221);
            font-size: 1.3rem;
            margin-right: 0.5rem;
        }
        .contact-section {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44,83,100,0.08);
            padding: 2.5rem 2rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
        .contact-link {
            color:rgb(32, 133, 110);
            text-decoration: none;
        }
        .contact-link:hover {
            text-decoration: underline;
        }
        .contact-form input,
        .contact-form textarea {
            background: #f5f4f4;
            border: none;
            border-radius: 2rem;
            padding-left: 1.2rem;
        }
        .contact-form textarea {
            border-radius: 2rem;
            min-height: 160px;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            box-shadow: 0 0 0 2px #8e44ad33;
        }
        .contact-form .form-check-input {
            border-radius: 0.3rem;
        }
        .contact-form .btn-primary {
            background:rgb(46, 118, 206);
            border: none;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 1.2rem;
            padding: 0.7rem 2.5rem;
            margin-top: 1rem;
        }
        .contact-form .btn-primary:hover {
            background:rgb(36, 151, 159);
        }
        @media (max-width: 991.98px) {
            .contact-section {
                padding: 1.5rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <div class="container contact-section">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="contact-title mb-3">Contact Info</div>
                <div class="mb-3">
                    <span class="contact-label"><i class="bi bi-geo-alt-fill contact-info-icon"></i>Petspot Clinic</span><br>
                    98/4, asaliya road,<br>
                    Piliyandala, Sri Lanka<br>
                    <a href="#" class="contact-link">(see location)</a>
                </div>
                <div class="mb-3">
                    <span class="contact-label"><i class="bi bi-telephone-fill contact-info-icon"></i>Phone</span><br>
                    General line: <span class="text-danger">+94 11 259 9799</span> / <span class="text-danger">+94 11 259 9800</span> (8.30AM-9PM)<br>
                    24hr Emergency line: <span class="text-danger">+94 777 738 838</span>
                </div>
                <div class="mb-3">
                    <span class="contact-label"><i class="bi bi-envelope-fill contact-info-icon"></i>Email</span><br>
                    <a href="mailto:info@petvet.lk" class="contact-link">petspotclinic@.gmail.com</a>
                </div>
                <div class="mb-3">
                    <span class="contact-label"><i class="bi bi-clock-fill contact-info-icon"></i>Office Hours</span><br>
                    Mon-Sun 8:30 am – 9:00 pm
                </div>
            </div>
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-title mb-3">Need help? Send us a message</div>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">Thank you for contacting us! We will get back to you soon.</div>
                <?php elseif (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form class="contact-form" method="post" action="">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <input type="text" class="form-control" name="name" placeholder="Your name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Your e-mail" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="message" placeholder="Your message" rows="5" required></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="privacyCheck" required>
                        <label class="form-check-label" for="privacyCheck">
                            I agree that my submitted data is being collected and stored. For further details on handling user data, see our
                            <a href="#" class="contact-link">Privacy Policy</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<footer class="text-center">
    
   <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>
</body>
</html>