<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Delivery Bot Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            padding: 30px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        img {
            display: block;
            margin: 0 auto 20px;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        button {
            background-color: #007bff;
            color: white;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Alpha Delivery Bot Booking</h2>
        <img src="robot.jpg" alt="Alpha Delivery Robot" class="img-fluid">
        <form id="bookingForm">
            <div class="mb-3">
                <label for="sender_room" class="form-label">Your Room:</label>
                <select name="sender_room" id="sender_room" class="form-select" required>
                    <option value="Office A">Office A</option>
                    <option value="Office B">Office B</option>
                    <option value="Office C">Office C</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="recipient_room" class="form-label">Recipient's Room:</label>
                <select name="recipient_room" id="recipient_room" class="form-select" required>
                    <option value="Office A">Office A</option>
                    <option value="Office B">Office B</option>
                    <option value="Office C">Office C</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="return_to_sender" class="form-label">Return After Delivery:</label>
                <select name="return_to_sender" id="return_to_sender" class="form-select" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="sender_email" class="form-label">Your Email:</label>
                <input type="email" name="sender_email" id="sender_email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="recipient_email" class="form-label">Recipient's Email:</label>
                <input type="email" name="recipient_email" id="recipient_email" class="form-control" placeholder="Enter recipient's email" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Book Now</button>
        </form>
    </div>

    <script>
        // Handle form submission
        document.getElementById("bookingForm").addEventListener("submit", async function(event) {
            event.preventDefault();

            // Gather form data
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData);

            try {
                // Send data to the server
                const response = await fetch("submit_booking.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                // Handle response and show notification
                if (result.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Booking Successful",
                        text: "Your booking has been recorded successfully.",
                        confirmButtonText: "OK"
                    });
                    event.target.reset(); // Reset the form
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Booking Failed",
                        text: result.message || "An error occurred. Please try again.",
                        confirmButtonText: "OK"
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Unable to connect to the server. Please try again later.",
                    confirmButtonText: "OK"
                });
            }
        });
    </script>