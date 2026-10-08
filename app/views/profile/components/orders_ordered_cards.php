<?php
/** 
 *@var array $orders
 */
?>

<div class="table-responsive">
  <table class="table table-info table-hover table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Total Price</th>
        <th>Details</th>
        <th>created_at</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($orders['ordered']['data'])) {
        foreach ($orders['ordered']['data'] as $order) {
          echo "
      <tr>
        <th>{$order['id']}</th>
        <td>{$order['customer_name']}</td>
        <td>{$order['total_price']}</td>
        <td><a href='#'>Show</a></td>
        <td>{$order['created_at']}</td>
        <td>
          <div class='buttons'>
            <button class='btn btn-danger me-2'>Cancel</button>
            <button class='btn btn-success'>Done</button>
          </div>
        </td>
      </tr>
  ";
        }
      } else {
        echo "<p class='alert alert-warning text-center w-75 m-auto mb-3'>No ordered orders here</p>";
      }
      ?>
    </tbody>
  </table>
</div>

<?php 
preparePagination($orders['ordered'],'orders_ordered');
?>