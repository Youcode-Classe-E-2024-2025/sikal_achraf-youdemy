<?php $this->view('admin/adminheader',$data);?>
<?php if ($action == "add"):?>
  <div class="card col-md-5 mx-auto">
    <div class="card-body">
      <h5 class="card-title">New Course</h5>

      <form class="row g-3" method="post" >
        <div class="col-md-12">
          <input value="<?= set_value("title")?>" name="title" type="text" class="form-control <?=!empty($errors["title"]) ? 'border-danger':'';?>" placeholder="Title">
        </div>
        <?php if (!empty($errors["title"])) {?>
          <small class="text-danger"><?=$errors["title"]?></small>
        <?php }?>
        <div class="col-md-12">
          <select name="category_id" id="inputState" class="form-select <?=!empty($errors["category_id"]) ? 'border-danger':'';?>">
            <option value="" selected="">Course Category...</option>
            <?php if(!empty($categories)):?>
              <?php foreach($categories as $cat):?>
                <option <?= set_select('category_id',$cat["id"])?> value="<?= $cat["id"]?>"><?= esc($cat["category"])?></option>
              <?php endforeach;?>
            <?php endif;?>
          </select>
        </div>
        <?php if (!empty($errors["category_id"])) {?>
          <small class="text-danger"><?=$errors["category_id"]?></small>
        <?php }?>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Create</button>
          <a href="<?=ROOT?>/admin/courses">
            <button type="button" class="btn btn-secondary">Cancel</button>
          </a>
        </div>
      </form>

    </div>
  </div>
<?php elseif ($action == "edit"):?>
<?php else:?>
  <h2>My Courses 
    <a href="<?=ROOT?>/admin/courses/add">
      <button class="btn btn-primary float-end"><i class="bi bi-pen"></i> New Course</button>
    </a>
  </h2>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Teacher</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Primary Subject</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <?php if(!empty($rows)):?>
      <tbody>
      <?php foreach($rows as $row):?>
        <tr>
            <td><?=esc($row['title'])?></td>
            <td><?=esc($row['user_row']['name'] ?? 'Unknown')?></td>
            <td><?=esc($row['category_row']['category'] ?? 'Unknown')?></td>
            <td><?=esc($row['price'])?></td>
            <td><?=esc($row['primary_subject'])?></td>
            <td><?=date("jS M, Y h:s a", strtotime($row['created_at']))?></td>
            <td>
              <i class="bi bi-pencil-square"></i>
              <i class="bi bi-trash-fill"></i>
            </td>
        </tr>
      <?php endforeach;?>
      </tbody>
    <?php endif;?>
  </table>
<?php endif;?>
<?php $this->view('admin/adminfooter');?>