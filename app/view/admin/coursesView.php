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
                <option value="<?= $cat["id"]?>"><?= esc($cat["category"])?></option>
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
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Primary Subject</th>
        <th scope="col">Creation Date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Brandon Jacob</td>
        <td>Design</td>
        <td>28</td>
        <td>Figma UI</td>
        <td>2016-05-25</td>
        <td>
          <i class="bi bi-pencil-square"></i>
          <i class="bi bi-trash-fill"></i>
        </td>
      </tr>
    </tbody>
  </table>
<?php endif;?>
<?php $this->view('admin/adminfooter');?>