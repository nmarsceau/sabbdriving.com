<?php

require_once 'common.php';
$media_files = json_decode(file_get_contents('media.json'), true);

$title = 'Media';
require 'head.php';

?>

<body>
  <?php require 'nav.php'; ?>
  <?php require 'header.php'; ?>

  <section class="container">
    <div class="row">
      <h1 class="col-12 mb-4">Media</h1>
    </div>
    <div class="row no-gutters">
      <?php foreach($media_files as $file) { ?>
        <div class="col-6 col-md-4 col-lg-3 p-2">
          <a class="image-link" href="images/gallery/<?php echo $file['name']; ?>">
            <img class="img-fluid" loading="lazy"
                 src="images/gallery/<?php echo $file['thumbName']; ?>"
                 alt="<?php echo $file['alt']; ?>" />
          </a>
        </div>
      <?php } ?>
    </div>
  </section>

  <?php require 'footer.php'; ?>

  <div id="image-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content image-modal-content">
        <div class="modal-body p-0">
          <button type="button" class="image-modal-close position-absolute" data-dismiss="modal" aria-label="Close">
            <img src="images/close_icon.png" alt="" aria-hidden="true" />
          </button>
          <img id="large-image-tag" class="img-fluid" src="" alt="" />
        </div>
      </div>
    </div>
  </div>

  <?php require 'scripts.php'; ?>

  <script>
    function open_image_modal(filename, alt) {
      $("#large-image-tag").attr("src", filename).attr("alt", alt);
      $("#image-modal").modal('show');
    }

    $(function() {
      $(".image-link").each(function(i, link) {
        var filename = $(link).attr("href");
        var alt = $("img", $(link)).attr("alt");
        
        $(link).attr("href", "javascript:void(0);");
        $(link).click(function() {
          open_image_modal(filename, alt);
        });
      });

      $('#image-modal').on('hidden.bs.modal', function () {
        $("#large-image-tag").attr("src", "").attr("alt", "");
      });
    });
  </script>
  
</body>
</html>