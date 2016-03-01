<?php
/**
 * Created by IntelliJ IDEA.
 * User: zl
 * Date: 15-11-27
 * Time: 下午2:07*/
?>
<div class="tutorials-download-front-container">
  <?php foreach ($view->result as $i => $v): ?>
    <?php
    $imagePath = file_create_url($v->field_field_image[0]['raw']['uri']);
    $node_created = $v->node_created;

    $node_title = $v->node_title;
    $nid = $v->nid;

    if (isset($v->field_body[0])) {
      $node_body = $v->field_body[0]['raw']['safe_value'];
    } else {
      $node_body = '';
    }

    ?>

    <div class="tutorials-download-front-item">
      <a href="<?php echo drupal_get_path_alias('node/' . $nid) ?>"><img
          src="<?php echo file_create_url($imagePath) ?>"></a>

      <div class="tutorials-download-front-content">
        <h3 class="tutorials-download-front-title"><a
            href="<?php echo drupal_get_path_alias('node/' . $nid) ?>"><?php echo $node_title ?></a></h3>

        <div class="tutorials-download-front-body"><?php echo get_summary($node_body)?></div>
      </div>
    </div>

  <?php endforeach ?>
</div>