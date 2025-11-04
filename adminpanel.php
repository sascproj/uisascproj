<?php
require_once 'includes/auth.php';
if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Add college
if ($_POST['add_college']) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $query = "INSERT INTO colleges (name, code, username, password_hash) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $code, $username, $password]);
    $college_message = "College added successfully!";
}

// Add competition
if ($_POST['add_competition']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $venue = $_POST['venue'];
    $max_participants = $_POST['max_participants'];
    
    $query = "INSERT INTO competitions (name, description, date, time, venue, max_participants) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $description, $date, $time, $venue, $max_participants]);
    $competition_message = "Competition added successfully!";
}

// Get stats
$stats = [
    'colleges' => $db->query("SELECT COUNT(*) FROM colleges WHERE username != 'admin'")->fetchColumn(),
    'competitions' => $db->query("SELECT COUNT(*) FROM competitions")->fetchColumn(),
    'participants' => $db->query("SELECT COUNT(*) FROM participants")->fetchColumn(),
    'students' => $db->query("SELECT COUNT(*) FROM students")->fetchColumn()
];

$competitions = $db->query("SELECT * FROM competitions ORDER BY date, time")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Your admin.html content with PHP integration -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | UniFest 2024</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Your admin.html CSS here */
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column">
    <div class="text-center mb-4">
        <h4><i class="fas fa-user-shield me-2"></i>Admin Panel</h4>
    </div>
    <a href="#" class="nav-link active"><i class="fas fa-home me-2"></i>Dashboard</a>
    <a href="#" class="nav-link"><i class="fas fa-university me-2"></i>Manage Colleges</a>
    <a href="#" class="nav-link"><i class="fas fa-trophy me-2"></i>Manage Competitions</a>
    <a href="#" class="nav-link"><i class="fas fa-users me-2"></i>Participants</a>
    <a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
</div>

<!-- Main Content -->
<div class="content">
    <nav class="navbar navbar-expand-lg navbar-dark mb-4 rounded">
        <div class="container-fluid">
            <h4 class="text-white mb-0"><i class="fas fa-graduation-cap me-2"></i>UniFest Admin Dashboard</h4>
        </div>
    </nav>

    <!-- Dashboard Overview -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center p-3">
                <h5>Total Colleges</h5>
                <h2 class="text-primary fw-bold"><?php echo $stats['colleges']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center p-3">
                <h5>Competitions</h5>
                <h2 class="text-success fw-bold"><?php echo $stats['competitions']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center p-3">
                <h5>Participants</h5>
                <h2 class="text-warning fw-bold"><?php echo $stats['participants']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center p-3">
                <h5>Total Students</h5>
                <h2 class="text-danger fw-bold"><?php echo $stats['students']; ?></h2>
            </div>
        </div>
    </div>

    <!-- Manage Section -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5><i class="fas fa-university me-2"></i>Add College</h5>
                <?php if (isset($college_message)): ?>
                    <div class="alert alert-success"><?php echo $college_message; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">College Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter college name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">College Code</label>
                        <input type="text" class="form-control" name="code" placeholder="College code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="College username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Set password" required>
                    </div>
                    <button type="submit" name="add_college" class="btn btn-primary">Add College</button>
                </form>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h5><i class="fas fa-trophy me-2"></i>Add Competition</h5>
                <?php if (isset($competition_message)): ?>
                    <div class="alert alert-success"><?php echo $competition_message; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Competition Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter competition name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" placeholder="Competition description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Venue</label>
                        <input type="text" class="form-control" name="venue" placeholder="Enter venue" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Time</label>
                            <input type="time" class="form-control" name="time" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max Participants</label>
                        <input type="number" class="form-control" name="max_participants" value="50" required>
                    </div>
                    <button type="submit" name="add_competition" class="btn btn-success">Add Competition</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card p-4">
        <h5 class="mb-3"><i class="fas fa-list me-2"></i>Recent Competitions</h5>
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Competition</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Participants</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($competitions as $competition): 
                    $participant_count = $db->query("SELECT COUNT(*) FROM participants WHERE competition_id = " . $competition['id'])->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($competition['name']); ?></td>
                    <td><?php echo $competition['date'] . ' ' . $competition['time']; ?></td>
                    <td><?php echo htmlspecialchars($competition['venue']); ?></td>
                    <td><?php echo $participant_count . '/' . $competition['max_participants']; ?></td>
                    <td>
                        <span class="badge bg-<?php echo $competition['status'] == 'open' ? 'success' : 'danger'; ?>">
                            <?php echo ucfirst($competition['status']); ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
