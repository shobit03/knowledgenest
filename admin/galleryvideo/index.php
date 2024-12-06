<?php include('../includes/header-top.php');
include($_SERVER['DOCUMENT_ROOT'] . '/admin/includes/header-bottom.php');
include($_SERVER['DOCUMENT_ROOT'] . '/admin/includes/top-menu.php');
include($_SERVER['DOCUMENT_ROOT'] . '/admin/includes/menu.php');
?>
<!-- row -->

<div class="element-areaa">
    <div class="demo-view">
        <div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">

            <!-- Column starts -->
            <div class="col-xl-12">
                <div class="card dz-card" id="accordion-four">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Gallery Video</h4>
                        </div>
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" onclick="add('gallery_video','md')" data-bs-target="#modalGrid">Add Videos</button>
                    </div>
                    <!-- /tab-content -->
                    <div class="tab-content" id="myTabContent-3">
                        <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table id="gallery_video-table" class="display table" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Videos</th>
                                                <!-- <th>Upload Video</th> -->
                                                <th>Position</th>
                                                <th>Status </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="withoutBorder-html" role="tabpanel" aria-labelledby="home-tab-3">
                            <div class="card-body pt-0 p-0 code-area">

                            </div>
                        </div>
                    </div>
                    <!-- /tab-content -->
                </div>
            </div>
            <!-- Column ends -->
        </div>
    </div>

</div>
</div>
</div>
<?php include('../includes/footer-top.php'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#gallery_video-table').DataTable({
            'processing': true,
            'ajax': {
                'url': '/admin/app/gallery_video/server',
                'type': 'POST'
            },
            'columns': [{
                    data: 'No'
                },

                // {
                //     data: 'Video',
                //     render: function(data, type, row) {
                //         if (type === 'display') {
                //             return `<iframe src="${data}" frameborder="0" allowfullscreen style="width: 200px; height: 150px;"></iframe>`;
                //         }
                //         return data;
                //     }
                // },


                // {
                //     data: 'Upload_Video',
                //     render: function(data, type, row) {
                //         if (data) {
                //             // Check if the file is a video URL
                //             if (data.endsWith('.mp4') || data.endsWith('.avi') || data.endsWith('.mov')) {
                //                 // Render video element if it's a video file
                //                 return `<video width="70" controls>
                //                         <source src="/admin/${data}" type="video/mp4">
                //                         Your browser does not support the video tag.
                //                     </video>`;
                //             } else {
                //                 // Render as an image if it's not a video
                //                 return `<img src="/admin/${data}" width="70" alt="Gallery Video Thumbnail">`;
                //             }
                //         }
                //         return `<img src="/admin-assets/img/default-program.jpg" width="70" alt="No Video/Image Available">`; // Fallback for no video/image
                //     },
                //     visible: true
                // },

                // {
                //     data: 'Video',
                //     render: function(data, type, row) {
                //         var videoContent = '';

                //         if (data) {
                //             videoContent = `<iframe src="${data}" frameborder="0" allowfullscreen style="width: 200px; height: 150px;"></iframe>`;
                //         } else if (row.Upload_Video) {
                //             var uploadVideo = row.Upload_Video;
                //             if (uploadVideo.endsWith('.mp4') || uploadVideo.endsWith('.avi') || uploadVideo.endsWith('.mov')) {
                //                 videoContent = `<video width="200" controls>
                //                                     <source src="/admin/${uploadVideo}" type="video/mp4">
                //                                     Your browser does not support the video tag.
                //                                 </video>`;
                //             } else {
                //                 videoContent = `<img src="/admin/${uploadVideo}" width="200" alt="Gallery Video Thumbnail">`;
                //             }
                //         } else {
                //             // Fallback if no video or upload video is available
                //             videoContent = `<img src="/admin-assets/img/default-program.jpg" width="200" alt="No Video/Image Available">`;
                //         }

                //         return videoContent;
                //     }
                // },
                {
                    data: 'Video',
                    render: function(data, type, row) {
                        var videoContent = '';

                        if (data) {
                            // Assuming data is a YouTube or Vimeo link
                            videoContent = `<iframe src="${data}?autoplay=1" frameborder="0" allow="autoplay; fullscreen" allowfullscreen style="width: 200px; height: 150px;"></iframe>`;
                        } else if (row.Upload_Video) {
                            var uploadVideo = row.Upload_Video;
                            if (uploadVideo.endsWith('.mp4') || uploadVideo.endsWith('.avi') || uploadVideo.endsWith('.mov')) {
                                videoContent = `<video width="200" autoplay muted controls>
                                    <source src="/admin/${uploadVideo}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>`;
                            } else {
                                videoContent = `<img src="/admin/${uploadVideo}" width="200" alt="Gallery Video Thumbnail">`;
                            }
                        } else {
                            // Fallback if no video or upload video is available
                            videoContent = `<img src="/admin-assets/img/default-program.jpg" width="200" alt="No Video/Image Available">`;
                        }

                        return videoContent;
                    }
                },

                {
                    data: 'Position'
                },

                {
                    data: 'Status',
                    render: function(data, type, row) {
                        var active = data == 1 ? 'Active' : 'Inactive';
                        var checked = row.Status == 1 ? 'checked' : '';
                        return '<label class="switch" for="status-switch-' + row.ID + '"> <input onclick="changeStatus(&#39;gallery_video&#39;, &#39;' + row.ID + '&#39;)" type="checkbox" ' + checked + ' id="status-switch-' + row.ID + '"><span class="slider round"></span></label>';
                    },
                    visible: true
                },

                {
                    data: 'ID',
                    render: function(data, type, row) {
                        //    console.log(data);
                        return '<div class="ms-auto"><a href="javascript:void(0);" onclick="edit(&#39;gallery_video&#39;, &#39;' + row.ID + '&#39, &#39;md&#39;)" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0);" onclick="destroy(&#39;gallery_video&#39;, &#39;' + data + '&#39)" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a></div>';
                    },
                    visible: true
                },
            ],
            'searching': true,
            'paging': true,
            'lengthChange': true,
        });

        $('input[aria-controls="gallery_video-table"]').keyup(function() {
            var searchValue = $(this).val();
            table.search(searchValue).draw();
        });
    });
</script>
<?php include('../includes/footer-bottom.php'); ?>