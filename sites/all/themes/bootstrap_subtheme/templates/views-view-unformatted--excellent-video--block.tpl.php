<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<?php foreach ($view->result as $i => $v): ?>

  <?php
  $flagarr = flag_get_counts('node', $v->nid);
  $bookmarksNum = 0;
  $praiseNum = 0;

  if (isset($flagarr['bookmarks'])) {
    $bookmarksNum = $flagarr['bookmarks'];
  }
  if (isset($flagarr['praise'])) {
    $praiseNum = $flagarr['praise'];
  }

  $imagePath = file_create_url($v->field_field_image[0]['raw']['uri']);
  $node_created = $v->node_created;

  $node_title = $v->node_title;
  $nid = $v->nid;
  $node_body = '';
  if (isset($v->field_body[0])) {
    $node_body = $v->field_body[0]['raw']['safe_value'];
  }

  $node_info = '';

  if (isset($v->field_field_info[0])) {
    $node_info = $v->field_field_info[0]['raw']['safe_value'];
  }
  $comment_count = $v->node_comment_statistics_comment_count;
  $see_times=$v->node_counter_totalcount;
  ?>

  <article class="article article-video">
    <div class="row">
      <div class="col-xs-4">
        <a href="<?php print drupal_get_path_alias('node/' . $nid) ?>">
          <img class="thumbnail" src="<?php print $imagePath ?>">
        </a>
      </div>
      <div class="col-xs-8 article-video-right">
        <h3 class="article-video-title">
          <a
            href="<?php print drupal_get_path_alias('node/' . $nid) ?>"><?php print $node_title ?></a>
        </h3>

        <p
          class="article-video-content"><?php print get_summary($node_body . $node_info) ?></p>

        <div class="article-video-data">
          <ul class="list-unstyled list-inline">

            <li
              class="icon-time"><?php print date('Y-m-d', $node_created) ?></li>
            <li class="icon-heart"><?php print $bookmarksNum ?></li>
            <li class="icon-eye-open"><?php print $see_times ?></li>
            <li class="icon-comment"><?php print $comment_count ?></li>
          </ul>
        </div>

      </div>
    </div>

  </article>

<?php endforeach; ?>

