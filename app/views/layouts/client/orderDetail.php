<?php
$order_items = $data['order_items'];
$order_id = $data['order_items'][0]->id;
$order_date = $data['order_items'][0]->order_date;
// show_data($order_items);

?>


<button class="success" onclick="backToClientOrdersList()"><i class="bi bi-chevron-left"></i> Back to Orders List</button>

<h1 class="center">Your Order# <?= $order_id ?> on <?= $order_date ?> </h1>


<br>
<br>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th colspan="2">Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td>
                        <a href="http://localhost/php_bookstore/books/book/?id=<?= $item->book_id ?>">
                            <img src="<?= $item->image_url ?>" alt="<?= $item->title ?>" class="book-image-cart">
                        </a>
                    </td>
                    <td>
                        <a href="http://localhost/php_bookstore/books/book/?id=<?= $item->book_id ?>">
                            <?= $item->title ?>
                        </a>
                    </td>
                    <td>$<?= $item->price ?></td>
                    <td><?= $item->quantity ?></td>
                    <td>$<?= $item->quantity * $item->price  ?></td>
                    <td><button class="<?= $item->status == 'completed' ? 'completed' : ($item->status == 'pending' ? 'pending' : 'cancelled') ?>"> <?= $item->status ?></button></td>

                </tr>
            <?php endforeach ?>
            <tr>
                <th colspan="4" style="text-align: right;">Total Amount</th>
                <td colspan="2"><strong>$<?= $item->total ?></strong></td>
            </tr>


            <tr></tr>
        </tbody>



    </table>
</div>