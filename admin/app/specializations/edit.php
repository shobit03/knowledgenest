<?php
if (isset($_GET['id'])) {
  require '../../includes/db-config.php';
  require '../../includes/helper.php';
  $id = intval($_GET['id']);
  $getdataQuery = $conn->query("SELECT * FROM specializations WHERE ID = $id");
  $getdata = $getdataQuery->fetch_assoc();

  $categoryArr = [];
  if (!empty($getdata['Category_ID'])) {
    $categoryQuery = $conn->query("SELECT * FROM category WHERE Menu_ID = " . intval($getdata['Menu_ID']));
    while ($category = $categoryQuery->fetch_assoc()) {
      $categoryArr[] = $category;
    }
  }
}
?>

<div class="modal-header">
  <h5 class="modal-title">Edit Specializations</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form id="form-add-specializations" action="/admin/app/specializations/update" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $getdata['ID'] ?>">

      <div class="row">
        <!-- Menu -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Menu<span class="text-danger">*</span></label>
          <?php $menuArr = getMenuFunc($conn); ?>
          <select name="Menu_ID" id="Menu_ID" class="form-control sumoselect" required>
            <option value="">Select Menu</option>
            <?php foreach ($menuArr as $menu) { ?>
              <option value="<?= $menu['ID'] ?>" <?= $getdata['Menu_ID'] == $menu['ID'] ? 'selected' : '' ?>><?= $menu['Name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <!-- Category -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Category<span class="text-danger">*</span></label>
          <select name="Category_ID" id="Category_ID" class="form-control sumoselect" required>
            <option value="">Select Menu First</option>
            <?php foreach ($categoryArr as $category) { ?>
              <option value="<?= $category['ID'] ?>" <?= $getdata['Category_ID'] == $category['ID'] ? 'selected' : '' ?>><?= $category['Name'] ?></option>
            <?php } ?>
          </select>
        </div>

        <!-- Sub-Category -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Sub Category<span class="text-danger">*</span></label>
          <select name="Sub_Category_ID" id="Sub_Category_ID" class="form-control sumoselect" required>
            <option value="">Select Category First</option>
          </select>
        </div>

        <!-- Name -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Name<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" value="<?= $getdata['Name'] ?>" placeholder="Enter Specialization Name.." required>
        </div>

        <!-- Short Name -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Short Name<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Short_Name" value="<?= $getdata['Short_Name'] ?>" placeholder="Enter Short Name.." required>
        </div>

        <!-- Photo -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Photo<span class="text-danger">*</span></label>
          <input type="hidden" name="updated_file" value="<?= $getdata['Photo'] ?>">
          <input type="file" name="photo" id="photo" class="form-control" accept="image/*" onchange="fileValidation('photo')" />
          <?php if (!empty($getdata['Photo'])) { ?>
            <img src="/admin<?= $getdata['Photo'] ?>" height="50" alt="Specialization Photo" />
          <?php } ?>
        </div>

        <!-- Eligibility -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Eligibility<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="eligibility" value="<?= $getdata['Eligibility'] ?>" placeholder="Enter Eligibility.." required>
        </div>

        <!-- Duration -->
        <div class="mb-3 col-md-6">
          <label class="form-label">Duration<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="duration" value="<?= $getdata['Durations'] ?>" placeholder="Enter Duration.." required>
        </div>

        <!-- Short Description -->
        <div class="mb-3 col-md-12">
          <label class="form-label">Short Description<span class="text-danger">*</span></label>
          <textarea class="form-control" name="description" rows="5" placeholder="Enter a short description.."><?= $getdata['Description'] ?></textarea>
        </div>

        <!-- Content -->
        <div class="mb-3 col-md-12">
          <label class="form-label">Content<span class="text-danger">*</span></label>
          <textarea id="editor" name="content" class="ckeditor" rows="10"><?= $getdata['Content'] ?></textarea>
        </div>

        <!-- Position -->
        <div class="mb-3 col-md-12">
          <label class="form-label">Order By<span class="text-danger">*</span></label>
          <input type="number" class="form-control" name="position" value="<?= $getdata['Position'] ?>" min="0" placeholder="Enter Position.." required>
        </div>
      </div>

      <div class="modal-footer text-end">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Handle Menu change event
    $('#Menu_ID').change(function() {
      const menuID = $(this).val();
      if (menuID) {
        $.ajax({
          type: 'POST',
          url: '/admin/app/sub_category/get_menu',
          data: {
            menu_id: menuID
          },
          success: function(response) {
            $('#Category_ID').html(response);
            $('#Category_ID').val("<?= $getdata['Category_ID'] ?>").trigger('change');
          },
          error: function() {
            toastr.error('Failed to fetch categories', 'Error');
          },
        });
      } else {
        $('#Category_ID').html('<option value="">Select Menu First</option>');
        $('#Sub_Category_ID').html('<option value="">Select Category First</option>');
      }
    });

    // Handle Category change event
    $('#Category_ID').change(function() {
      const categoryID = $(this).val();
      if (categoryID) {
        $.ajax({
          type: 'POST',
          url: '/admin/app/specializations/get_course',
          data: {
            category_id: categoryID
          },
          success: function(response) {
            $('#Sub_Category_ID').html(response);
            $('#Sub_Category_ID').val("<?= $getdata['Sub_Category_ID'] ?>").trigger('change');
          },
          error: function() {
            toastr.error('Failed to fetch subcategories', 'Error');
          },
        });
      } else {
        $('#Sub_Category_ID').html('<option value="">Select Category First</option>');
      }
    });

    // Initialize CKEditor for the content field
    $('.ckeditor').each(function() {
      CKEDITOR.replace($(this).attr('id'));
    });

    // Initialize form validation
    $('#form-add-specializations').validate({
      rules: {
        name: {
          required: true
        },
        Short_Name: {
          required: true
        },
        eligibility: {
          required: true
        },
        duration: {
          required: true
        },
        position: {
          required: true,
          number: true
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
        const formData = new FormData(form);
        formData.append('content', CKEDITOR.instances['editor'].getData());

        $.ajax({
          url: form.action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status === 200) {
              $('.modal').modal('hide');
              toastr.success(response.message, 'Success');
              $('#specializations-table').DataTable().ajax.reload(null, false);
            } else {
              toastr.error(response.message, 'Error');
            }
          },
          error: function(xhr, status, error) {
            toastr.error('Error submitting form: ' + error, 'Error');
          }
        });

        return false;
      }
    });
  });
</script>