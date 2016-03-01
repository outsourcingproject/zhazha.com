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

<ol class="breadcrumb new" >
  <li class="first"><a href="/">渣渣网</a></li>
  <li class="active last">业界资讯</li>
</ol>
<?php foreach ($view->result as $i => $v): ?>

  <?php
  $flagarr = flag_get_counts('node', $v->nid);
  $bookmarksNum = 0;
  $praiseNum = 0;

  if (isset($flagarr['bookmarks']))
    $bookmarksNum = $flagarr['bookmarks'];
  if (isset($flagarr['praise']))
    $praiseNum = $flagarr['praise'];

  $imagePath = file_create_url($v->field_field_image[0]['raw']['uri']);
  $node_created = $v->node_created;

  $node_title = $v->node_title;
  $nid = $v->nid;
  if (isset($v->field_body[0])) {
    $node_body = $v->field_body[0]['raw']['safe_value'];
  } else {
    $node_body = '';
  }
  $comment_count=$v->node_comment_statistics_comment_count;
  $see_times=$v->node_counter_totalcount;
  ?>

  <article class="article article-industry">
    <div class="row">
      <div class="col-xs-4">
        <a href="<?php print drupal_get_path_alias('node/' . $nid) ?>">
          <img class="thumbnail" src="<?php print $imagePath ?>">
        </a>
      </div>
      <div class="col-xs-8">
        <h3 class="article-industry-title"><a
            href="<?php print drupal_get_path_alias('node/' . $nid) ?>"><?php print $node_title ?></a></h3>

        <p class="article-industry-content"><?php print get_summary($node_body) ?></p>
      </div>
    </div>
    <div class="article-data">
      <ul class="list-unstyled list-inline">
        <li class="sm-logo"></li>
        <li><a href="/">渣渣网</a></li>

        <li class="icon-time"><?php print date('Y-m-d', $node_created) ?></li>
        <li class="icon-heart"><?php print $bookmarksNum ?></li>
        <li class="icon-eye-open"><?php print $see_times?></li>
        <li class="icon-comment"><?php print $comment_count?></li>
      </ul>


    </div>
  </article>
<?php endforeach; ?>

