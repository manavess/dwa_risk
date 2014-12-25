<div class="colleges index">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th width="12%">College Code</th>
            <th width="26%">Name</th>
            <th width="18%">University id</th>
            <th width="10%">No of Seats</th>
            <th width="12%">Affiliated from</th>
            <th width="12%">Affiliated to</th>
        </tr>
        <?php foreach ($colleges as $college): ?>
            <tr>
                <td><?php echo h($college['College']['college_code']); ?></td>
                <td><?php echo h($college['College']['name']); ?></td>
                <td><?php echo h($college['University']['name']); ?></td>
                <td><?php echo h($college['College']['no_of_seats']); ?></td>
                <td><?php $affilatedddate = date("d-m-Y", strtotime($college['College']['affilated_from'])); ?><?php echo h($affilatedddate); ?></td>
                <td><?php $affilatedtoddate = date("d-m-Y", strtotime($college['College']['affilated_to'])); ?><?php echo h($affilatedtoddate); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>