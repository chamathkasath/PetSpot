<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\admin\reports.view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports & Analysis | PetSpot Clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <?php include __DIR__ . '/../partials/admin_styles.php'; ?>
    <style>
        .export-btn {
            min-width: 220px;
            margin: 12px 0;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 30px;
            background: linear-gradient(90deg, #4f8cff 60%, #38b000 100%);
            border: none;
            color: #fff;
            box-shadow: 0 2px 8px rgba(80,112,255,0.10);
            transition: background 0.2s, transform 0.2s;
        }
        .export-btn:hover {
            background: linear-gradient(90deg, #38b000 60%, #4f8cff 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.04);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php $currentPage = 'reports'; include __DIR__ . '/../partials/admin_sidebar.php'; ?>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Existing content -->
            <div class="container py-5">
                <h2 class="section-title text-center mb-5">Reports & Analysis</h2>
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-4">
                        <div class="card text-center dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Registered Users</h5>
                                <p class="card-text"><?= $totalUsers ?? '--' ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Adopted Pets</h5>
                                <p class="card-text"><?= $totalAdoptedPets ?? '--' ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Found Pets</h5>
                                <p class="card-text"><?= $totalFoundPets ?? '--' ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback Rating Analysis -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h3 class="text-center mb-4" style="color: #4f8cff; font-weight: 700;">Feedback Rating Analysis</h3>
                    </div>
                </div>
                
                <!-- Rating Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-center dashboard-card" style="background: linear-gradient(135deg, #5371f3ff 0%); color: white;">
                            <div class="card-body">
                                <h3><?= $totalFeedback ?></h3>
                                <p class="mb-0">Total Feedbacks</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center dashboard-card" style="background: linear-gradient(135deg, #5371f3ff 0%); color: white;">
                            <div class="card-body">
                                <h3><?= $averageRating ?> <i class="bi bi-star-fill"></i></h3>
                                <p class="mb-0">Average Rating</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center dashboard-card" style="background: linear-gradient(135deg, #5371f3ff 0%); color: white;">
                            <div class="card-body">
                                <h3><?= $ratingCounts[5] ?></h3>
                                <p class="mb-0">5-Star Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Distribution -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card dashboard-card">
                            <div class="card-header">
                                <h5 class="mb-0" style="color: #4f8cff; font-weight: 700;">Rating Distribution</h5>
                            </div>
                            <div class="card-body">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-2"><?= $i ?> <i class="bi bi-star-fill text-warning"></i></span>
                                        <div class="progress flex-grow-1 me-2" style="height: 20px;">
                                            <div class="progress-bar bg-warning" style="width: <?= $totalFeedback > 0 ? ($ratingCounts[$i] / $totalFeedback) * 100 : 0 ?>%"></div>
                                        </div>
                                        <span class="text-muted"><?= $ratingCounts[$i] ?></span>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pets Statistics Chart -->
                <div class="row mb-5 justify-content-center">
                    <div class="col-12">
                        <div class="card dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title text-center mb-4">Monthly Pet Statistics - <?= date('Y') ?></h5>
                                <div style="height: 300px; width: 100%; position: relative;">
                                    <canvas id="petsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Chart -->
                <div class="row mb-5 justify-content-center">
                    <div class="col-12">
                        <div class="card dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title text-center mb-4">Monthly Revenue - <?= date('Y') ?></h5>
                                <div style="height: 300px; width: 100%; position: relative;">
                                    <canvas id="revenueChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <a href="/PetSpot_clinic/public/admin/export_pets_lost_active" class="btn export-btn w-100 mb-3">
                            <i class="bi bi-file-earmark-excel"></i> Export Lost & Active Pets
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <a href="/PetSpot_clinic/public/admin/export_found_pets" class="btn export-btn w-100 mb-3">
                            <i class="bi bi-file-earmark-excel"></i> Export Found Pets
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <a href="/PetSpot_clinic/public/admin/export_adopted_pets" class="btn export-btn w-100 mb-3">
                            <i class="bi bi-file-earmark-excel"></i> Export Adopted Pets
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <a href="/PetSpot_clinic/public/admin/export_appointments" class="btn export-btn w-100 mb-3">
                            <i class="bi bi-file-earmark-excel"></i> Export Appointments
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <a href="/PetSpot_clinic/public/admin/export_vaccinations" class="btn export-btn w-100 mb-3">
                            <i class="bi bi-file-earmark-excel"></i> Export Vaccinations
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 d-flex justify-content-center">
                        <a href="/PetSpot_clinic/public/admin/export_payments" class="btn export-btn w-100 mb-3">
                            <i class="bi bi-file-earmark-excel"></i> Export Payments
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Pets Chart Data
const lostPetsData = <?= json_encode(array_values($lostPetsPerMonth)) ?>;
const foundPetsData = <?= json_encode(array_values($foundPetsPerMonth)) ?>;
const adoptedPetsData = <?= json_encode(array_values($adoptedPetsPerMonth)) ?>;

// Revenue Chart Data
const revenueData = <?= json_encode(array_values($revenuePerMonth)) ?>;

const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Create Pets Chart
const petsCtx = document.getElementById('petsChart').getContext('2d');
new Chart(petsCtx, {
    type: 'line',
    data: {
        labels: monthLabels,
        datasets: [{
            label: 'Lost Pets',
            data: lostPetsData,
            borderColor: '#dc3545',
            backgroundColor: 'rgba(220, 53, 69, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }, {
            label: 'Found Pets',
            data: foundPetsData,
            borderColor: '#ffc107',
            backgroundColor: 'rgba(255, 193, 7, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }, {
            label: 'Adopted Pets',
            data: adoptedPetsData,
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: 20
        },
        plugins: {
            title: {
                display: true,
                text: 'Pet Statistics Throughout the Year',
                font: {
                    size: 14,
                    weight: 'bold'
                }
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 12,
                    padding: 15
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                },
                ticks: {
                    stepSize: 1,
                    font: {
                        size: 11
                    }
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        elements: {
            point: {
                radius: 3,
                hoverRadius: 5
            }
        }
    }
});

// Create Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'bar',
    data: {
        labels: monthLabels,
        datasets: [{
            label: 'Revenue (LKR)',
            data: revenueData,
            backgroundColor: 'rgba(79, 140, 255, 0.7)',
            borderColor: '#4f8cff',
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: 20
        },
        plugins: {
            title: {
                display: true,
                text: 'Monthly Revenue Generated',
                font: {
                    size: 14,
                    weight: 'bold'
                }
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 12,
                    padding: 15
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': LKR ' + context.parsed.y.toFixed(2);
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                },
                ticks: {
                    stepSize: 100,
                    font: {
                        size: 11
                    },
                    callback: function(value) {
                        return 'LKR ' + value;
                    }
                }
            },
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        }
    }
});
</script>

</body>
</html>