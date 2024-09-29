<?php
$user_orders = $data['user_orders'] ?? '';
?>

<h1 class="center">Your orders </h1>

<?php if (!empty($user_orders)): ?>
  <table>
    <thead>
      <tr>

        <th>ID</th>
        <th>Order Date</th>
        <th>Total</th>
        <th>Status</th>

      </tr>
    </thead>

    <tbody>
      <?php foreach ($user_orders as $order): ?>
        <tr>
          <td>
            <?= $order->id ?>
          </td>
          <td><?php echo date('d/m/Y', strtotime($order->order_date))  ?></td>
          <td>$<?= $order->total ?></td>
          <td><button class="<?= $order->status == 'completed' ? 'completed' : ($order->status == 'pending' ? 'pending' : 'cancelled') ?>"><?= $order->status ?></button></td>
        </tr>

      <?php endforeach ?>
    </tbody>
  </table>


<?php else: ?>
  <h3 class="center">You have no orders yet.</h3>
<?php endif ?>