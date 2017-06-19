<div class="container-fluid">
    <h1 id="blabla">Order History</h1>
    <table class="table">
        <tr>
            <th>OrderID</th>
            <th>Product</th>
            <th>Person</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php

        $db->getOrderHistory()
        ?>
    </table>

</div>