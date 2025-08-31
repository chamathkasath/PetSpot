<!-- Standard Admin Styles -->
<style>
    body {
        background: #f4f7fa;
        min-height: 100vh;
    }
    .sidebar {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        min-height: 100vh;
        color: #fff;
        padding: 2rem 1rem;
    }
    .sidebar .nav-link {
        color: #fff;
        font-weight: 500;
        margin-bottom: 1rem;
        border-radius: 8px;
        transition: background 0.2s;
    }
    .sidebar .nav-link.active, .sidebar .nav-link:hover {
        background: rgba(255,255,255,0.15);
    }
    .sidebar .brand {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .dashboard-card {
        box-shadow: 0 4px 24px rgba(80,112,255,0.08);
        border-radius: 18px;
        margin-bottom: 24px;
        background: #fff;
        border: none;
        transition: transform 0.2s;
    }
    .dashboard-card:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 8px 32px rgba(80,112,255,0.13);
    }
    .dashboard-card .card-title {
        font-size: 1.2rem;
        color: #4f8cff;
        font-weight: 700;
    }
    .dashboard-card .card-text {
        font-size: 2.5rem;
        font-weight: 800;
        color: #222;
    }
    .section-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #222;
        margin-bottom: 2.5rem;
        letter-spacing: 1px;
    }
    @media (max-width: 767.98px) {
        .dashboard-card .card-text {
            font-size: 1.5rem;
        }
        .section-title {
            font-size: 1.3rem;
        }
    }
</style>
