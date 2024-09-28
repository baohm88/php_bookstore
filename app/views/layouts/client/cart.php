<?php

$cart_items = $_SESSION['cart_items'] ?? '';
$totalAmount = $data['totalAmount'] ?? 0;

?>

<?php if (!empty($cart_items)): ?>
  <div class="cart-container">
    <div class="cart-table">
      <h1>Your cart </h1>
      <table>
        <thead>
          <tr>
            <th colspan="2" class="center">Title</th>
            <th>Qty</th>
            <th>Price</th>
            <!-- <th class="center">Actions</th> -->
          </tr>
        </thead>

        <tbody>
          <?php foreach ($cart_items as $book): ?>
            <tr>
              <td>
                <img src="<?= $book->image_url ?>" alt="<?= $book->title ?>" class="book-image-cart">
              </td>
              <td><?= $book->title ?></td>
              <td><?= $book->quantity ?></td>
              <td>$<?= $book->price_out ?></td>
              <!-- <td class="center"><i class="bi bi-trash3-fill center" style="color: red"></i></td> -->
            </tr>

          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <div class="cart-summary">
      <h2>Cart Summary</h2>
      <p class="flex-container">
        <span>Subtotal</span>
        <span><strong> $<?= $totalAmount ?> </strong></span>
      </p>
      <hr>
      <p class="flex-container">
        <span>Estimated Delivery & Handling</span>
        <span><strong>Free</strong></span>
      </p>
      <hr>
      <p class="flex-container">
        <span>Total</span>
        <span><strong> $<?= $totalAmount ?> </strong></span>
      </p>
      <hr>

      <p>
      <form action="http://localhost/php_bookstore/orders/createOrder/" method="POST">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user']->id ?>" />
        <input type="hidden" name="cartItems" value="<?= $cart_items ?>">
        <input type="hidden" name="totalAmount" value="<?= $totalAmount ?>">
        <button type="submit" class="cart-button">Checkout</button>
      </form>
      </p>

    </div>
  </div>


<?php else: ?>
  <h1 class="center">No items in your cart.</h1>
<?php endif ?>