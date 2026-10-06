<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0"
    >

    <title>Product Management</title>

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
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.10);
            border: 1px solid #dbeafe;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            color: #1e3a8a;
            font-size: 30px;
            font-weight: 700;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            padding: 11px 18px;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            padding: 11px 18px;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            border: 1px solid #dbeafe;
            border-radius: 8px;
        }

        th,
        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #eff6ff;
            color: #1e3a8a;
            font-weight: 700;
            border-bottom: 2px solid #bfdbfe;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        td:last-child {
            white-space: nowrap;
            width: 150px;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 8px 13px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            margin-right: 6px;
            vertical-align: middle;
            transition: 0.2s;
        }

        .edit-btn {
            background: #2563eb;
            color: white;
        }

        .edit-btn:hover {
            background: #1d4ed8;
        }

        .delete-btn {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .delete-btn:hover {
            background: #fee2e2;
            border-color: #fca5a5;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }

    </style>

</head>


<body>


<div class="container">


    <div class="header">

        <h1>Product Management</h1>

        <div class="header-buttons">

            <!-- ADD PRODUCT -->

            <a 
                href="<?= site_url('login/products/create'); ?>" 
                class="add-btn"
            >
                + Add Product
            </a>


            <!-- LOGOUT -->

            <a 
                href="<?= site_url('logout'); ?>" 
                class="logout-btn" 
                onclick="return confirm('Are you sure you want to logout?');"
            >
                Logout
            </a>

        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Product Name</th>

                <th>Description</th>

                <th>Price</th>

                <th>Quantity</th>

                <th>Created At</th>

                <th>Actions</th>

            </tr>

        </thead>


        <tbody>

        <?php if (!empty($products)): ?>

            <?php foreach ($products as $product): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($product['id']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['product_name']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['description']); ?>
                    </td>

                    <td>
                        ₱<?= number_format($product['price'], 2); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['quantity']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['created_at']); ?>
                    </td>

                    <td>

                        <!-- EDIT -->

                        <a 
                            href="<?= site_url('login/products/edit/' . $product['id']); ?>" 
                            class="edit-btn"
                        >
                            Edit
                        </a>


                        <!-- DELETE -->

                        <a 
                            href="<?= site_url('login/products/delete/' . $product['id']); ?>" 
                            class="delete-btn" 
                            onclick="return confirm('Are you sure you want to delete this product?');"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td 
                    colspan="7" 
                    class="empty"
                >
                    No products found.
                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>


</div>


</body>

</html>