<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UniFest 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2C3E50;
            --secondary: #E74C3C;
            --accent: #F39C12;
            --success: #27AE60;
            --warning: #F1C40F;
            --info: #3498DB;
            --light: #ECF0F1;
            --dark: #2C3E50;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(to bottom, var(--primary), #1a252f);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 1rem;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.8rem 1.5rem;
            border-left: 4px solid transparent;
            transition: all 0.3s;
            margin: 2px 0;
        }

        .sidebar .nav-link.active, 
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            border-left: 4px solid var(--accent);
            color: white;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }

        /* Main Content */
        .content {
            margin-left: 250px;
            padding: 2rem;
            transition: all 0.3s;
        }

        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border-radius: 10px;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-radius: 10px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0.5rem 0;
        }

        .stat-label {
            color: var(--dark);
            font-weight: 500;
        }

        /* Progress Bars */
        .progress {
            height: 8px;
            margin: 5px 0;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background-color: #1a252f;
        }

        /* Tables */
        .table th {
            background-color: var(--primary);
            color: white;
            border: none;
        }
        
        /* Improved Quick Actions */
        .quick-actions .btn {
            padding: 0.75rem;
            font-size: 0.9rem;
        }
        
        /* Form Sections */
        .form-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* Tabs */
        .nav-tabs .nav-link.active {
            background-color: var(--primary);
            color: white;
            border: none;
        }
        
        /* Modal */
        .modal-header {
            background-color: var(--primary);
            color: white;
        }
        
        /* Loading animation */
        .btn-loading {
            position: relative;
        }
        
        .btn-loading .btn-text {
            visibility: visible;
        }
        
        .btn-loading.loading .btn-text {
            visibility: hidden;
        }
        
        .btn-loading.loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: button-loading-spinner 1s ease infinite;
        }
        
        @keyframes button-loading-spinner {
            from {
                transform: rotate(0turn);
            }
            to {
                transform: rotate(1turn);
            }
        }
        
        /* Dashboard Sections */
        .dashboard-section {
            display: none;
        }
        
        .dashboard-section.active {
            display: block;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .sidebar .nav-link span,
            .sidebar-header h4,
            .sidebar-header small {
                display: none;
            }
            
            .sidebar .nav-link {
                text-align: center;
                padding: 0.8rem 0.5rem;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
            }
            
            .content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header text-center">
            <h4><i class="fas fa-user-shield me-2"></i>Admin Panel</h4>
            <small class="text-muted">UniFest 2026</small>
        </div>
        <nav class="nav flex-column">
            <a href="#" class="nav-link active" data-section="dashboard">
                <i class="fas fa-home me-2"></i><span>Dashboard</span>
            </a>
            <a href="#" class="nav-link" data-section="colleges">
                <i class="fas fa-university me-2"></i><span>Manage Colleges</span>
            </a>
            <a href="#" class="nav-link" data-section="competitions">
                <i class="fas fa-trophy me-2"></i><span>Competitions</span>
            </a>
            <a href="#" class="nav-link" data-section="judges">
                <i class="fas fa-gavel me-2"></i><span>Manage Judges</span>
            </a>
            <a href="#" class="nav-link" data-section="stage-controllers">
                <i class="fas fa-users-cog me-2"></i><span>Stage Controllers</span>
            </a>
            <a href="#" class="nav-link" data-section="results">
                <i class="fas fa-chart-line me-2"></i><span>Results & Analytics</span>
            </a>
            <a href="#" class="nav-link" data-section="settings">
                <i class="fas fa-cog me-2"></i><span>System Settings</span>
            </a>
            <div class="mt-auto">
                <a href="../index.php" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i><span>Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom rounded">
            <div class="container-fluid">
                <h4 class="mb-0 text-dark" id="pageTitle">
                    <i class="fas fa-graduation-cap me-2"></i>Admin Dashboard
                </h4>
                <div class="navbar-text">
                    <span class="text-muted">Welcome,</span> 
                    <strong>University Admin</strong>
                    <span class="badge bg-primary ms-2">Super Admin</span>
                </div>
            </div>
        </nav>
        
        <!-- Dashboard Section -->
        <div id="dashboard" class="dashboard-section active">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="stat-number">15</div>
                        <div class="stat-label">Total Colleges</div>
                        <small class="text-success">+2 this week</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="stat-number">24</div>
                        <div class="stat-label">Competitions</div>
                        <small class="text-info">8 ongoing</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="stat-number">342</div>
                        <div class="stat-label">Participants</div>
                        <small class="text-warning">Active</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Judges</div>
                        <small class="text-success">All active</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body quick-actions">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <button class="btn btn-primary w-100 mb-2" onclick="showSection('colleges')">
                                        <i class="fas fa-plus me-2"></i>Add College
                                    </button>
                                </div>
                                <div class="col-md-3 text-center">
                                    <button class="btn btn-success w-100 mb-2" onclick="showSection('competitions')">
                                        <i class="fas fa-trophy me-2"></i>Create Competition
                                    </button>
                                </div>
                                <div class="col-md-3 text-center">
                                    <button class="btn btn-warning w-100 mb-2" onclick="showSection('judges')">
                                        <i class="fas fa-gavel me-2"></i>Assign Judges
                                    </button>
                                </div>
                                <div class="col-md-3 text-center">
                                    <button class="btn btn-info w-100 mb-2" onclick="showSection('results')">
                                        <i class="fas fa-chart-bar me-2"></i>View Reports
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Pending Approvals -->
            <div class="row">
                <!-- Recent Colleges -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-university me-2"></i>Recent Colleges</h5>
                            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">ABC College of Engineering</h6>
                                        <small class="text-muted">Registered: Today</small>
                                    </div>
                                    <span class="badge bg-success">Active</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">XYZ University</h6>
                                        <small class="text-muted">Registered: 2 days ago</small>
                                    </div>
                                    <span class="badge bg-success">Active</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">LMN Institute</h6>
                                        <small class="text-muted">Registered: 1 week ago</small>
                                    </div>
                                    <span class="badge bg-warning">Pending</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Results Approval -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Pending Approvals</h5>
                            <span class="badge bg-danger">3 pending</span>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Code Marathon Results</h6>
                                            <small class="text-muted">All judges completed evaluation</small>
                                        </div>
                                        <button class="btn btn-sm btn-success">Review</button>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Dance Competition</h6>
                                            <small class="text-muted">4/5 judges completed</small>
                                        </div>
                                        <button class="btn btn-sm btn-warning">Review</button>
                                    </div>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-warning" style="width: 80%">80%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ongoing Competitions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-running me-2"></i>Ongoing Competitions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Competition</th>
                                            <th>Category</th>
                                            <th>Participants</th>
                                            <th>Judges</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>Code Marathon</strong>
                                                <br><small class="text-muted">Technical</small>
                                            </td>
                                            <td><span class="badge bg-info">Technical</span></td>
                                            <td>25/30</td>
                                            <td>5/5 assigned</td>
                                            <td><span class="badge bg-success">Live</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">View</button>
                                                <button class="btn btn-sm btn-outline-warning">Manage</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Battle of Bands</strong>
                                                <br><small class="text-muted">Cultural</small>
                                            </td>
                                            <td><span class="badge bg-success">Cultural</span></td>
                                            <td>12/15</td>
                                            <td>3/5 assigned</td>
                                            <td><span class="badge bg-warning">Starting Soon</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">View</button>
                                                <button class="btn btn-sm btn-outline-warning">Manage</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Colleges Section -->
        <div id="colleges" class="dashboard-section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-university me-2"></i>Manage Colleges</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCollegeModal">
                        <i class="fas fa-plus me-1"></i>Add New College
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>College Name</th>
                                    <th>Code</th>
                                    <th>Contact</th>
                                    <th>Participants</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ABC College of Engineering</td>
                                    <td>ABC001</td>
                                    <td>contact@abccollege.edu</td>
                                    <td>45</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">Edit</button>
                                        <button class="btn btn-sm btn-info">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>XYZ University</td>
                                    <td>XYZ002</td>
                                    <td>info@xyzuniversity.edu</td>
                                    <td>32</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">Edit</button>
                                        <button class="btn btn-sm btn-info">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Competitions Section -->
        <div id="competitions" class="dashboard-section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-trophy me-2"></i>Manage Competitions</h5>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCompetitionModal">
                        <i class="fas fa-plus me-1"></i>Create Competition
                    </button>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="competitionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ongoing" type="button">Ongoing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#upcoming" type="button">Upcoming</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#completed" type="button">Completed</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="ongoing">
                            <!-- Ongoing competitions table -->
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Competition</th>
                                            <th>Category</th>
                                            <th>Participants</th>
                                            <th>Judges</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Code Marathon</td>
                                            <td><span class="badge bg-info">Technical</span></td>
                                            <td>25/30</td>
                                            <td>5/5</td>
                                            <td><span class="badge bg-success">Live</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary">View</button>
                                                <button class="btn btn-sm btn-outline-warning">Manage</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="upcoming">
                            <!-- Upcoming competitions content -->
                        </div>
                        <div class="tab-pane fade" id="completed">
                            <!-- Completed competitions content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Judges Section -->
        <div id="judges" class="dashboard-section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-gavel me-2"></i>Manage Judges</h5>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addJudgeModal">
                        <i class="fas fa-user-plus me-1"></i>Add New Judge
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-section">
                        <h6>Add New Judge</h6>
                        <form id="addJudgeForm">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Specialization</label>
                                    <select class="form-select" name="specialization" required>
                                        <option value="">Select Specialization</option>
                                        <option value="technical">Technical</option>
                                        <option value="cultural">Cultural</option>
                                        <option value="sports">Sports</option>
                                        <option value="academic">Academic</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" name="contact_number">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-1"></i>Create Judge Account
                            </button>
                        </form>
                    </div>

                    <h6>Existing Judges</h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Specialization</th>
                                    <th>Assigned Competitions</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Dr. Sharma</td>
                                    <td>sharma_judge</td>
                                    <td><span class="badge bg-info">Technical</span></td>
                                    <td>Code Marathon, Hackathon</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">Reset Password</button>
                                        <button class="btn btn-sm btn-info">View Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stage Controllers Section -->
        <div id="stage-controllers" class="dashboard-section">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-users-cog me-2"></i>Manage Stage Controllers</h5>
                </div>
                <div class="card-body">
                    <div class="form-section">
                        <h6>Add New Stage Controller</h6>
                        <form id="addStageControllerForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Assigned Stages</label>
                                    <select class="form-select" name="assigned_stages" multiple required>
                                        <option value="1">Stage 1</option>
                                        <option value="2">Stage 2</option>
                                        <option value="3">Stage 3</option>
                                        <option value="4">Stage 4</option>
                                        <option value="5">Stage 5</option>
                                    </select>
                                    <small class="text-muted">Hold Ctrl to select multiple stages</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" name="contact_number">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-1"></i>Create Stage Controller Account
                            </button>
                        </form>
                    </div>

                    <h6>Existing Stage Controllers</h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Assigned Stages</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="stageControllersList">
                                <tr>
                                    <td>Rajesh Kumar</td>
                                    <td>stage1_controller</td>
                                    <td><span class="badge bg-primary">Stage 1, Stage 2</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning">Reset Password</button>
                                        <button class="btn btn-sm btn-info">View Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results & Analytics Section -->
        <div id="results" class="dashboard-section">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-line me-2"></i>Results & Analytics</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Competition Results Overview</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="resultsChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Top Performing Colleges</h6>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <div class="list-group-item d-flex justify-content-between">
                                            <span>ABC College</span>
                                            <span class="badge bg-primary">5 Gold</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between">
                                            <span>XYZ University</span>
                                            <span class="badge bg-primary">3 Gold</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between">
                                            <span>LMN Institute</span>
                                            <span class="badge bg-primary">2 Gold</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Settings Section -->
        <div id="settings" class="dashboard-section">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-cog me-2"></i>System Settings</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6>General Settings</h6>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Event Name</label>
                                            <input type="text" class="form-control" value="UniFest 2026">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Max Participants per College</label>
                                            <input type="number" class="form-control" value="50">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Registration Deadline</label>
                                            <input type="date" class="form-control" value="2026-03-15">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Settings</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Security Settings</h6>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Admin Password</label>
                                            <input type="password" class="form-control" placeholder="Enter new password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Session Timeout (minutes)</label>
                                            <input type="number" class="form-control" value="30">
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="twoFactor" checked>
                                            <label class="form-check-label" for="twoFactor">Enable Two-Factor Authentication</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Security</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add College Modal -->
    <div class="modal fade" id="addCollegeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New College</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addCollegeForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">College Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">College Code</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Phone</label>
                                <input type="tel" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add College</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Competition Modal -->
    <div class="modal fade" id="addCompetitionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Competition</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addCompetitionForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Competition Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" required>
                                    <option value="">Select Category</option>
                                    <option value="technical">Technical</option>
                                    <option value="cultural">Cultural</option>
                                    <option value="sports">Sports</option>
                                    <option value="academic">Academic</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Max Participants</label>
                                <input type="number" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Schedule Date</label>
                                <input type="datetime-local" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Create Competition</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Section Navigation
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.dashboard-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Update active nav link
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelector(`[data-section="${sectionId}"]`).classList.add('active');
            
            // Update page title
            const pageTitle = document.getElementById('pageTitle');
            const sectionTitles = {
                'dashboard': 'Admin Dashboard',
                'colleges': 'Manage Colleges',
                'competitions': 'Manage Competitions',
                'judges': 'Manage Judges',
                'stage-controllers': 'Stage Controllers',
                'results': 'Results & Analytics',
                'settings': 'System Settings'
            };
            pageTitle.innerHTML = `<i class="fas fa-graduation-cap me-2"></i>${sectionTitles[sectionId]}`;
        }

        // Initialize navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Set up nav link click events
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const section = this.getAttribute('data-section');
                    showSection(section);
                });
            });

            // Initialize chart
            const ctx = document.getElementById('resultsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Technical', 'Cultural', 'Sports', 'Academic'],
                    datasets: [{
                        label: 'Participants',
                        data: [120, 85, 65, 72],
                        backgroundColor: [
                            'rgba(52, 152, 219, 0.8)',
                            'rgba(46, 204, 113, 0.8)',
                            'rgba(155, 89, 182, 0.8)',
                            'rgba(241, 196, 15, 0.8)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Participants by Competition Category'
                        }
                    }
                }
            });

            // Form submissions
            document.getElementById('addJudgeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Judge added successfully!');
                this.reset();
            });

            document.getElementById('addStageControllerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Stage Controller added successfully!');
                this.reset();
            });
        });
    </script>
</body>
</html>
