<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<?php
$nid = $content['field_image']['#object']->nid;
$flagarr = flag_get_counts('node', $nid);
$bookmarksNum = 0;
$praiseNum = 0;

if (isset($flagarr['bookmarks'])) {
  $bookmarksNum = $flagarr['bookmarks'];
}
if (isset($flagarr['praise'])) {
  $praiseNum = $flagarr['praise'];
}
$uid = $content['field_image']['#object']->uid;
$user = user_load($uid);

$images = $content['field_image']['#object']->field_image['und'];

$imagePath = file_create_url($images[0]['uri']);

$encodedImg = urlencode($imagePath);

$node_title = $content['field_image']['#object']->title;

$node_created = $content['field_image']['#object']->created;

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . (drupal_get_path_alias(current_path()));
$encodedURL = urlencode($url);

$comment_count = $content['field_image']['#object']->comment_count;
$see_times = intval($variables['content']['links']['statistics']['#links']['statistics_counter']['title']);

if (isset($content['field_image']['#object']->field_video['und'][0]['uri'])) {
  $videoURL = file_create_url($content['field_image']['#object']->field_video['und'][0]['uri']);
}

if (isset($node->body['und'][0]['value'])) {
  $node_content = $node->body['und'][0]['value'];
}

$source = '';
$info = '';

if (isset($content['field_image']['#object']->field_source['und'][0]['value'])) {
  $source = $content['field_image']['#object']->field_source['und'][0]['value'];
}
if (isset($content['field_image']['#object']->field_info['und'][0]['value'])) {
  $info = $content['field_image']['#object']->field_info['und'][0]['value'];
}

$views = views_get_view('excellent_video');
$views->set_display('excellent_video_carousel');
$views->execute();
$results = $views->result;
$results_size = sizeof($results);

$page_size=5;



?>

<div id="node-<?php print $node->nid; ?>"
     class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <div class="content"<?php print $content_attributes; ?>>

    <?php if (isset($videoURL)) : ?>
      <video id="main-video" class="video-js vjs-default-skin main-video"
             controls
             preload="none" width="640"
             data-setup="{}">
        <source src="<?php print $videoURL ?>" type='video/mp4'/>
      </video>
    <?php elseif (isset($node_content)) : ?>
      <?php print $node_content ?>
    <?php endif; ?>


    <h2 id="excellent-video-title" class="block-title">
      <?php print $node_title ?>
    </h2>

    <?php
    $taxonomy_term_id=$field_video_classify[0]['tid'];
    $taxonomy_term_name=$field_video_classify[0]['taxonomy_term']->name;
    ?>

    <ol class="breadcrumb new" >
      <li class="first"><a href="/">渣渣网</a></li>
      <li ><a href="/excellent-video" >优秀视频</a></li>
      <li ><a href="/excellent-video/<?php print $taxonomy_term_id?>" ><?php print $taxonomy_term_name?></a></li>
      <li class="active last"><?php print $node_title?></li>
    </ol>

    <div class="excellent-video-data item-padding-large">
      <ul class="list-unstyled list-inline">
        <li>播放: <?php print $see_times ?></li>
        <li>赞: <?php print $bookmarksNum ?></li>
      </ul>
    </div>


    <div class="excellent-video-wrap">
      <div id="excellent-video-carousel" class="carousel slide">
        <!-- 轮播（Carousel）指标 -->
        <ol class="carousel-indicators">
          <?php for ($i = 0; $i * $page_size < $results_size; $i++): ?>
            <li data-target="#excellent-video-carousel"
                data-slide-to="<?php print $i ?>"
                <?php if ($i == 0): ?>class="active"<?php endif ?>></li>
          <?php endfor ?>
        </ol>
        <!-- 轮播（Carousel）项目 -->
        <div class="carousel-inner">
          <?php for ($i = 0; $i * $page_size < $results_size; $i++): ?>
            <div class="item <?php if ($i == 0): ?>active<?php endif ?>">
              <ul class="excellent-video-list list-unstyled">
                <?php for ($j = $i * $page_size; $j < $results_size && $j < $i + $page_size; $j++): ?>
                  <li class="excellent-video-item">
                    <?php
                    $v = $results[$j];
                    $nid = $v->nid;

                    $flagarr = flag_get_counts('node', $nid);
                    $praiseNum = 0;

                    if (isset($flagarr['praise'])) {
                      $praiseNum = $flagarr['praise'];
                    }
                    ?>
                    <a
                      href="<?php print '/' . drupal_get_path_alias('node/' . $nid) ?>">
                      <img
                        src="<?php echo file_create_url($v->field_field_image[0]['raw']['uri']); ?>">
                    </a>

                    <div class="curtain"></div>
                    <p>
                    <span><a
                        href="<?php print '/' . drupal_get_path_alias('node/' . $nid) ?>"><?php echo $v->node_title; ?></a></span>
                      <span class="icon-heart"><?php echo $praiseNum; ?></span>
                    </p>
                  </li>
                <?php endfor ?>
              </ul>
            </div>
          <?php endfor ?>
        </div>
        <!-- 轮播（Carousel）导航 -->
        <a class="excellent-video-carousel-control left"
           href="#excellent-video-carousel"
           data-slide="prev">&lsaquo;</a>
        <a class="excellent-video-carousel-control right"
           href="#excellent-video-carousel"
           data-slide="next">&rsaquo;</a>
      </div>

      <div class="excellent-video-metadata">
        <span>作者:<?php print $user->name ?></span>
        <span>上传时间:<?php print date('Y-m-d', $node_created) ?></span>
        <span>视频来源:<?php print $source ?></span>
        <p>相关信息:<br/><?php print $info ?></p>
      </div>
    </div>

    <ul class="industry-news-share list-inline">
      <li>
        <a
          href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php print $encodedURL ?>&title=<?php print $node_title ?>&pics=<?php print $encodedImg ?>&summary= "
          class=" icon-qqzero"
          target="_blank"></a>

      </li>
      <li>
        <a
          href="http://service.weibo.com/share/share.php?url=<?php print $encodedURL ?>&title=<?php print $node_title ?>&pic=<?php print $encodedImg ?>"
          class=" icon-sina"
          target="_blank"
        ></a>
      </li>
      <li>
        <a
          href="http://share.v.t.qq.com/index.php?c=share&a=index&url=<?php print $encodedURL ?>&title=<?php print $node_title ?>&pic=<?php print $encodedImg ?>"
          class=" icon-weibo"
          target="_blank"></a>
      </li>
    </ul>

  </div>

  <?php print render($content['comments']); ?>
</div>
