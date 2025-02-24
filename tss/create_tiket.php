<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create New Ticket - AssistMe</title>
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
        background-color: #dcdcdc; /* Warna abu-abu sidebar */
        min-height: 100vh;
        padding: 0;
      }

      .logo-background {
        background-color: #979696; /* Latar belakang putih untuk logo */
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

      .form-label {
        font-weight: bold;
      }

      .required::after {
        content: " *";
        color: red;
      }

      .text-editor {
        border: 1px solid #ced4da;
        padding: 10px;
        min-height: 150px;
        background-color: white;
      }

      .attachment-requirement {
        font-size: 0.875rem;
        color: #6c757d;
      }

      .btn-cancel {
        background-color: #cccccc;
        color: black;
      }

      /* Menambahkan warna untuk pilihan priority */
      #priority option[value="low"] {
        background-color: #00ff3c; /* Warna hijau muda untuk Low */
        color: #000000; /* Warna teks hijau */
      }

      #priority option[value="medium"] {
        background-color: #ffff00; /* Warna kuning untuk Medium */
        color: #000000; /* Warna teks kuning */
      }

      #priority option[value="urgent"] {
        background-color: #ff0015; /* Warna merah muda untuk Urgent */
        color: #000000; /* Warna teks merah */
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
                alt="User Avatar"
                class="rounded-circle me-2"
              />
              <div>
                <span>Santi</span>
                <div class="text-success small">● Online</div>
              </div>
            </div>
            <div class="menu-title">Helpdesk Menu</div>
            <nav>
              <ul class="list-unstyled">
                <li>
                  <a href="db_user_regis.html"><i class="bi bi-house-door"></i> Dashboard</a>
                </li>
                <li>
                  <a href="#"
                    ><i class="bi bi-plus-circle"></i> Create New Ticket</a
                  >
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
          <!-- Container for aligning Logout and Create New Ticket -->
          <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Create New Ticket Title -->
            <h5 class="mb-0">
              <i class="bi bi-arrow-left"></i> Create New Ticket
            </h5>
            <!-- Logout Button -->
            <button class="btn btn-outline-danger btn-sm logout-btn">
              Logout
            </button>
          </div>
          <form method="POST" action="save_ticket.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="subject" class="form-label required">Subject</label>
              <input
                type="text"
                name="subject"
                id="subject"
                class="form-control"
                placeholder="Enter subject"
                required
              />
            </div>
            <div class="mb-3">
              <label for="product" class="form-label required">Product</label>
              <select id="product" name="product" class="form-select" required>
                <option value="" selected disabled>Select product</option>
                <option value="cisea">CISEA</option>
        z        <option value="ellipse">Ellipse</option>
                <option value="accesscisea">Access CISEA</option>
                <option value="accessellipse">Access Ellipse</option>
                <option value="resetpassword">Reset Password</option>
                <option value="pcsupport">PC Support</option>
                <option value="network">Network</option>  
              </select>
            </div>
            <div class="mb-3">
              <label for="module" class="form-label required">Module</label>
              <select id="module" name="module" class="form-select" required>
                <option value="" selected disabled>Select module</option>
                <option value="finance">Finance</option>
                <option value="payroll">Payroll</option>
                <option value="leave">Leave</option>
                <option value="no_module">No Module</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="priority" class="form-label required">Priority</label>
              <select id="priority" name="priority" class="form-select" required>
                <option value="" selected disabled>Select priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="urgent">Urgent</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label required">Description</label>
              <textarea
                type="text"
                name="description"
                id="description"
                class="form-control"
                rows="5"
                placeholder="Type Here..."
                required
              ></textarea>
            </div>
            <div class="mb-3">
              <label for="attachment" class="form-label required"
                >Attachment (optional)</label
              >
              <input type="file" name="file_content" id="attachment" class="form-control" />
              <div class="attachment-requirement">
                *Upload requirements: Max 2MB, JPG/PNG only
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-cancel me-2">Cancel</button>
              <button type="submit" name="save" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document
        .querySelector(".logout-btn")
        .addEventListener("click", function () {
          const confirmLogout = confirm("Are you sure you want to logout?");
          if (confirmLogout) {
            // Redirect to login page
            window.location.href = "login.html";
          }
        });
    </script>
  </body>
</html>
