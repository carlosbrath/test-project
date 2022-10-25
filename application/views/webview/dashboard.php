<div class="container">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
        <h2>Vehical</h2>
      </div>
      <div class="pull-right">
        <a class="btn btn-success" href="<?php echo base_url()?>Maincontroller/vehical_form"> Add New Vehical</a>
      </div>
    </div>
  </div>
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Model</th>
      <th>Color</th>
      <th>Make</th>
      <th>Registration No</th>
      <th width="280px">Action</th>
    </tr>

    <?php $i = 0;
    foreach ($data as $key => $value) { ?>
      <tr>
        <td><?php echo ++$i ?></td>
        <td><?php echo $value['model'] ?></td>
        <td><?php echo $value['color'] ?></td>
        <td><?php echo $value['make'] ?></td>
        <td><?php echo $value['registration_no'] ?></td>
        <td>
          <form action="" method="POST">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>update/vehical/<?php echo $value['id']; ?>">Edit</a>
            <a class="btn btn-primary vehical-deletebtn"  data-id="<?php echo $value['id']; ?>">Delete</a>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>