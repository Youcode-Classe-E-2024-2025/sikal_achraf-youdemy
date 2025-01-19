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
          <input value="<?= set_value("primary_subject")?>" name="primary_subject" type="text" class="form-control <?=!empty($errors["primary_subject"]) ? 'border-danger':'';?>" placeholder="Primary subject e.g(Photography,design...)">
        </div>
        <?php if (!empty($errors["primary_subject"])) {?>
          <small class="text-danger"><?=$errors["primary_subject"]?></small>
        <?php }?>

        <div class="col-md-12">
          <input value="<?= set_value("price")?>" name="price" type="text" class="form-control <?=!empty($errors["price"]) ? 'border-danger':'';?>" placeholder="Price">
        </div>
        <?php if (!empty($errors["price"])) {?>
          <small class="text-danger"><?=$errors["price"]?></small>
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
<div class="card">
  <form method="post" class="card-body">
    <h5 class="card-title">Edit Course</h5>
    <?php if(!empty($row)):?>

      <div class="float-end">
        <button type ="submit" class="btn btn-success">Save</button>
        <a href="<?=ROOT?>/admin/courses">
          <button class="btn btn-primary">Back</button>
        </a>
      </div>
      <h5 class=""><?=esc($row["title"])?></h5>
      
      <!-- Bordered Tabs Justified -->
      <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="TabJustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation">
          <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100 active" id="intended_learners-tab" data-bs-toggle="tab" data-bs-target="#justified-intended_learners" type="button" role="tab" aria-controls="intended_learners" aria-selected="true">Intended learners</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
          <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#justified-curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">Curriculum</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
          <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#justified-course_landing_page" type="button" role="tab" aria-controls="course_landing_page" aria-selected="false">Course landing page</button>
        </li>
      </ul>
      <div class="tab-content pt-2" id="TabJustifiedContent">
        <div class="tab-pane fade show active" id="justified-intended_learners" role="tabpanel" aria-labelledby="intended_learners-tab">
          1
          <input type="text">
        </div>
        <div class="tab-pane fade" id="justified-curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
          2
          <input type="text">
        </div>
        <div class="tab-pane fade" id="justified-course_landing_page" role="tabpanel" aria-labelledby="course_landing_page-tab">
          <div class="row mb-3">
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Course Title</span>
              <input class="form-control" type="text" id="formFile" name="title" value="<?= set_value('title',$row['title'])?>">
            </div>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Price</span>
            <input name="price" type="number" value ="<?= set_value('price',$row['price'])?>" class="form-control">
            <span class="input-group-text">.00 $</span>
          </div>
          <div class="row mb-3">
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Primary subject</span>
              <input class="form-control" type="text" id="formFile" name="primary_subject" value="<?= set_value('primary_subject',$row['primary_subject'])?>">
            </div>
          </div>
          <div class="input-group" style="margin-bottom: 20px;">
            <span class="input-group-text">description</span>
            <textarea id="desc" name="description" class="form-control" aria-label="description"><?= set_value('description',$row['description'])?></textarea>
          </div>
          <div class="col-sm-10">
            <select name="category_id" class="form-select">
              <option selected="">--Category--</option>
              <?php if(!empty($categories)):?>
                <?php foreach($categories as $cat):?>
                  <option <?= $data['row']['category_id']==$cat["id"] ? ' selected ' : ''?> value="<?= $cat["id"]?>"><?= esc($cat["category"])?></option>
                <?php endforeach;?>
              <?php endif;?>
            </select>
          </div>
          <div class="my-4 row">
            <div class="col-sm-4">
              <img class="js-image-upload-preview" src="<?= $row['course_image']?>" style="width: 100%;height: 220px;object-fit: cover;">
            </div>
            <div class="col-sm-8">
              <div  class="h5"><b>Course Image:</b></div>
              Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.
            
              <br><br>
              <input onchange="upload_course_image(this.files[0])" class="js-image-upload-input" type="file" name="IMG">
              <div class="progress my-4">
                    <div class="progress-bar progress-bar-image" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                <div class="js-image-upload-info hide"></div>
                <button type="button" onclick="ajax_course_image_cancel()" class="js-image-upload-cancel-button btn btn-warning text-white btn-sm hide">Cancel Upload</button>
            </div>
          </div>
        </div>
      </div><!-- End Bordered Tabs Justified -->
      <?php else:?>
        <h2>That course wasn't found</h2>
    <?php endif;?>
  </form>
</div>
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
            <td><?=empty(esc($row['price'])) ? 'Free' : esc($row['price'])?></td>
            <td><?=esc($row['primary_subject'])?></td>
            <td><?=date("jS M, Y h:s a", strtotime($row['created_at']))?></td>
            <td>
              <a href="<?=ROOT?>/admin/courses/edit/<?=$row['course_id']?>">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="<?=ROOT?>/admin/courses/delete/<?=$row['course_id']?>">
                <i class="bi bi-trash-fill text-danger"></i>
              </a>
            </td>
        </tr>
      <?php endforeach;?>
      </tbody>
    <?php endif;?>
  </table>
<?php endif;?>
<script>
  let tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab"): "#intended-learners";
  let tabChanges = false;
  function show_tab(tab_name)
  {
    const someTabTriggerEl = document.querySelector(tab_name+"-tab");
    const tab = new bootstrap.Tab(someTabTriggerEl);

    tab.show();
  }
  function set_tab(tab_name)
  {
    tab = tab_name;
    sessionStorage.setItem("tab", tab_name);
  }
  let course_image_uploading = false;

  function upload_course_image(file)
  {

    if(course_image_uploading){

      alert("please wait while the other image uploads");
      return;
    }

    //display an image preview
    let img = document.querySelector(".js-image-upload-preview");
    let link = URL.createObjectURL(file);
    img.src = link;

    //begin upload
    course_image_uploading = true;

    let myform = new FormData();
    ajax_course_image = new XMLHttpRequest();

    ajax_course_image.addEventListener('readystatechange',function(){

      if(ajax_course_image.readyState == 4){

        if(ajax_course_image.status == 200){
          //everything went well
          //alert("upload complete");
          //alert(ajax_course_image.responseText);
        }

        course_image_uploading = false;

      }
    });

    ajax_course_image.addEventListener('error',function(){
      alert("an error occurred");
    });

    ajax_course_image.upload.addEventListener('progress',function(e){

      let percent = Math.round((e.loaded / e.total) * 100) + "%";
      document.querySelector(".progress-bar-image").style.width = percent;
      document.querySelector(".progress-bar-image").innerHTML = percent;

    });
 
    myform.append('data_type','upload_course_image');
    myform.append('tab_name',tab);
    myform.append('image',file);

    ajax_course_image.open('post','',true);
    ajax_course_image.send(myform);

  }
</script>
<?php $this->view('admin/adminfooter');?>