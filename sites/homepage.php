
<div class="container-fluid">
<h1 id="blabla">Open Orders</h1>
            <table class="table table-striped">
                <tr>
                    <th>OrderID</th>
                    <th>Product</th>
                    <th>Person</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php

                $db->getOpenOrdersList()
                ?>
            </table>
</div>