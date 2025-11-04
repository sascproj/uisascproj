<?php
require_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

// Get competitions for display
$competitions = $db->query("SELECT * FROM competitions ORDER BY date, time")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Festival Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your existing CSS from main.html */
        :root {
            --primary: #2C3E50;
            --secondary: #E74C3C;
            --accent: #F39C12;
            --success: #27AE60;
            --warning: #F1C40F;
            --info: #3498DB;
            --light: #ECF0F1;
            --dark: #2C3E50;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
        }

        /* ... (include all your CSS from main.html) ... */
        
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i>UniFest 2026
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>University Festival 2026</h1>
            <p>Join us for the most exciting inter-college competition featuring cultural events, technical competitions, and sports tournaments.</p>
            <div class="mt-4">
                <a href="#schedule" class="btn btn-light btn-lg me-2"><i class="fas fa-calendar-plus me-1"></i> View Schedule</a>
                <a href="#results" class="btn btn-outline-light btn-lg"><i class="fas fa-trophy me-1"></i> See Results</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <?php
                $stats = [
                    'competitions' => $db->query("SELECT COUNT(*) FROM competitions")->fetchColumn(),
                    'colleges' => $db->query("SELECT COUNT(*) FROM colleges WHERE username != 'admin'")->fetchColumn(),
                    'participants' => $db->query("SELECT COUNT(*) FROM participants")->fetchColumn()
                ];
                ?>
                <div class="col-md-3 mb-4">
                    <div class="card stat-card">
                        <div class="stat-number"><?php echo $stats['competitions']; ?></div>
                        <div class="stat-label">Competitions</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card stat-card">
                        <div class="stat-number"><?php echo $stats['colleges']; ?></div>
                        <div class="stat-label">Colleges</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card stat-card">
                        <div class="stat-number"><?php echo $stats['participants']; ?></div>
                        <div class="stat-label">Participants</div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card stat-card">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Days</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- Competitions -->
                <div class="col-lg-8 mb-5">
                    <h2 class="mb-4">Featured Competitions</h2>
                    <div class="table-container">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Competition</th>
                                    <th>Date & Time</th>
                                    <th>Venue</th>
                                    <th>Participants</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($competitions as $competition): 
                                    $participant_count = $db->query("SELECT COUNT(*) FROM participants WHERE competition_id = " . $competition['id'])->fetchColumn();
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($competition['name']); ?></strong>
                                        <div class="text-muted small"><?php echo htmlspecialchars($competition['description']); ?></div>
                                    </td>
                                    <td><?php echo $competition['date'] . ', ' . $competition['time']; ?></td>
                                    <td><?php echo htmlspecialchars($competition['venue']); ?></td>
                                    <td><?php echo $participant_count . '/' . $competition['max_participants']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $competition['status'] == 'open' ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo ucfirst($competition['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Schedule & Login -->
                <div class="col-lg-4">
                    <!-- Quick Schedule -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-calendar-day me-2"></i>Today's Schedule
                        </div>
                        <div class="card-body">
                            <?php
                            $today = date('Y-m-d');
                            $today_events = $db->query("SELECT * FROM competitions WHERE date = '$today' ORDER BY time")->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (count($today_events) > 0):
                                foreach ($today_events as $event):
                            ?>
                            <div class="schedule-item">
                                <div class="schedule-time"><?php echo date('h:i A', strtotime($event['time'])); ?></div>
                                <div class="fw-bold"><?php echo htmlspecialchars($event['name']); ?></div>
                                <div class="text-muted small"><?php echo htmlspecialchars($event['venue']); ?></div>
                            </div>
                            <?php endforeach; else: ?>
                                <p class="text-muted">No events scheduled for today.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Login Card -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-sign-in-alt me-2"></i>College Login
                        </div>
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rest of your HTML content... -->
</body>
</html>
