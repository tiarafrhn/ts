<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - AssistMe</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
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
      .chart-container {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        max-width: 500px;
        margin: auto;
      }
      .chart-title {
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
        font-size: 1.2rem; /* Membuat tulisan lebih besar */
      }
    </style>
  </head>
  <body>
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
                alt="Admin Avatar"
                class="rounded-circle me-2"
              />
              <div>
                <span>Admin</span>
                <div class="text-success small">● Online</div>
              </div>
            </div>
            <nav>
              <ul class="list-unstyled">
                <li>
                  <a href="#"><i class="bi bi-house-door"></i> Dashboard</a>
                </li>
                <li>
                  <a href="#"><i class="bi bi-card-list"></i> Tickets</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-2">
          <!-- Container for aligning Logout and Create New Ticket -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Create New Ticket Title -->
            <h5 class="mb-0">
              <i class="bi bi-arrow-left"></i> Admin Progress & Report -
              Ticketing System
            </h5>
            <!-- Logout Button -->
            <button class="btn btn-outline-danger btn-sm logout-btn">
              Logout
            </button>
          </div>

          <div class="row g-4">
            <div class="col-md-6">
              <div class="chart-container">
                <div class="chart-title">Status Ticket (1 Month)</div>
                <canvas id="statusTicketChart"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="chart-container">
                <div class="chart-title">Priority Ticket (1 Month)</div>
                <canvas id="priorityTicketChart"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="chart-container">
                <div class="chart-title">Product (1 Month)</div>
                <canvas id="productChart"></canvas>
              </div>
            </div>
            <div class="col-md-6">
              <div class="chart-container">
                <div class="chart-title">Module (1 Month)</div>
                <canvas id="moduleChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      // Placeholder data for charts
      const dataStatusTicket = {
        labels: ["Ticket Closed", "Ticket Pending Customer", "Ticket Open"],
        datasets: [
          {
            data: [16.67, 41.67, 41.67],
            backgroundColor: ["green", "yellow", "red"],
          },
        ],
      };

      const dataPriorityTicket = {
        labels: ["Urgent Priority", "Medium Priority", "Low Priority"],
        datasets: [
          {
            data: [41.67, 33.33, 25],
            backgroundColor: ["red", "yellow", "blue"],
          },
        ],
      };

      const dataProduct = {
        labels: [
          "Product ELLIPSE",
          "Product CISEA",
          "Product Network",
          "Reset Password",
        ],
        datasets: [
          {
            data: [41.67, 16.67, 25, 16.67],
            backgroundColor: ["blue", "yellow", "pink", "purple"],
          },
        ],
      };

      const dataModule = {
        labels: [
          "Tanpa Module",
          "Module Finance",
          "Module HR",
          "Module Loader",
          "Module Payroll",
        ],
        datasets: [
          {
            data: [44.44, 16.67, 8.33, 8.33, 8.33],
            backgroundColor: ["grey", "green", "orange", "blue", "red"],
          },
        ],
      };

      const options = {
        plugins: {
          legend: {
            position: "right",
          },
        },
      };

      // Render charts
      new Chart(document.getElementById("statusTicketChart"), {
        type: "doughnut",
        data: dataStatusTicket,
        options: options,
      });

      new Chart(document.getElementById("priorityTicketChart"), {
        type: "doughnut",
        data: dataPriorityTicket,
        options: options,
      });

      new Chart(document.getElementById("productChart"), {
        type: "doughnut",
        data: dataProduct,
        options: options,
      });

      new Chart(document.getElementById("moduleChart"), {
        type: "doughnut",
        data: dataModule,
        options: options,
      });
    </script>
    <script>
      document.querySelector(".logout-btn").addEventListener("click", function () {
        const confirmLogout = confirm("Are you sure you want to logout?");
        if (confirmLogout) {
          window.location.href = "logout.php";
        }
      });
    </script>
  </body>
</html>

    