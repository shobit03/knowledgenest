<?php 
require '../../includes/db-config.php';
require '../../includes/helper.php'; 
?>

<div class="modal-header">
  <h3 class="modal-title">Add Video</h3>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="card-body">
  <div class="form-validation">
    <form class="needs-validation" role="form" id="form-add-gallery" action="/admin/app/gallery_video/store" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
          <!-- Note -->
          <div class="alert alert-info mb-3">
            <strong>Note:</strong> You can either provide a video link or upload a video file. Please do not provide both.
          </div>

          <!-- Video Link Field -->
          <div class="form-group mb-3">
            <label class="form-label">Video Link (Optional)</label>
            <div id="add_new_video_link">
              <div class="input-group mb-3">
                <input 
                  type="url" 
                  class="form-control video-link" 
                  placeholder="Video Link" 
                  name="video_links" 
                  id="video_link">
              </div>
            </div>
          </div>

          <!-- Video Upload Field -->
          <div class="form-group mb-3">
            <label class="form-label">Upload Video (Optional)</label>
            <input 
              type="file" 
              class="form-control" 
              name="video_file" 
              id="video_file" 
              accept="video/*">
          </div>

          <!-- Position Field -->
          <div class="form-group mb-3">
            <label class="form-label">Position</label>
            <select class="form-control" name="position" required>
              <option value="">Select Position</option>
              <option value="left">Left</option>
              <option value="right">Right</option>
            </select>
          </div>
        </div>
        <div class="modal-footer clearfix text-end">
          <div class="col-md-4 m-t-10 sm-m-t-10">
            <button aria-label="" type="submit" class="btn btn-primary btn-cons btn-animated from-left">
              <span>Save</span>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Custom validation for ensuring only one input is provided
    function validateVideoInputs() {
      const videoLink = $('#video_link').val().trim();
      const videoFile = $('#video_file').val().trim();
      
      if (!videoLink && !videoFile) {
        toastr.error('Please provide either a video link or upload a video.');
        return false;
      }
      if (videoLink && videoFile) {
        toastr.error('Please provide only one input: a video link or an uploaded video.');
        return false;
      }
      return true;
    }

    $('#form-add-gallery').on('submit', function(e) {
      if ($('#form-add-gallery').valid() && validateVideoInputs()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        $.ajax({
          url: this.action,
          type: 'POST',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(data) {
            if (data.status == 200) {
              $('.modal').modal('hide');
              toastr.success(data.message, 'Success');
              $('#gallery_video-table').DataTable().ajax.reload(null, false);
            } else {
              $(':input[type="submit"]').prop('disabled', false);
              toastr.error(data.message, 'Error');
            }
          },
          error: function(xhr, status, error) {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error("An error occurred: " + error, 'Error');
          }
        });
        e.preventDefault();
      } else {
        e.preventDefault();
      }
    });
  });
</script>