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

<ul class="work-list list-unstyled">
  <?php foreach ($view->result as $i => $v): ?>

    <?php
    $flagarr = flag_get_counts('node', $v->nid);
    $praiseNum = 0;

    if (isset($flagarr['praise']))
      $praiseNum = $flagarr['praise'];

    $imagePath = file_create_url($v->field_field_image[0]['raw']['uri']);

    $node_title = $v->node_title;
    $nid = $v->nid;
    if (isset($v->field_body[0])) {
      $node_body = $v->field_body[0]['raw']['safe_value'];
    } else {
      $node_body = '';
    }
    $content_url = '/'.drupal_get_path_alias('node/' . $nid);
    $node_author = user_load($v->_field_data['nid']['entity']->uid);


    if (isset($node_author->picture->uri)) {
      $node_author_picture_uri = $node_author->picture->uri;
    } else {
      $node_author_picture_uri = 'public://default_images/user_avatar.jpg';
    }
    $node_author_picture = file_create_url($node_author_picture_uri);
    $see_times=$v->node_counter_totalcount;
    $comment_count=$v->node_comment_statistics_comment_count;
    ?>

    <li class="work-list-item ">
      <!-- 作品封面 S-->
      <div class="work-list-item-img">
        <a class="work-img-wrap" href="<?php print $content_url ?>">
          <img class="work-img" src="<?php print $imagePath ?>" alt="">
        </a>

      </div>
      <!-- 作品封面 E-->
      <!-- 作品信息 S-->
      <div class="work-list-item-info">
        <div class="work-author">
          <a class="avatar" href="/user/<?php print $node_author->uid?>">
            <img class="avatar-img j-go-homepage" src="<?php print $node_author_picture ?>" alt=""></a>
        </div>

        <div class="work-info">
          <div class="author-info">
            <a class="author-name textoverflow j-go-homepage" href="<?php print $content_url ?>"
               title="<?php print $node_title ?>"><?php print $node_title ?></a>
          </div>
          <div class="mod-operate">
            <ul class="operate-list list-unstyled">
              <li class="operate-list-item icon-heart"><?php print $praiseNum ?></li>
              <li class="operate-list-item icon-eye-open"><?php print $see_times ?></li>
              <li class="operate-list-item icon-comment"><?php print $comment_count ?></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- 作品信息 E-->
    </li>

  <?php endforeach; ?>
</ul>