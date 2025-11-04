<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();

$database = new Database();
$db = $database->getConnection();
$college_id = $_SESSION['user_id'];

// Add student
if ($_POST['add_student']) {
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    
    $query = "INSERT INTO students (name, roll_number, department, year, college_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $roll_number, $department, $year, $college_id]);
    $student_message = "Student added successfully!";
}

// Assign to competition
if ($_POST['assign_competition']) {
    $student_id = $_POST['student_id'];
    $competition_id = $_POST['competition_id'];
    
    $query = "INSERT INTO participants (student_id, competition_id) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$student_id, $competition_id]);
    $assign_message = "Student assigned to competition!";
}

// Get data
$students = $db->query("SELECT * FROM students WHERE college_id = $college_id")->fetchAll(PDO::FETCH_ASSOC);
$competitions = $db->query("SELECT * FROM competitions WHERE status = 'open'")->fetchAll(PDO::FETCH_ASSOC);
$participants = $db->query("
    SELECT p.*, s.name as student_name, s.department, c.name as competition_name 
    FROM participants p 
    JOIN students s ON p.student_id = s.id 
    JOIN competitions c ON p.competition_id = c.id 
    WHERE s.college_id = $college_id
")->fetchAll(PDO::FETCH_ASSOC);

$stats = [
    'students' => count($students),
    'competitions' => $db->query("SELECT COUNT(DISTINCT competition_id) FROM participants p JOIN students s ON p.student_id = s.id WHERE s.college_id = $college_id")->fetchColumn(),
    'participations' => count($participants)
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>College Dashboard - UniFest 2026</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Your college.html CSS here */
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand ms-3" href="#">
        <i class="fas fa-graduation-cap me-2"></i><?php echo $_SESSION['college_name']; ?> Portal
      </a>
      <div class="d-flex me-3">
        <a href="logout.php" class="btn btn-outline-light btn-sm">
          <i class="fas fa-sign-out-alt me-1"></i> Logout
        </a>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 sidebar">
        <ul class="nav flex-column">
          <li><a href="#" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a></li>
          <li><a href="#add-student" class="nav-link"><i class="fas fa-user-plus"></i> Add Students</a></li>
          <li><a href="#assign-program" class="nav-link"><i class="fas fa-tasks"></i> Assign Programs</a></li>
          <li><a href="#participants" class="nav-link"><i class="fas fa-users"></i> View Participants</a></li>
        </ul>
      </div>

      <!-- Main Content -->
      <div class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-4 fw-bold text-dark">College Dashboard - <?php echo $_SESSION['college_name']; ?></h2>

        <!-- Stats -->
        <div class="row mb-4">
          <div class="col-md-4 mb-3">
            <div class="card text-center">
              <div class="card-body">
                <h4 class="text-primary"><?php echo $stats['students']; ?></h4>
                <p>Registered Students</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card text-center">
              <div class="card-body">
                <h4 class="text-primary"><?php echo $stats['competitions']; ?></h4>
                <p>Competitions Joined</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card text-center">
              <div class="card-body">
                <h4 class="text-primary"><?php echo $stats['participations']; ?></h4>
                <p>Total Participations</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Student -->
        <div id="add-student" class="card mb-4">
          <div class="card-header"><i class="fas fa-user-plus me-2"></i>Add Student</div>
          <div class="card-body">
            <?php if (isset($student_message)): ?>
              <div class="alert alert-success"><?php echo $student_message; ?></div>
            <?php endif; ?>
            <form method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Student Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Roll Number</label>
                  <input type="text" class="form-control" name="roll_number" placeholder="Enter roll number" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Department</label>
                  <input type="text" class="form-control" name="department" placeholder="Enter department">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Year</label>
                  <select class="form-select" name="year">
                    <option>Select Year</option>
                    <option>1st Year</option>
                    <option>2nd Year</option>
                    <option>3rd Year</option>
                    <option>Final Year</option>
                  </select>
                </div>
              </div>
              <button type="submit" name="add_student" class="btn btn-primary">Add Student</button>
            </form>
          </div>
        </div>

        <!-- Assign Program -->
        <div id="assign-program" class="card mb-4">
          <div class="card-header"><i class="fas fa-tasks me-2"></i>Assign Student to Competition</div>
          <div class="card-body">
            <?php if (isset($assign_message)): ?>
              <div class="alert alert-success"><?php echo $assign_message; ?></div>
            <?php endif; ?>
            <form method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Select Student</label>
                  <select class="form-select" name="student_id" required>
                    <option value="">-- Select Student --</option>
                    <?php foreach ($students as $student): ?>
                    <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Select Competition</label>
                  <select class="form-select" name="competition_id" required>
                    <option value="">-- Select Competition --</option>
                    <?php foreach ($competitions as $competition): ?>
                    <option value="<?php echo $competition['id']; ?>"><?php echo htmlspecialchars($competition['name']); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <button type="submit" name="assign_competition" class="btn btn-success">Assign</button>
            </form>
          </div>
        </div>

        <!-- View Participants -->
        <div id="participants" class="card mb-4">
          <div class="card-header"><i class="fas fa-users me-2"></i>Registered Participants</div>
          <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Competition</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($participants as $index => $participant): ?>
                <tr>
                  <td><?php echo $index + 1; ?></td>
                  <td><?php echo htmlspecialchars($participant['student_name']); ?></td>
                  <td><?php echo htmlspecialchars($participant['department']); ?></td>
                  <td><?php echo htmlspecialchars($participant['competition_name']); ?></td>
                  <td>
                    <span class="badge bg-<?php echo $participant['status'] == 'confirmed' ? 'success' : 'warning'; ?>">
                      <?php echo ucfirst($participant['status']); ?>
                    </span>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
