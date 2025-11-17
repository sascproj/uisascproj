<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniFest 2026 - Super Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2C3E50;
            --secondary: #E74C3C;
            --accent: #F39C12;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--primary);
        }
        
        .navbar {
            background-color: var(--primary);
        }
        
        .sidebar {
            background: var(--primary);
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            padding-top: 20px;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
        }
        
        .nav-link.active {
            background-color: var(--secondary);
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            border-left: 4px solid var(--secondary);
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--secondary);
        }
        
        .card-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .card-label {
            color: #6c757d;
            font-weight: 500;
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent);
        }
        
        .form-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            margin-bottom: 25px;
        }
        
        .btn-primary {
            background-color: var(--secondary);
            border-color: var(--secondary);
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        
        .btn-success {
            background-color: #27AE60;
            border-color: #27AE60;
            font-weight: 600;
        }
        
        .btn-warning {
            background-color: #F39C12;
            border-color: #F39C12;
            font-weight: 600;
        }
        
        .participant-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 3px solid var(--info);
        }
        
        .judge-inputs {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .judge-input {
            flex: 1;
        }
        
        .total-score {
            background: var(--success);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 600;
            margin-top: 10px;
            display: inline-block;
        }
        
        .college-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .login-info {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-family: monospace;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .registration-control {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            margin-bottom: 25px;
            border-left: 4px solid #F39C12;
        }
        
        .status-indicator {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .status-open {
            background-color: rgba(39, 174, 96, 0.1);
            color: #27AE60;
        }
        
        .status-closed {
            background-color: rgba(231, 76, 60, 0.1);
            color: #E74C3C;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-crown me-2"></i>Super Admin</h3>
            <p class="mb-0">UniFest 2026</p>
        </div>
        
        <div class="sidebar-menu mt-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-tab="dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tab="markEntry">
                        <i class="fas fa-clipboard-check me-2"></i>Mark Entry
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tab="colleges">
                        <i class="fas fa-university me-2"></i>Manage Colleges
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tab="competitions">
                        <i class="fas fa-trophy me-2"></i>Competitions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tab="registration">
                        <i class="fas fa-user-plus me-2"></i>Registration Control
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="#">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Tab -->
        <div class="tab-content active" id="dashboard">
            <h2 class="section-title">Dashboard Overview</h2>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="card-value">12</div>
                        <div class="card-label">Active Competitions</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="card-value">18</div>
                        <div class="card-label">Colleges Registered</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-value">245</div>
                        <div class="card-label">Total Participants</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-value">8</div>
                        <div class="card-label">Results Published</div>
                    </div>
                </div>
            </div>
            
            <!-- Registration Status Card -->
            <div class="registration-control">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">College Registration Status</h4>
                        <p class="mb-0 text-muted">Control whether colleges can register for UniFest 2026</p>
                    </div>
                    <div id="registrationStatus" class="status-indicator status-open">
                        <i class="fas fa-door-open me-2"></i>Registration OPEN
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-success me-2" id="openRegistration">
                        <i class="fas fa-door-open me-2"></i>Open Registration
                    </button>
                    <button class="btn btn-warning" id="closeRegistration">
                        <i class="fas fa-door-closed me-2"></i>Close Registration
                    </button>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-card">
                        <h4 class="section-title">Quick Actions</h4>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary mb-2" data-tab="markEntry">
                                <i class="fas fa-clipboard-check me-2"></i>Enter Marks
                            </button>
                            <button class="btn btn-outline-primary mb-2" data-tab="colleges">
                                <i class="fas fa-university me-2"></i>Add College
                            </button>
                            <button class="btn btn-outline-primary mb-2" data-tab="competitions">
                                <i class="fas fa-plus me-2"></i>Create Competition
                            </button>
                            <button class="btn btn-outline-primary" data-tab="registration">
                                <i class="fas fa-user-plus me-2"></i>Registration Control
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-card">
                        <h4 class="section-title">Recent Activity</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <i class="fas fa-check text-success me-2"></i>
                                Marks entered for Classical Singing
                            </li>
                            <li class="list-group-item px-0">
                                <i class="fas fa-university text-info me-2"></i>
                                New college "Tech Institute" registered
                            </li>
                            <li class="list-group-item px-0">
                                <i class="fas fa-trophy text-warning me-2"></i>
                                Dance competition results published
                            </li>
                            <li class="list-group-item px-0">
                                <i class="fas fa-plus text-primary me-2"></i>
                                New competition "Robotics" created
                            </li>
                            <li class="list-group-item px-0">
                                <i class="fas fa-door-closed text-danger me-2"></i>
                                College registration closed by Admin
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mark Entry Tab -->
        <div class="tab-content" id="markEntry">
            <h2 class="section-title">Enter Competition Marks</h2>
            
            <div class="form-card">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Select Competition</label>
                        <select class="form-select" id="competitionSelect">
                            <option value="">-- Choose Competition --</option>
                            <option value="singing">Classical Singing</option>
                            <option value="dance">Dance Solo</option>
                            <option value="debate">Debate Competition</option>
                            <option value="programming">Programming Contest</option>
                            <option value="art">Art Competition</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Select College</label>
                        <select class="form-select" id="collegeSelect">
                            <option value="">-- Choose College --</option>
                            <option value="cityarts">City Arts College</option>
                            <option value="utech">University of Technology</option>
                            <option value="metro">Metropolitan University</option>
                            <option value="northern">Northern State College</option>
                        </select>
                    </div>
                </div>
                
                <div id="participantsContainer">
                    <!-- Participants will be loaded here based on competition and college selection -->
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-users fa-2x mb-3"></i>
                        <p>Select a competition and college to view participants</p>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-primary" id="saveMarksBtn">
                        <i class="fas fa-save me-2"></i>Save All Marks
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Manage Colleges Tab -->
        <div class="tab-content" id="colleges">
            <h2 class="section-title">Manage Colleges</h2>
            
            <div class="form-card">
                <h4 class="mb-4">Add New College</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">College Name</label>
                        <input type="text" class="form-control" id="collegeName" placeholder="Enter college name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">College Code</label>
                        <input type="text" class="form-control" id="collegeCode" placeholder="Enter unique code">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact Email</label>
                        <input type="email" class="form-control" id="collegeEmail" placeholder="Enter contact email">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="contactPerson" placeholder="Enter contact person name">
                    </div>
                </div>
                <button class="btn btn-primary" id="addCollegeBtn">
                    <i class="fas fa-plus me-2"></i>Add College & Generate Login
                </button>
                
                <div id="collegeLoginInfo" class="mt-3" style="display: none;">
                    <h5 class="text-success">College Added Successfully!</h5>
                    <div class="login-info">
                        <strong>Username:</strong> <span id="generatedUsername"></span><br>
                        <strong>Password:</strong> <span id="generatedPassword"></span>
                    </div>
                    <p class="text-muted mt-2">Share these credentials with the college admin</p>
                </div>
            </div>
            
            <div class="form-card mt-4">
                <h4 class="mb-4">Registered Colleges</h4>
                <div class="college-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">City Arts College</h5>
                            <p class="mb-1 text-muted">Code: CAC | Email: admin@cityarts.edu</p>
                        </div>
                        <span class="badge bg-success">Active</span>
                    </div>
                </div>
                <div class="college-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">University of Technology</h5>
                            <p class="mb-1 text-muted">Code: UOT | Email: admin@utech.edu</p>
                        </div>
                        <span class="badge bg-success">Active</span>
                    </div>
                </div>
                <div class="college-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Metropolitan University</h5>
                            <p class="mb-1 text-muted">Code: MET | Email: admin@metro.edu</p>
                        </div>
                        <span class="badge bg-success">Active</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Competitions Tab -->
        <div class="tab-content" id="competitions">
            <h2 class="section-title">Manage Competitions</h2>
            
            <div class="form-card">
                <h4 class="mb-4">Create New Competition</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Competition Name</label>
                        <input type="text" class="form-control" id="competitionName" placeholder="Enter competition name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="competitionCategory">
                            <option value="cultural">Cultural</option>
                            <option value="technical">Technical</option>
                            <option value="literary">Literary</option>
                            <option value="sports">Sports</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Max Participants per College</label>
                        <input type="number" class="form-control" id="maxParticipants" value="2" min="1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judges Count</label>
                        <select class="form-select" id="judgesCount">
                            <option value="3">3 Judges</option>
                            <option value="4">4 Judges</option>
                            <option value="5">5 Judges</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" id="createCompetitionBtn">
                    <i class="fas fa-plus me-2"></i>Create Competition
                </button>
            </div>
            
            <div class="form-card mt-4">
                <h4 class="mb-4">Active Competitions</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Competition</th>
                                <th>Category</th>
                                <th>Participants</th>
                                <th>Judges</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Classical Singing</td>
                                <td>Cultural</td>
                                <td>24</td>
                                <td>4</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Dance Solo</td>
                                <td>Cultural</td>
                                <td>18</td>
                                <td>4</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Programming Contest</td>
                                <td>Technical</td>
                                <td>16</td>
                                <td>3</td>
                                <td><span class="badge bg-warning">Upcoming</span></td>
                            </tr>
                            <tr>
                                <td>Debate Competition</td>
                                <td>Literary</td>
                                <td>12</td>
                                <td>3</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Registration Control Tab -->
        <div class="tab-content" id="registration">
            <h2 class="section-title">Registration Control</h2>
            
            <div class="form-card">
                <h4 class="mb-4">College Registration Settings</h4>
                
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 me-3">Current Status:</h5>
                            <div id="registrationStatusFull" class="status-indicator status-open">
                                <i class="fas fa-door-open me-2"></i>Registration OPEN for Colleges
                            </div>
                        </div>
                        <p class="text-muted mt-2">
                            When registration is closed, new colleges cannot register for UniFest 2026.
                            Existing colleges can still access their accounts and manage participants.
                        </p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-4">
                            <h5><i class="fas fa-door-open text-success me-2"></i>Open Registration</h5>
                            <p class="text-muted">Allow new colleges to register for UniFest 2026</p>
                            <button class="btn btn-success w-100" id="openRegistrationFull">
                                <i class="fas fa-check me-2"></i>Open Registration
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light p-4">
                            <h5><i class="fas fa-door-closed text-danger me-2"></i>Close Registration</h5>
                            <p class="text-muted">Stop new colleges from registering</p>
                            <button class="btn btn-warning w-100" id="closeRegistrationFull">
                                <i class="fas fa-times me-2"></i>Close Registration
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 p-3 bg-light rounded">
                    <h6><i class="fas fa-info-circle me-2"></i>Registration Statistics</h6>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="fw-bold fs-4">18</div>
                                <div class="text-muted">Colleges Registered</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="fw-bold fs-4">5</div>
                                <div class="text-muted">Pending Approvals</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="fw-bold fs-4">2</div>
                                <div class="text-muted">This Week</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Registration status management
        let registrationOpen = true;
        
        // Update registration status display
        function updateRegistrationStatus() {
            const statusIndicator = document.getElementById('registrationStatus');
            const statusIndicatorFull = document.getElementById('registrationStatusFull');
            
            if (registrationOpen) {
                statusIndicator.className = 'status-indicator status-open';
                statusIndicator.innerHTML = '<i class="fas fa-door-open me-2"></i>Registration OPEN';
                statusIndicatorFull.className = 'status-indicator status-open';
                statusIndicatorFull.innerHTML = '<i class="fas fa-door-open me-2"></i>Registration OPEN for Colleges';
            } else {
                statusIndicator.className = 'status-indicator status-closed';
                statusIndicator.innerHTML = '<i class="fas fa-door-closed me-2"></i>Registration CLOSED';
                statusIndicatorFull.className = 'status-indicator status-closed';
                statusIndicatorFull.innerHTML = '<i class="fas fa-door-closed me-2"></i>Registration CLOSED for Colleges';
            }
        }
        
        // Open registration
        document.getElementById('openRegistration').addEventListener('click', function() {
            registrationOpen = true;
            updateRegistrationStatus();
            showAlert('College registration is now OPEN', 'success');
        });
        
        document.getElementById('openRegistrationFull').addEventListener('click', function() {
            registrationOpen = true;
            updateRegistrationStatus();
            showAlert('College registration is now OPEN', 'success');
        });
        
        // Close registration
        document.getElementById('closeRegistration').addEventListener('click', function() {
            if (confirm('Are you sure you want to close college registration? New colleges will not be able to register.')) {
                registrationOpen = false;
                updateRegistrationStatus();
                showAlert('College registration is now CLOSED', 'warning');
            }
        });
        
        document.getElementById('closeRegistrationFull').addEventListener('click', function() {
            if (confirm('Are you sure you want to close college registration? New colleges will not be able to register.')) {
                registrationOpen = false;
                updateRegistrationStatus();
                showAlert('College registration is now CLOSED', 'warning');
            }
        });
        
        // Tab navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links and tabs
                document.querySelectorAll('.nav-link').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.remove('active');
                });
                
                // Add active class to clicked link and corresponding tab
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Quick action buttons navigation
        document.querySelectorAll('button[data-tab]').forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Remove active class from all links and tabs
                document.querySelectorAll('.nav-link').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.remove('active');
                });
                
                // Add active class to corresponding link and tab
                document.querySelector(`.nav-link[data-tab="${tabId}"]`).classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Generate college login credentials
        document.getElementById('addCollegeBtn').addEventListener('click', function() {
            const collegeName = document.getElementById('collegeName').value;
            const collegeCode = document.getElementById('collegeCode').value;
            
            if (!collegeName || !collegeCode) {
                alert('Please enter college name and code');
                return;
            }
            
            // Generate username and password
            const username = collegeCode.toLowerCase() + '_admin';
            const password = generatePassword(8);
            
            // Display login info
            document.getElementById('generatedUsername').textContent = username;
            document.getElementById('generatedPassword').textContent = password;
            document.getElementById('collegeLoginInfo').style.display = 'block';
            
            // Clear form
            document.getElementById('collegeName').value = '';
            document.getElementById('collegeCode').value = '';
            document.getElementById('collegeEmail').value = '';
            document.getElementById('contactPerson').value = '';
        });
        
        // Generate random password
        function generatePassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            let password = "";
            for (let i = 0; i < length; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            return password;
        }
        
        // Load participants when competition and college are selected
        document.getElementById('competitionSelect').addEventListener('change', loadParticipants);
        document.getElementById('collegeSelect').addEventListener('change', loadParticipants);
        
        function loadParticipants() {
            const competition = document.getElementById('competitionSelect').value;
            const college = document.getElementById('collegeSelect').value;
            
            if (!competition || !college) return;
            
            // Sample participants data
            const participants = {
                'singing': [
                    { name: 'Priya Sharma', code: 'CS-12' },
                    { name: 'Rahul Kumar', code: 'CS-15' }
                ],
                'dance': [
                    { name: 'Ananya Desai', code: 'DS-08' },
                    { name: 'Rohit Verma', code: 'DS-11' }
                ],
                'debate': [
                    { name: 'Aditya Singh', code: 'DB-05' },
                    { name: 'Neha Gupta', code: 'DB-09' }
                ],
                'programming': [
                    { name: 'Vikram Reddy', code: 'PC-03' },
                    { name: 'Sneha Patel', code: 'PC-07' }
                ],
                'art': [
                    { name: 'Meera Joshi', code: 'AR-10' },
                    { name: 'Sanjay Mehta', code: 'AR-14' }
                ]
            };
            
            const container = document.getElementById('participantsContainer');
            container.innerHTML = '';
            
            if (participants[competition]) {
                participants[competition].forEach(participant => {
                    const participantCard = document.createElement('div');
                    participantCard.className = 'participant-card';
                    participantCard.innerHTML = `
                        <h5>${participant.name} <span class="text-muted">(${participant.code})</span></h5>
                        <div class="judge-inputs">
                            <div class="judge-input">
                                <label class="form-label">Judge 1</label>
                                <input type="number" class="form-control judge-mark" min="0" max="25" placeholder="0-25">
                            </div>
                            <div class="judge-input">
                                <label class="form-label">Judge 2</label>
                                <input type="number" class="form-control judge-mark" min="0" max="25" placeholder="0-25">
                            </div>
                            <div class="judge-input">
                                <label class="form-label">Judge 3</label>
                                <input type="number" class="form-control judge-mark" min="0" max="25" placeholder="0-25">
                            </div>
                            <div class="judge-input">
                                <label class="form-label">Judge 4</label>
                                <input type="number" class="form-control judge-mark" min="0" max="25" placeholder="0-25">
                            </div>
                        </div>
                        <div class="total-score">Total: <span>0</span>/100</div>
                    `;
                    container.appendChild(participantCard);
                    
                    // Add event listeners to calculate total
                    const judgeInputs = participantCard.querySelectorAll('.judge-mark');
                    const totalSpan = participantCard.querySelector('.total-score span');
                    
                    judgeInputs.forEach(input => {
                        input.addEventListener('input', function() {
                            let total = 0;
                            judgeInputs.forEach(judgeInput => {
                                total += parseInt(judgeInput.value) || 0;
                            });
                            totalSpan.textContent = total;
                        });
                    });
                });
            }
        }
        
        // Save marks
        document.getElementById('saveMarksBtn').addEventListener('click', function() {
            alert('Marks saved successfully!');
        });
        
        // Create competition
        document.getElementById('createCompetitionBtn').addEventListener('click', function() {
            const competitionName = document.getElementById('competitionName').value;
            
            if (!competitionName) {
                alert('Please enter competition name');
                return;
            }
            
            alert(`Competition "${competitionName}" created successfully!`);
            document.getElementById('competitionName').value = '';
        });
        
        // Show alert message
        function showAlert(message, type) {
            const alertClass = type === 'success' ? 'alert-success' : 'alert-warning';
            
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.querySelector('.main-content').prepend(alertDiv);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
        
        // Initialize registration status
        updateRegistrationStatus();
    </script>
</body>
</html>
