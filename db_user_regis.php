<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard User - AssistMe</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
        rel="stylesheet"
    /> <!-- Menambahkan pustaka icon -->
    <style>
        /* Styles for the page */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #dcdcdc;
            min-height: 100vh;
            padding: 0;
        }

        .logo-background {
            background-color: #979696;
            text-align: center;
            padding: 15px 0;
        }

        .logo {
            max-width: 80%;
        }

        .menu-title {
            font-weight: bold;
            padding: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: black;
            padding: 10px 15px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #f0f0f0;
            color: black;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .status-urgent {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: yellow;
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-closed {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-low {
            background-color: blue;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php
  session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User';

?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <div class="logo-background">
                <img src="Logo_AssistMe.png" class="logo" alt="Logo AssistMe" />
            </div>
            <div class="p-3">
              <div class="d-flex align-items-center mb-3">
                  <img
                      src="https://via.placeholder.com/40"
                      alt="User Avatar"
                      class="rounded-circle me-2"
                  />
                  <div>
                      <!-- Menampilkan nama pengguna yang login -->
                      <span><?php echo htmlspecialchars($nama); ?></span>
                      <div class="text-success small">● Online</div>
                  </div>
              </div>
                <div class="menu-title">Helpdesk Menu</div>
                <nav>
                    <ul class="list-unstyled">
                        <li>
                            <a href="db_user_regis.html" class="active"><i class="bi bi-house-door"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="create_tiket.html"><i class="bi bi-plus-circle"></i> Create New Ticket</a>
                        </li>
                        <li>
                            <a href="#"><i class="bi bi-person-circle"></i> My Profile</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Content -->
        <div class="col-md-10 p-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0"><i class="bi bi-arrow-left"></i> Dashboard Ticket</h5>
                <button class="btn btn-outline-danger btn-sm logout-btn">Logout</button>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary">Export Ticket</button>
                <input type="text" class="form-control w-25" placeholder="Search" />
            </div>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Date Created</th>
                        <th>Assign to</th>
                        <th>Subject</th>
                        <th>Product</th>
                        <th>Module</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="ticketTableBody">
                    <!-- Tickets will be loaded dynamically here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fetch tickets data from get_tickets.php and display it
    fetch('get_ticket.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("ticketTableBody");

            if (data.length === 0) {
                tableBody.innerHTML = "<tr><td colspan='8'>No tickets found</td></tr>";
            } else {
                data.forEach(ticket => {
                    const statusClass = ticket.priority === "Urgent" ? "status-urgent" :
                                        ticket.priority === "Pending" ? "status-pending" :
                                        ticket.priority === "Closed" ? "status-closed" :
                                        "status-low";

                    tableBody.innerHTML += ` 
                        <tr>
                            <td>${ticket.date_created}</td>
                            <td>${ticket.assign_to}</td>
                            <td>${ticket.subject}</td>
                            <td>${ticket.product}</td>
                            <td>${ticket.module}</td>
                            <td>${ticket.priority}</td>
                            <td><span class="status ${statusClass}">${ticket.priority}</span></td>
                            <td>
                                <a href="view_ticket.php?id=${ticket.id_tiket}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    `;
                });
            }
        })
        .catch(error => console.error('Error fetching tickets:', error));

    // Logout functionality
    document.querySelector(".logout-btn").addEventListener("click", function () {
        const confirmLogout = confirm("Are you sure you want to logout?");
        if (confirmLogout) {
            window.location.href = "logout.php";
        }
    });
</script>
</body>
</html>
