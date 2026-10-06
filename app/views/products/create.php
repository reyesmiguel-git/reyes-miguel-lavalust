<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #eef5ff;
            margin: 0;
            padding: 40px;
            color: #1e293b;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.10);
            border: 1px solid #dbeafe;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
            color: #1e3a8a;
            font-size: 30px;
            font-weight: 700;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #1e3a8a;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            font-size: 14px;
            background: #ffffff;
            color: #1e293b;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.10);
        }

        input::placeholder,
        textarea::placeholder {
            color: #94a3b8;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 3px;
        }

        button {
            border: none;
            padding: 11px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .save-btn {
            background: #2563eb;
            color: white;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .back-btn {
            background: #ffffff;
            color: #475569;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            font-weight: 600;
        }

        .back-btn:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add Product</h1>

    <!-- Updated Form Action -->
    <form action="<?= site_url('login/products/store'); ?>" method="POST">

        <label>Product Name</label>
        <input type="text" name="product_name" placeholder="Enter product name" required>

        <label>Description</label>
        <textarea name="description" placeholder="Enter product description" required></textarea>

        <label>Price</label>
        <input type="number" name="price" step="0.01" min="0" placeholder="0.00" required>

        <label>Quantity</label>
        <input type="number" name="quantity" min="0" placeholder="Enter quantity" required>

        <div class="buttons">
            <button type="submit" class="save-btn">Save Product</button>
            <!-- Updated Back Link -->
            <a href="<?= site_url('login/products'); ?>" class="back-btn">Back</a>
        </div>

    </form>

</div>

</body>
</html>