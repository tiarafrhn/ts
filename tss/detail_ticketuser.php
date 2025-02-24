<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Ticket - AssistMe</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #f8f9fa;
      }

      .sidebar {
        background-color: #dcdcdc;
        min-height: 100vh;
        padding: 0;
      }

      .sidebar .logo-background {
        background-color: #979696;
        text-align: center;
        padding: 15px 0;
      }

      .sidebar .logo {
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

      .content {
        padding: 20px;
        background-color: white;
        border: 1px solid #ced4da;
        border-radius: 8px;
      }

      .ticket-header {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
      }

      .ticket-header .priority {
        color: white;
        background-color: #dc3545; /* Red */
        padding: 2px 8px;
        border-radius: 4px;
      }

      .ticket-header .file-list img {
        max-width: 100px;
        margin-right: 10px;
      }

      .comment-box {
        margin-top: 20px;
      }

      .history {
        margin-top: 30px;
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 15px;
      }

      .history-item {
        margin-bottom: 15px;
        border-bottom: 1px solid #ced4da;
        padding-bottom: 10px;
      }

      .history-item:last-child {
        border-bottom: none;
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
            <div class="menu-title">Helpdesk Menu</div>
            <nav>
              <ul class="list-unstyled">
                <li>
                  <a href="#"><i class="bi bi-house-door"></i> Dashboard</a>
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
        <div class="col-md-10 p-4">
          <div class="content">
            <h5><i class="bi bi-arrow-left"></i> Tickets - Detail Ticket</h5>
            <div class="ticket-header">
              <table class="table">
                <tbody>
                  <tr>
                    <th>Status:</th>
                    <td>
                      <span class="badge bg-warning text-dark"
                        >Pending User</span
                      >
                    </td>
                  </tr>
                  <tr>
                    <th>Date:</th>
                    <td>28/09/2024</td>
                  </tr>
                  <tr>
                    <th>Ticket Id:</th>
                    <td>T001</td>
                  </tr>
                  <tr>
                    <th>User Id:</th>
                    <td>U100</td>
                  </tr>
                  <tr>
                    <th>Name:</th>
                    <td>Santi Anggraeni</td>
                  </tr>
                  <tr>
                    <th>Assign To:</th>
                    <td>Fadli</td>
                  </tr>
                  <tr>
                    <th>Subject:</th>
                    <td>Error akses laporan keuangan CISEA</td>
                  </tr>
                  <tr>
                    <th>Product:</th>
                    <td>CISEA</td>
                  </tr>
                  <tr>
                    <th>Module:</th>
                    <td>Finance</td>
                  </tr>
                  <tr>
                    <th>Priority:</th>
                    <td><span class="priority">Urgent</span></td>
                  </tr>
                  <tr>
                    <th>Detail:</th>
                    <td>
                      Saya ingin mendapatkan adanya error pada aplikasi CISEA...
                    </td>
                  </tr>
                  <tr>
                    <th>File:</th>
                    <td>
                      <div class="file-list">
                        <img src="file-image.jpg" alt="file1" />
                        <img src="file-report.jpg" alt="file2" />
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="comment-box">
              <label for="comment">Comment</label>
              <textarea
                id="comment"
                class="form-control"
                rows="3"
                placeholder="Add your comment"
              ></textarea>
              <div
                class="d-flex justify-content-between align-items-center mt-3"
              >
                <small>*Upload requirements: Max 2MB, JPG/PNG only</small>
                <button class="btn btn-primary">Send</button>
              </div>
            </div>

            <div class="history mt-4">
              <h6>History</h6>
              <div class="history-item">
                <p><strong>Fadli</strong> (29/09/2024)</p>
                <p>Saya telah menyelesaikan masalah terkait modul Finance...</p>
              </div>
              <div class="history-item">
                <p><strong>AssistMe</strong> (28/09/2024)</p>
                <p>
                  Laporan mengenai error pada modul Finance telah diterima...
                </p>
              </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button class="btn btn-danger">Close the Ticket</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
