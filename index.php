<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order System</title>
</head>
<body>
    <h1>Menu</h1>
    <table border="1" style="width: 30%">
        <tr>
            <th>Order</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>Burger</td>
            <td>50</td>
        </tr>
        <tr>
            <td>Fries</td>
            <td>75</td>
        </tr>
        <tr>
            <td>Steak</td>
            <td>150</td>
        </tr>
    </table>

    <form action="" method="post">
        <label for="order">Select an Order: </label>
        <select name="order" id="order">
            <option value="burger">Burger</option>
            <option value="fries">Fries</option>
            <option value="steak">Steak</option>
        </select>
        <br><br>
        <label for="quantity">Quantity: </label>
        <input type="number" id="quantity" name="quantity" required>
        <br><br>
        <label for="cash">Cash: </label>
        <input type="number" id="cash" name="cash" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Set the time zone
        date_default_timezone_set('Asia/Manila'); // Adjust the timezone based on your location

        $order = $_POST['order'];
        $quantity = (int)$_POST['quantity'];
        $cash = (int)$_POST['cash'];

        // Price list
        $prices = [
            'burger' => 50,
            'fries' => 75,
            'steak' => 150,
        ];

        // Calculate total price
        if (isset($prices[$order])) {
            $totalPrice = $prices[$order] * $quantity;
            echo "<h2>Receipt</h2>";
            echo "Order: " . ucfirst($order) . "<br>";
            echo "Quantity: " . $quantity . "<br>";
            echo "Total Price: PHP " . $totalPrice . "<br>";
            echo "You Paid: PHP " . $cash . "<br>";

            // Check if cash is enough
            if ($cash >= $totalPrice) {
                $change = $cash - $totalPrice;
                echo "Change: PHP " . $change . "<br>";
                echo "Date: " . date('Y-m-d') . "<br>";
                echo "Time: " . date('H:i:s') . "<br>";
            } else {
                $balance = $totalPrice - $cash;
                echo "<p style='color: red;'>Sorry, balance not enough. You still owe PHP " . $balance . ".</p>";
            }
        } else {
            echo "<p style='color: red;'>Invalid order selected.</p>";
        }
    }
    ?>
</body>
</html>