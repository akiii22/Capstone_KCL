<?php
require_once ('../components/connect2.php');

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

$query = "SELECT * FROM orders WHERE status='delivered'";

if ($filter == 'this_week') {
    $query .= " AND WEEK(date) = WEEK(NOW()) AND YEAR(date) = YEAR(NOW())";
} elseif ($filter == 'last_week') {
    $query .= " AND WEEK(date) = WEEK(NOW()) - 1 AND YEAR(date) = YEAR(NOW())";
} elseif ($filter == 'this_month') {
    $query .= " AND MONTH(date) = MONTH(NOW()) AND YEAR(date) = YEAR(NOW())";
} elseif ($filter == 'last_month') {
    $query .= " AND MONTH(date) = MONTH(NOW()) - 1 AND YEAR(date) = YEAR(NOW())";
}

$orderQuery = mysqli_query($conn2, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Reports</title>
    <link rel="stylesheet" href="./css/report.css">
    <style>
        body {
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
  padding: 20px;
  color: #333;
}

.content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

h1 {
  margin: 0;
  color: #00e77f;
}

.order {
  margin: 20px 0;
  font-size: 24px;
  color: #333;
}

button.print-button {
  background-color: #00e77f;
  color: #000;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button.print-button:hover {
  opacity: 0.8;
}

.filter-form {
  margin-bottom: 20px;
}

.filter-form select {
  padding: 5px;
  font-size: 16px;
  border: 1px solid #ced4da;
  border-radius: 4px;
  transition: border-color 0.3s;
}

.filter-form select:focus {
  border-color: #00e77f;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table,
th,
td {
  border: 1px solid #dee2e6;
}

th,
td {
  padding: 15px;
  text-align: left;
}

th {
  background-color: #00e77f;
  color: white;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Styles for printing */
@media print {
  button.print-button {
    display: none;
  }

  body {
    margin: 0;
    padding: 0;
  }

  .content {
    margin: 0;
    padding: 0;
    width: 100%;
  }

  h1 {
    font-size: 24pt;
  }

  p {
    font-size: 12pt;
  }
}

    </style>
</head>

<body>
    <div class="content">
        <header>
            <h1>KCL Hardware</h1>
            <div class="order">Order Reports</div>
            <button onclick="window.print()" class="print-button">Print</button>
        </header>
        <br>
        <div>
            <form method="GET" action="" class="filter-form">
                <label for="filter">Filter By:</label>
                <select name="filter" id="filter" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="this_week" <?php if ($filter == 'this_week') echo 'selected'; ?>>This Week</option>
                    <option value="last_week" <?php if ($filter == 'last_week') echo 'selected'; ?>>Last Week</option>
                    <option value="this_month" <?php if ($filter == 'this_month') echo 'selected'; ?>>This Month</option>
                    <option value="last_month" <?php if ($filter == 'last_month') echo 'selected'; ?>>Last Month</option>
                </select>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Products</th>
                        <th>Customer</th>
                        <th>Payment Method</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fetchOrder = mysqli_fetch_array($orderQuery)) { ?>
                        <tr>
                            <td><?php echo $fetchOrder['id']; ?></td>
                            <td><?php echo $fetchOrder['order_name']; ?></td>
                            <td>
                                <small>Full Name</small><br>
                                <?php echo $fetchOrder['name']; ?><br>
                                <small>Email</small><br>
                                <?php echo $fetchOrder['email']; ?><br>
                                <small>Phone Number</small><br>
                                <?php echo $fetchOrder['number']; ?><br>
                                <small>Address (<?php echo $fetchOrder['address_type']; ?>)</small><br>
                                <?php echo $fetchOrder['address']; ?>
                            </td>
                            <td><?php echo strtoupper($fetchOrder['method']); ?></td>
                            <td>₱ <?php echo number_format($fetchOrder['price']); ?></td>
                            <td><?php echo $fetchOrder['qty']; ?></td>
                            <td><?php echo $fetchOrder['date']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
