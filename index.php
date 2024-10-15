<?php include 'includes/head.php'; ?>
<?php include 'includes/config.php'; // Database connection ?>
<main>
  <div class="container" id="main_wrapper">
    <div class="row py-3 justify-content-center">
      <div class="col-md-8">
        <!-- Bootstrap 5 Carousel -->
        <div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/donate1.png" class="d-block w-100" alt="Slide 1" style="height: auto; object-fit: cover;">
              <div class="carousel-caption d-none d-md-block">
                <h5>Donate Blood, Save Lives</h5>
                <p>Your blood donation can be the difference between life and death for someone in need. Join the cause and give the gift of life.</p>
              </div>
            </div>

            <div class="carousel-item">
              <img src="images/donate1.png" class="d-block w-100" alt="Slide 2">
              <div class="carousel-caption d-none d-md-block">
                <h5>Join Us Today</h5>
                <p>Every drop counts! Contribute to your community and help those in need.</p>
              </div>
            </div>

            <!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" novalidate>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="alert alert-danger"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" id="userType" name="userType" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="donor">Donor</option>
                            <option value="recipient">Recipient</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="LoginEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="Loginemail" id="LoginEmail1" required>
                    </div>
                    <div class="mb-3">
                        <label for="LoginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="Loginpassword" id="LoginPassword" required>
                    </div>
                    <div class="mb-3 text-center">
                        <span>Don't have an account? <a href="register.php">Register Now</a></span>
                    </div>
                    <div class="mb-3 text-right">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

            <div class="carousel-item">
              <img src="images/donate1.png" class="d-block w-100" alt="Slide 3">
              <div class="carousel-caption d-none d-md-block">
                <h5>Make a Difference</h5>
                <p>Your contribution can save lives. Be a hero and donate blood today!</p>
              </div>
            </div>
          </div>

          <!-- Carousel controls -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="col-md-12 pt-4 text-center">
         
            <button class="btn btn-light border-none"  type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
              <img src="images/donateBlood Button.png" alt="Donate Blood" style="max-width: 100%; height: auto;">
            </button>
         
        </div>
      </div>
    </div>

    <!-- Headline section -->
    <div class="row row-cols-1 row-cols-md-2 mt-5">
      <div class="col-md-12">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut aspernatur debitis neque consequuntur vitae impedit, accusantium mollitia in odio. Est, nihil.</p>
      </div>
    </div>

    <!-- About Us and News Feed Section -->
    <div class="row row-cols-1 row-cols-md-2 mt-5">
      <div class="col-md">
        <img class="img-fluid pb-4" id="tube" src="images/AboutUsImg.png" alt="Blood Tube">
      </div>
      
      <div class="col-md">
        <div class="table-responsive" style="max-height: 100%; overflow-y: auto;">
          <table class="table table-bordered table-striped rounded" id="scrollableTable">
            <thead>
              <tr><th scope="col"><h4>News Feed</h4></th></tr>
            </thead>
            <tbody>
              <?php
              // Fetch latest blood requests from the database
              $sql = "SELECT requested_blood_group, message, created_at FROM blood_requests ORDER BY created_at DESC LIMIT 5"; // Fetch last 5 requests
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr><td><strong>" . htmlspecialchars($row['requested_blood_group']) . "</strong> blood needed. " . htmlspecialchars($row['message']) . " <br><small>Posted on: " . date("F j, Y", strtotime($row['created_at'])) . "</small></td></tr>";
                  }
              } else {
                  echo "<tr><td>No donation requests at the moment.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
// Set the max height of the table to match the image height
document.addEventListener('DOMContentLoaded', function() {
  var img = document.getElementById('tube');
  var table = document.getElementById('scrollableTable');
  table.parentElement.style.maxHeight = img.offsetHeight + 'px';
});
</script>
