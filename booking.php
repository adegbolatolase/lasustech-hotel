<?php
include 'updateBookings.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Lasustech Hotel: Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="img/logo.png" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link
      href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
      rel="stylesheet"
    />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <div class="container-xxl bg-white p-0">
      <!-- Spinner Start -->
      <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
      >
        <div
          class="spinner-border text-primary"
          style="width: 3rem; height: 3rem"
          role="status"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- Header Start -->
      <div class="header"></div>
      <!-- Header End -->

      <!-- Page Header Start -->
      <div
        class="container-fluid page-header mb-5 p-0"
        style="background-image: url(img/carousel-1.jpg)"
      >
        <div class="container-fluid page-header-inner py-5">
          <div class="container text-center pb-5">
            <h2 class="display-3 text-white mb-3 animated slideInDown">
              Booking
            </h2>
          </div>
        </div>
      </div>
      <!-- Page Header End -->

      
      <!-- Booking Start -->
      <div class="container-xxl py-5">
        <div class="container">
          <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">
              Room Booking
            </h6>
            <h1 class="mb-5">
              Book A
              <span class="text-primary text-uppercase">Luxury Room</span>
            </h1>
          </div>
          <div class="row g-5">
            <div class="col-lg-6">
              <div class="row g-3">
                <div class="col-6 text-end">
                  <img
                    class="img-fluid rounded w-75 wow zoomIn"
                    data-wow-delay="0.1s"
                    src="img/about-1.jpg"
                    style="margin-top: 25%"
                  />
                </div>
                <div class="col-6 text-start">
                  <img
                    class="img-fluid rounded w-100 wow zoomIn"
                    data-wow-delay="0.3s"
                    src="img/about-2.jpg"
                  />
                </div>
                <div class="col-6 text-end">
                  <img
                    class="img-fluid rounded w-50 wow zoomIn"
                    data-wow-delay="0.5s"
                    src="img/about-3.jpg"
                  />
                </div>
                <div class="col-6 text-start">
                  <img
                    class="img-fluid rounded w-75 wow zoomIn"
                    data-wow-delay="0.7s"
                    src="img/about-4.jpg"
                  />
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="wow fadeInUp" data-wow-delay="0.2s">
                <form method="POST" action="processBooking.php">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          placeholder="Your Name"
                          required
                        />
                        <label for="name">Your Name</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          placeholder="Your Email"
                          required
                        />
                        <label for="email">Your Email</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating date" id="date3">
                        <input
                          type="datetime-local"
                          class="form-control"
                          id="checkin"
                          name="checkin"
                          placeholder="Check In"
                          required
                        />
                        <label for="checkin">Check In</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating date" id="date4">
                        <input
                          type="datetime-local"
                          class="form-control"
                          id="checkout"
                          name="checkout"
                          placeholder="Check Out"
                          required
                        />
                        <label for="checkout">Check Out</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <select
                          class="form-select"
                          id="select1"
                          name="room_type"
                          required
                        >
                          <!-- Options will be populated by JavaScript -->
                        </select>
                        <label for="select1">Select Room Type</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input
                          type="number"
                          class="form-control"
                          id="roomQuantity"
                          name="room_quantity"
                          placeholder="Number of Rooms"
                          min="1"
                          required
                        />
                        <label for="roomQuantity">Number of Rooms</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating">
                        <input
                          type="text"
                          class="form-control"
                          id="totalAmount"
                          name="total_amount"
                          placeholder="Total Amount"
                          readonly
                        />
                        <label for="totalAmount">Total Amount</label>
                    </div>
                  </div>
                    <div class="col-12">
                      <div class="form-floating">
                        <textarea
                          class="form-control"
                          placeholder="Special Request"
                          id="special_request"
                          name="special_request"
                          style="height: 100px"
                        ></textarea>
                        <label for="special_request">Special Request</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100 py-3" type="submit">
                        Book Now
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Booking End -->

      <!-- Newsletter Start -->
      <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="row justify-content-center">
          <div class="col-lg-10 border rounded p-1">
            <div class="border rounded text-center p-1">
              <div class="bg-white rounded text-center p-5">
                <h4 class="mb-4">
                  Subscribe To Our
                  <span class="text-primary text-uppercase">Newsletter</span>
                </h4>
                <form
                  id="newsletterForm"
                  class="position-relative mx-auto"
                  style="max-width: 400px"
                >
                  <input
                    name="email"
                    id="emailInput"
                    class="form-control w-100 py-3 ps-4 pe-5"
                    type="email"
                    placeholder="Enter your email"
                    required
                  />
                  <button
                    type="submit"
                    class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2"
                  >
                    Submit
                  </button>
                </form>
                <div
                  id="newsletterMsg"
                  class="mt-3"
                  style="color: green; display: none"
                >
                  Thank you for subscribing!
                </div>
                <div
                  id="newsletterError"
                  class="mt-3"
                  style="color: red; display: none"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Newsletter End -->

      <!-- Footer Start -->
      <div class="footer"></div>
      <!-- Footer End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
      ></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
    $(document).ready(function() {
        // Fetch and populate room types
        $.ajax({
            url: 'fetchRooms.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (Array.isArray(response)) {
                    var roomDropdown = $('#select1');
                    roomDropdown.empty();
                    roomDropdown.append('<option value=""></option>');
                    response.forEach(function(room) {
                        roomDropdown.append('<option value="' + room.id + '" data-available="' + room.available_rooms + '" data-amount="' + room.amount + '">' + room.room_name + ' (' + room.available_rooms + ' available)</option>');
                    });
                } else {
                    console.error('Failed to fetch rooms.');
                }
            },
            error: function() {
                console.error('Error fetching rooms.');
            }
        });

        // Update max value of roomQuantity based on selected room type
        $('#select1').change(function() {
            var selectedOption = $(this).find('option:selected');
            var availableRooms = selectedOption.data('available');
            var roomPrice = selectedOption.data('amount');
            $('#roomQuantity').attr('max', availableRooms).val(''); // Reset value and set max attribute

            // Calculate and display total amount when room type is changed
            calculateTotalAmount(roomPrice);
        });

        // Update total amount on quantity change
        $('#roomQuantity').on('input', function() {
            var selectedOption = $('#select1').find('option:selected');
            var roomPrice = selectedOption.data('amount');
            calculateTotalAmount(roomPrice);
        });

        // Function to calculate and display the total amount
        function calculateTotalAmount(roomPrice) {
            var roomQuantity = parseInt($('#roomQuantity').val(), 10) || 0; // Default to 0 if NaN
            var totalAmount = roomPrice * roomQuantity;
            $('#totalAmount').val('₦' + totalAmount.toLocaleString());
        }

        // Set minimum check-in date to current date and time
        var now = new Date();
        var minDateTime = now.toISOString().slice(0, 16); // Format to YYYY-MM-DDTHH:MM
        $('#checkin').attr('min', minDateTime);

        // Validate dates on change
        $('#checkin, #checkout').change(function() {
            var checkinDate = new Date($('#checkin').val());
            var checkoutDate = new Date($('#checkout').val());

            if (checkoutDate <= checkinDate && $('#checkout').val() !== '') {
                alert("Check-Out date/time must be later than Check-In date/time.");
                $('#checkout').val('');
            }
        });
    });
</script>

        
        
  </body>
</html>
