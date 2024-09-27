<?php
$orders = $data['orders'];
$orderStatusOptions = $data['orderStatusOptions'];

?>

<h2 class="center">List of User Orders</h2>
<br>

<br>

<table>
  <tr>
    <th>ID</th>
    <th>User ID</th>
    <th>Order Date</th>
    <th>Total</th>
    <th>Status</th>
  </tr>

  <?php foreach ($orders as $order): ?>
    <tr>
      <td><?= $order->id ?></td>
      <td><?= $order->user_id ?></td>
      <td><?= $order->order_date ?></td>
      <td>$<?= $order->total ?></td>
      <td>
        <select name="status" id="status" onchange="updateOrderStatus(<?= $order->id ?>)" class="<?= $order->status == 'completed' ? 'completed' : ($order->status == 'pending' ? 'pending' : 'cancelled') ?>">
          <?php foreach ($orderStatusOptions as $option): ?>
            <?php if ($option == $order->status): ?>

              <option value="<?= $option ?>" selected><?= $option ?> </option>
            <?php else: ?>
              <option value="<?= $option ?>"><?= $option ?> </option>
            <?php endif ?>
          <?php endforeach ?>
        </select>
      </td>


    </tr>
  <?php endforeach ?>

</table>