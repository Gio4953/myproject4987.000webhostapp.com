<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/produclist.css">
    <title>Product List</title>
</head>

<body>
    <header>
        <h1 id="product-list-header">PRODUCT LIST</h1>
        <div id="button-container">
            <button class="add-button button"  onclick="window.location.href='add.php'">ADD</button>
        </div>
    </header>
    <div class="main">
        <?php
        ob_start();
        include_once 'connection.php';
        $sql = "SELECT sku, name, price, size, weight, height, width, length FROM items";
        $result = $conn->query($sql);
        if (isset($_POST['save'])) {
            $sku = $_POST['sku'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $productType = $_POST['productType'];
            $size = '';
            $weight = '';
            $height = '';
            $width = '';
            $length = '';
            $check_duplicate = mysqli_query($conn, "SELECT * FROM items WHERE SKU='$sku'");
            if (mysqli_num_rows($check_duplicate) > 0) {
                header("Location:https://myproject4987.000webhostapp.com/index.php");
                echo "Error: A product with SKU '$sku' already exists.";
                @mysqli_query($conn, "INSERT INTO items (SKU, name, price) VALUES ('$sku', '$name', '$price')");
                if (mysqli_errno($conn)) {
                }
            }
            if ($productType === 'dvd') {
                $size = $_POST['size'];
                $sql = "INSERT INTO items (sku, name, price, size)
                VALUES ('$sku', '$name', '$price', '$size')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: https://myproject4987.000webhostapp.com/index.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else if ($productType === 'book') {
                $weight = $_POST['weight'];
                $sql = "INSERT INTO items (sku, name, price,  weight)
                VALUES ('$sku', '$name', '$price', '$weight')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: https://myproject4987.000webhostapp.com/index.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else if ($productType === 'furniture') {
                $height = $_POST['height'];
                $width = $_POST['width'];
                $length = $_POST['length'];
                $sql = "INSERT INTO items (sku, name, price,  height, width, length)
                VALUES ('$sku', '$name', '$price','$height',  '$width', '$length')";
                if (mysqli_query($conn, $sql)) {
                    header("Location: https://myproject4987.000webhostapp.com/index.php");
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        ?>
        <form method="post">
            <div class='items-container'>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "
         <div class='item'>
            <input type='checkbox' text='delete-checkbox' class='delete-checkbox' name='checkbox[]' value='$row[sku]' id='$row[sku]'>
            <p>sku: $row[sku] </p>
            <p>Name: $row[name] </p>
            <p>Price: $ $row[price] </p>
            <p>";
                    if ($row['size'] > 0)
                        echo "Size: " . $row['size'] . " MB" . "<br><br>";
                    if ($row['weight'] > 0)
                        echo "Weight: " . $row['weight'] . " KG" . "<br><br>";
                    if ($row['height'] > 0)
                        echo "Dimension: " . $row['height'] . " x " . $row['width'] . " x " . $row['length'];
                    echo "</p>
         </div>";
                }
                ?>
                <input type="submit" name="delete" value="MASS DELETE" class="mass-delete-button" id="delete-product-btn">
            </div>
        </form>
        <?php
        if (isset($_POST['delete'])) {
            if (isset($_POST['checkbox'])) {
                $checkbox = $_POST['checkbox'];
                $count = count($checkbox);
                for ($i = 0; $i < $count; $i++) {
                    $del_id = $checkbox[$i];
                    $sql = "DELETE FROM items WHERE sku='$del_id'";
                    mysqli_query($conn, $sql);
                }
                header("Location: {$_SERVER['PHP_SELF']}");
                exit;
            } else {
                echo '<p>Please select an item to delete...</p>';
            }
        }
        mysqli_close($conn);
        ob_end_flush();
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".delete-checkbox").click(function() {
                console.log("Checkbox clicked");
                $(this).toggleClass("checked");
            });
        });
        $("#mass-delete-button").click(function() {
            console.log("Mass delete button clicked");
            $(".delete-checkbox:checked").each(function() {
                $(this).closest("div").remove();
            });
        });
    </script>
</body>

</html>
