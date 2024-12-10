<?php
if (isset($_GET['id'])) {
    require '../../includes/db-config.php';
    require '../../includes/helper.php';
    $id = intval($_GET['id']);
    $getdataQuery = $conn->query("SELECT * FROM sub_category WHERE ID = $id");
    $getdata = $getdataQuery->fetch_assoc();
    
    $programArr = [];
    if ($getdata['Menu_ID']) {
        $programQuery = $conn->query("SELECT * FROM category WHERE Menu_ID = " . $getdata['Menu_ID']);
        while ($program = $programQuery->fetch_assoc()) {
            $programArr[] = $program;
        }
    }
}
?>

<div class="modal-header">
  <h5 class="modal-title">Edit  Sub Category</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-sub_category" action="/admin/app/sub_category/update" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $getdata['ID'] ?>">

      <div class="row">
        <div class="mb-3 col-md-12">
          <label class="form-label">Menu<span class="text-danger">*</span></label>
          <?php $menuArr = getMenuFunc($conn); ?>
          <select name="Menu_ID" id="Menu_ID" class="form-control sumoselect" required>
            <option value="">Select Menu</option>
            <?php foreach ($menuArr as $menu) { ?>
              <option value="<?= $menu['ID'] ?>" <?= $getdata['Menu_ID'] == $menu['ID'] ? 'selected' : '' ?>><?= $menu['Name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Category<span class="text-danger">*</span></label>
          <select name="Category_ID" id="Category_ID" class="form-control sumoselect" required>
            <option value="">Select Menu First</option>
            <?php foreach ($programArr as $program) { ?>
              <option value="<?= $program['ID'] ?>" <?= $getdata['Category_ID'] == $program['ID'] ? 'selected' : '' ?>><?= $program['Name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" value="<?= $getdata['Name'] ?>" placeholder="Enter a sub_category Name.." required>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Short Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Short_Name" value="<?= $getdata['Short_Name'] ?>" placeholder="Enter a Short Name.." required>
        </div>

        <div class="mb-3 col-md-12 syllabus_file">

          <label class="form-label">Photo <span class="text-danger">*</span></label>
          <small class="text-muted">
            Please upload a valid image file (PNG, JPG, JPEG, SVG, or AVIF) with a size less than or equal to 200KB.
          </small>
          <input type="hidden" name="updated_file" value="<?= $getdata['Photo'] ?>">
          <input type="file" name="photo" id="photo" class="form-control" onchange="fileValidation('photo')" accept="image/png, image/jpg, image/jpeg, image/svg,image/avif">

          <?php if (!empty($id) && !empty($getdata['Photo'])) { ?>
            <img src="/admin<?php echo !empty($id) ? $getdata['Photo'] : ''; ?>" height="50" />
          <?php } ?>
        </div>
        <div class="mb-3 col-md-12 ">
          <label class="form-label">Content <span class="text-danger">*</span></label>
          <textarea class="ckeditor" cols="80" id="editor" name="editor" rows="10"><?= $getdata['Content'] ?></textarea>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Order By <span class="text-danger">*</span></label>
          <input type="number" min="0" class="form-control" name="position" value="<?= $getdata['Position'] ?>" placeholder="Enter a Position.." required>
        </div>
      </div>
      <div class="modal-footer clearfix text-end">
        <div class="col-md-4 m-t-10 sm-m-t-10">
          <button aria-label="" type="submit" class="btn btn-primary btn-cons btn-animated from-left">
            <span>Save</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- <script>
  $(document).ready(function() {
    function get_programs(departmentID) {
      if (departmentID) {
        $.ajax({
          type: 'POST',
          url: '/admin/app/sub_category/get_program',
          data: { department_id: departmentID },
          success: function(html) {
            $('#Program_ID').html(html);
            $('#Program_ID').val("<?= $getdata['Program_ID'] ?>").trigger('change');
          }
        });
      } else {
        $('#Program_ID').html('<option value="">Select Department First</option>');
      }
    }

    $('#Department_ID').change(function() {
      var departmentID = $(this).val();
      get_programs(departmentID);
    });

    $('.ckeditor').each(function() {
      CKEDITOR.replace($(this).attr('id'));
    });

    $('#form-add-sub_category').validate({
      rules: {
        name: {
          required: true
        },
        Short_Name: {
          required: true
        },
        content: {
          required: true
        },
        position: {
          required: true,
          number: true,
          min: 0
        }
      },
      highlight: function(element) {
        $(element).addClass('error');
        $(element).closest('.form-control').addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).removeClass('error');
        $(element).closest('.form-control').removeClass('has-error');
      },
      submitHandler: function(form) {
        var formData = new FormData(form);
        
        for (var instance in CKEDITOR.instances) {
          formData.append(instance, CKEDITOR.instances[instance].getData());
        }

        $.ajax({
          url: form.action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(data) {
            if (data.status == 200) {
              $('.modal').modal('hide');
              toastr.success(data.message, 'Success');
              $('#sub_category-table').DataTable().ajax.reload(null, false);
            } else {
              $(':input[type="submit"]').prop('disabled', false);
              toastr.error(data.message, 'Error');
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            toastr.error('Error submitting form: ' + errorThrown, 'Error');
          }
        });
        return false;
      }
    });

    get_programs($('#Department_ID').val());
  });
</script> -->

<script>
  $(document).ready(function() {
    // Initialize CKEditor
    CKEDITOR.replace('editor');
    $('#Menu_ID').change(function() {
      var menuID = $(this).val();
      if (menuID) {
        $.ajax({
          type: 'POST',
          url: '/admin/app/sub_category/get_menu',
          data: 'menu_id=' + menuID,
          success: function(html) {
            $('#Category_ID').html(html);
          }
        });
      } else {
        $('#Category_ID').html('<option value="">Select Menu First</option>');
      }
    });


    $('#form-add-sub_category').validate({
      rules: {
        name: {
          required: true
        },
        Short_Name: {
          required: true
        },
        content: {
          required: true
        },
        position: {
          required: true,
          number: true,
          min: 0
        }
      },

      highlight: function(element) {
        $(element).addClass('error');
        $(element).closest('.form-control').addClass('has-error');
      },
      unhighlight: function(element) {
        $(element).removeClass('error');
        $(element).closest('.form-control').removeClass('has-error');
      },
      submitHandler: function(form) {
        var formData = new FormData(form);
        var content = CKEDITOR.instances['editor'].getData();
        formData.append('content', content); 

        $.ajax({
          url: form.action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(data) {
            if (data.status == 200) {
              $('.modal').modal('hide');
              toastr.success(data.message, 'Success');
              $('#sub_category-table').DataTable().ajax.reload(null, false);
            } else {
              $(':input[type="submit"]').prop('disabled', false);
              toastr.error(data.message, 'Error');
            }
          },
          error: function(xhr, textStatus, errorThrown) {
            toastr.error('Error submitting form: ' + errorThrown, 'Error');
          }
        });
        return false;
      }
    });
  });
</script>