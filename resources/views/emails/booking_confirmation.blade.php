<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Dear {{ $name }},</h2>
    <p>Thank you for booking a room with us!</p>
    <p><strong>Check-in:</strong> {{ $start_date}}</p>
    <p><strong>Check-out:</strong> {{ $end_date }}</p>
    <p><strong>Total Price:</strong> ${{ $price }}</p>
    <p>We look forward to welcoming you.</p>
    <p>Best regards,</p>
    <p><strong>Scope Realty</strong></p>
</body>
</html>
