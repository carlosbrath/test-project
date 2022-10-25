<div class="container">
  <div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
        <h2>Categories</h2>
      </div>
      <div class="pull-right">
        <a class="btn btn-success" href="<?php echo base_url() ?>Maincontroller/category_form"> Create New Catagory</a>
      </div>
    </div>
  </div>
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Category</th>
      <th>Type</th>
      <th>Horsepower</th>
      <th width="280px">Action</th>
    </tr>

    <?php $i = 0;
    foreach ($data as $key => $value) { ?>
      <tr>
        <td><?php echo ++$i ?></td>
        <td><?php echo $value['category_title'] ?></td>
        <td><?php echo $value['vehical_type'] ?></td>
        <td><?php echo $value['horsepower'] ?></td>
        <td>

          <a class="btn btn-primary" href="<?php echo base_url(); ?>update/category/<?php echo $value['category_id']; ?>">Edit</a>
          <a class="btn btn-primary catagory-deletebtn" data-id="<?php echo $value['category_id']; ?>">Delete</a>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>