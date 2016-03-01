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
$nid = $content['body']['#object']->nid;
$flagarr = flag_get_counts('node', $nid);
$bookmarksNum = 0;
$praiseNum = 0;

if (isset($flagarr['bookmarks'])) {
  $bookmarksNum = $flagarr['bookmarks'];
}
if (isset($flagarr['praise'])) {
  $praiseNum = $flagarr['praise'];
}


$imagePath = file_create_url($content['body']['#object']->field_image['und'][0]['uri']);
$encodedImg = urlencode($imagePath);

$node_title = $content['body']['#object']->title;

if (isset($content['body']['#object']->body['und'][0]['safe_value'])) {
  $node_body = $content['body']['#object']->body['und'][0]['safe_value'];
}
else {
  $node_body = '';
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . (drupal_get_path_alias(current_path()));
$encodedURL = urlencode($url);

if (isset($content['body']['#object']->field_attachment['und'])) {
  $files = $content['body']['#object']->field_attachment['und'];
}

if (isset($content['body']['#object']->field_download_link['und'])) {
  $download_link = $content['body']['#object']->field_download_link['und'][0]['value'];
}

$used_software = $content['body']['#object']->field_used_software['und'][0]['value'];
$duration = $content['body']['#object']->field_duration['und'][0]['value'];
$used_language = $content['body']['#object']->field_language['und'][0]['value'];
$used_file_size = $content['body']['#object']->field_file_size['und'][0]['value'];

$see_times = intval($variables['content']['links']['statistics']['#links']['statistics_counter']['title']);


?>

<div id="node-<?php print $node->nid; ?>"
     class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <div class="content"<?php print $content_attributes; ?>>

    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a
          href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <h2 class="node-title">
      <?php print $node_title ?>
    </h2>
    <?php
    $taxonomy_term_id=$field_tutorials_classify[0]['tid'];
    $taxonomy_term_name=$field_tutorials_classify[0]['taxonomy_term']->name;
    ?>

    <ol class="breadcrumb new" >
      <li class="first"><a href="/">渣渣网</a></li>
      <li ><a href="/tutorials-download" >教程下载</a></li>
      <li ><a href="/tutorials-download/<?php print $taxonomy_term_id?>" ><?php print $taxonomy_term_name?></a></li>
      <li class="active last"><?php print $node_title?></li>
    </ol>


    <img src="<?php print $imagePath ?>" alt=""
         class="tutorials-download-content-img">
    <ul class="tutorials-download-metadata list-inline">
      <li>时长 : <?php print $duration?></li>
      <li>使用软件 : <?php print $used_software?></li>
      <li>语言 : <?php print $used_language?></li>
      <li>文件大小 : <?php print $used_file_size?></li>
      <li>查看次数 : <?php print $see_times?></li>
      <li>下载次数 : <?php print $see_times?></li>
    </ul>
    <div class="tutorials-download-content"><?php print $node_body ?></div>
    <div class="tutorials-download-content-footer">
      <ul id="share-list" class="tutorials-download-share list-inline">
        <li>
          <a
            href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php print $encodedURL ?>&title=<?php print $node_title ?>&pics=<?php print $encodedImg ?>&summary=<?php print get_summary($node_body) ?>"
            class=" icon-qqzero"
            target="_blank"></a>

        </li>
        <li>
          <a
            href="http://service.weibo.com/share/share.php?url=<?php print $encodedURL ?>&title=<?php print $node_title ?>&pic=<?php print $encodedImg ?>?>"
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

      <?php if (isset($download_link) || isset($files)): ?>
        <button id="tutorials-download"
                class="tutorials-download-btn btn btn-success donwload-save">
          Download
        </button>
      <?php endif; ?>

    </div>
    <?php if (isset($download_link) || isset($files)): ?>
      <div id="tutorials-download-link" class="tutorials-download-link">
        <?php if (isset($download_link)): ?>
          <pre><?php print $download_link ?></pre>
        <?php endif ?>
        <?php if (isset($files)): ?>
          <h4>下载链接</h4>
          <ul class="attachment-list">
            <?php foreach ($files as $file): ?>
              <li><a
                  href="<?php print file_create_url($file['uri']) ?>"><?php print $file['filename'] ?></a>
              </li>
            <?php endforeach ?>

          </ul>
        <?php endif ?>
      </div>
    <?php endif; ?>
  </div>

  <?php print render($content['comments']); ?>
</div>
