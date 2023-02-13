<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addstyle.css">
    <title>Add Product</title>
</head>

<body>
    <header>
        <h1>Add Product</h1>
    </header>
    <br><br>
    <form name="myForm" action="index.php" onsubmit="return validateForm()" method="post">
        <div id="save_cancel">
            <input autocomplete=off type="submit" id="save-btn" name="save" value="Save">
            <input autocomplete=off type="submit" id="cancel-btn" name="cancel" value="Cancel">
        </div>
        <div>
            <label for="sku">SKU</label>
            <input autocomplete=off placeholder="#SKU" type="text" id="sku" name="sku">
        </div>
        <br><br>
        <div>
            <label for="name">Name</label>
            <input autocomplete=off placeholder="#Name" type="text" id="name" name="name">
        </div>
        <br><br>
        <div>
            <label for="price">Price($)</label>
            <input autocomplete=off placeholder="#Price" type="text" id="price" name="price">
        </div>
        <br><br>
        <div>
            <label for="product_type">Product type</label>
            <select id="product_type" name="product_type">
                <option value="dvd">DVD</option>
                <option value="book">Book</option>
                <option value="furniture">Furniture</option>
            </select>
            <div id="dvd-options" style="display: dvd-options">
                <p>Please provide size</p>
                <label for="size">Size (MB)</label>
                <input autocomplete=off placeholder="#Size" type="text" id="size" name="size">
            </div>
            <div id="book-options" style="display: none">
                <p>Please provide weight</p>
                <label for="weight">Weight (Kg)</label>
                <input autocomplete=off placeholder="#Weight" type="text" id="weight" name="weight">
            </div>
            <div id="furniture-options" style="display: none">
                <p>Please provide dimensions</p>
                <label for="height">Height(CM)</label>
                <input autocomplete=off placeholder="#Height" type="text" id="height" name="height">
                <br><br>
                <label for="width">Width(CM)</label>
                <input autocomplete=off placeholder="#Width" type="text" id="width" name="width">
                <br><br>
                <label for="length">Length(CM)</label>
                <input autocomplete=off placeholder="#Length" type="text" id="length" name="length">
            </div>
    </form>
    <script>
        document.getElementById('product_type').addEventListener('change', function() {
            const productType = this.value;
            const dvdOptions = document.getElementById('dvd-options');
            const bookOptions = document.getElementById('book-options');
            const furnitureOptions = document.getElementById('furniture-options');

            dvdOptions.style.display = 'none';
            bookOptions.style.display = 'none';
            furnitureOptions.style.display = 'none';

            if (productType === 'dvd') {
                dvdOptions.style.display = 'block';
            } else if (productType === 'book') {
                bookOptions.style.display = 'block';
            } else if (productType === 'furniture') {
                furnitureOptions.style.display = 'block';
            }
        });
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <?php
    include 'connection.php';

    mysqli_close($conn);

    ?>
    <script>
        document.getElementById('save-btn').addEventListener('click', function(event) {
            const sku = document.getElementById('sku').value;
            const name = document.getElementById('name').value;
            const price = document.getElementById('price').value;
            const productType = document.getElementById('product_type').value;
            let size = '';
            let weight = '';
            let height = '';
            let width = '';
            let length = '';

            if (productType === 'dvd') {
                size = document.getElementById('size').value;
            } else if (productType === 'book') {
                weight = document.getElementById('weight').value;
            } else if (productType === 'furniture') {
                height = document.getElementById('height').value;
                width = document.getElementById('width').value;
                length = document.getElementById('length').value;
            }

            if (!sku || !name || !price || (!size && !weight && !height && !width && !length)) {
                event.preventDefault();
                alert('Please, provide the data of indicated type');
            }
        });
    </script>
    <script>
        function validateForm() {
            var sku = document.forms["myForm"]["sku"].value;
            var name = document.forms["myForm"]["name"].value;
            var price = document.forms["myForm"]["price"].value;
            var size = document.forms["myForm"]["size"].value;
            var weight = document.forms["myForm"]["weight"].value;
            var height = document.forms["myForm"]["height"].value;
            var width = document.forms["myForm"]["height"].value;
            var length = document.forms["myForm"]["height"].value;
            var regex = /^[a-zA-Z]+$/;

            if (name !== "" && !regex.test(name)) {
                alert("Name should contain only letters.");
                return false;
            }

            if (price !== "" && !price.match(/^\d+$/)) {
                alert("Price should contain only numbers");
                return false;
            }
            if (size !== "" && !size.match(/^\d+$/)) {
                alert("Size should contain only numbers");
                return false;
            }
            if (weight !== "" && !weight.match(/^\d+$/)) {
                alert("Weight should contain only numbers");
                return false;
            }
            if (height !== "" && !height.match(/^\d+$/)) {
                alert("Height should contain only numbers");
                return false;
            }
            if (width !== "" && !width.match(/^\d+$/)) {
                alert("Width should contain only numbers");
                return false;
            }
            if (length !== "" && !length.match(/^\d+$/)) {
                alert("Length should contain only numbers");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>