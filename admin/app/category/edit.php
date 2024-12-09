<?php
if (isset($_GET['id'])) {
  require '../../includes/db-config.php';
  require '../../includes/helper.php';
  $id = intval($_GET['id']);
  $getdataQuery = $conn->query("SELECT * FROM category WHERE ID = $id");
  $getdata = $getdataQuery->fetch_assoc();
}
?>

<div class="modal-header">
  <h5 class="modal-title">Edit Program</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal">
  </button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-stream" action="/admin/app/category/update" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $getdata['ID'] ?>">

      <div class="row">

        <div class="mb-3 col-md-12">
          <label class="form-label">Menu<span class="text-danger">*</span></label>
          <?php $menuArr = getMenuFunc($conn); ?>
          <select name="Menu_ID" id="Menu_ID" class="form-control sumoselect" required>
            <option value="">Select Department</option>
            <?php foreach ($menuArr as $menu) { ?>
              <option value="<?= $menu['ID'] ?>" <?php if ($getdata['Menu_ID'] == $menu['ID']) {
                                                          echo "selected";
                                                        } else {
                                                        } ?>><?= $menu['Name'] ?></option>
            <?php } ?>
          </select>
        </div>



        <div class="mb-3 col-md-12">
          <label class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" value="<?= $getdata['Name'] ?>" placeholder="Enter a Program Name.." required>
        </div>

        <div class="mb-3 col-md-12">
          <label class="form-label">Short Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Short_Name" value="<?= $getdata['Short_Name'] ?>" placeholder="Enter a Short Name.." required>
        </div>

        <!-- <div class="mb-3 col-md-12">
          <label class="form-label">Eligibility Criteria <span class="text-danger">*</span></label>
          <textarea class="ckeditor" id="editor_eligibility" name="eligibility" rows="10"><?= $getdata['Eligibility'] ?></textarea>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label"> Duration Year <span class="text-danger">*</span></label>
          <input type="number" min="0" class="form-control" name="year" value="<?= $getdata['Year'] ?>" placeholder="Enter Year.." required>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label">Duration Semester <span class="text-danger">*</span></label>
          <input type="number" min="0" class="form-control" name="semester" value="<?= $getdata['Semester'] ?>" placeholder="Enter Semester.." required>
        </div> -->

        <div class="mb-3 col-md-12">
          <label class="form-label">Order By <span class="text-danger">*</span></label>
          <input type="number" min="0" class="form-control" name="position" value="<?= $getdata['Position'] ?>" placeholder="Enter a Position.." required>
        </div>
      </div>
      <div class=" modal-footer clearfix text-end">
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
  $(function() {

    $('#form-add-stream').validate({
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
      }
    });
  });

  $(document).ready(function() {
    $('.ckeditor').each(function() {
      CKEDITOR.replace($(this).attr('id'));
    });


    $("#form-add-stream").on("submit", function(e) {
      if ($('#form-add-stream').valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);


        var ckeditorFields = ['editor_eligibility'];
        ckeditorFields.forEach(function(field) {
          var data = CKEDITOR.instances[field].getData();
          formData.append(field.replace('editor_', ''), data);
        });

        $.ajax({
          url: this.action,
          type: 'post',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(data) {
            if (data.status == 200) {
              $('.modal').modal('hide');
              toastr.success(data.message, 'Success');
              $('#category-table').DataTable().ajax.reload(null, false);
            } else {
              $(':input[type="submit"]').prop('disabled', false);
              toastr.error(data.message, 'Error');
            }
          }
        });
        e.preventDefault();
      }
    });
  });
</script> -->

<script>
$(document).ready(function() {
    $('#form-add-stream').validate({
        rules: {
            name: {
                required: true
            },
            Short_Name: {
                required: true
            },
            position: {
                required: true,
                number: true,
                min: 0
            }
        },
        messages: {
            position: {
                required: "Please enter the position.",
                number: "Please enter a valid number for the position.",
                min: "Position must be at least 0."
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
                        $('#category-table').DataTable().ajax.reload(null, false);
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