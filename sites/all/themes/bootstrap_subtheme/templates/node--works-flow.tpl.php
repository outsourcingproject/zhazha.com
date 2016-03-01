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

$images=$content['field_image']['#object']->field_image['und'];

$imagePath = file_create_url($images[0]['uri']);

$encodedImg = urlencode($imagePath);

$node_title = $content['field_image']['#object']->title;

$node_created = $content['field_image']['#object']->created;

$url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . (drupal_get_path_alias(current_path()));
$encodedURL = urlencode($url);

$comment_count=$content['field_image']['#object']->comment_count;
$see_times=intval($variables['content']['links']['statistics']['#links']['statistics_counter']['title']);
?>

<div class="work-detail j-viewer-container" >
  <div class="work-detail-mask j-viewer-layer"></div>
  <div class="work-detail-main j-viewer-main" >
    <div class="work-show j-viewer-img" >
      <div class="work-show-hd">
        <div class="work-show-wrap">
          <div class="work-show-inner">
            <div class="work-show-top"><h3>脸谱</h3>
              <div class="mod-operate mod-operate-padding">
                <ul class="operate-list clearfix j-operate-59796">
                  <li class="operate-list-item operate-list-item-view">
			<span class="operate-con" title="查看">
				<i class="icon-eye-open"></i>
				<span>93</span>
			</span>
                  </li>
                  <li class="operate-list-item">
			<span class="operate-con" title="赞">
				<i class="icon-heart"></i>
				<span class="j-favor-nums">24</span>
			</span>
                  </li>
                  <li class="operate-list-item">
			<span class="operate-con" title="评论">
				<i class="icon-comment"></i>
				<span class="j-comment-nums">0</span>
			</span>
                  </li>
                  <li class="operate-list-item">
			<span class="operate-con" title="分享">
				<i class="icon-share"></i>
				<span>6</span>
			</span>
                  </li>
                </ul>
              </div></div>
            <a href="#" class="btn-back">
              <i class="mod-icon mod-icon-trig-l"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="work-show-bd j-scroll j-layer-img">

        <div class="work-show-wrap j-scroll-viewport" >
          <div class="work-show-inner j-scroll-overview" style="top: -106px;">
            <div class="work-list j-layer-img-list ">	<ul>		<li style="width:646px;height:941.14125px">
                  <img src="http://img.ycg.qq.com/201832/0/d8adbac3-cea8-43b4-8f7c-d486cb887f9d/preview" style="" data-img="http://img.ycg.qq.com/201832/0/d8adbac3-cea8-43b4-8f7c-d486cb887f9d/preview" alt="">

                </li>		<li style="width:646px;height:941.14125px">
                  <img src="http://img.ycg.qq.com/201832/0/a826f10c-520b-4b55-bfd7-85abeafd08c7/preview" style="" data-img="http://img.ycg.qq.com/201832/0/a826f10c-520b-4b55-bfd7-85abeafd08c7/preview" alt="">

                </li>		<li style="width:646px;height:430.6666666666667px">
                  <img src="http://img.ycg.qq.com/201832/0/4b5d3107-1e98-4841-bc60-127e142df6ec/preview" style="" data-img="http://img.ycg.qq.com/201832/0/4b5d3107-1e98-4841-bc60-127e142df6ec/preview" alt="">

                </li>		<li style="width:646px;height:430.6666666666667px">
                  <img src="http://img.ycg.qq.com/201832/0/577fcda1-fc1c-4377-a604-b2e85b388ca7/preview" style="" data-img="http://img.ycg.qq.com/201832/0/577fcda1-fc1c-4377-a604-b2e85b388ca7/preview" alt="">

                </li>		<li style="width:646px;height:430.6666666666667px">
                  <img src="http://img.ycg.qq.com/201832/0/55f16c5e-0dd5-42d5-8a5e-855a98d47b58/preview" style="" data-img="http://img.ycg.qq.com/201832/0/55f16c5e-0dd5-42d5-8a5e-855a98d47b58/preview" alt="">

                </li>	</ul></div>
          </div>
        </div>
      </div>
    </div>
    <div class="work-author-info j-viewer-side" >
      <div class="work-author j-work-author">
        <div class="author-main"><div class="author-avatar">
            <a class="avatar" target="_blank" href="/homepage/575089">
              <img class="avatar-img" src="http://qlogo4.store.qq.com/qzone/542615761/542615761/100" alt="">
            </a>
          </div>
          <div class="author-info">
            <a target="_blank" href="/homepage/575089" class="author-name">大猫</a>
            <p class="time">2016-2-27 11:13:36</p>
          </div></div>
        <div class="mod-actions author-actions clearfix j-info-area">	<a href="javascript:void(0);" class="action-item j-focus">
            <i class="icon-plus-sign"></i> 加关注
          </a>	<a href="javascript:void(0);" class="action-item action-message j-message func-disable">
            <i class="icon-envelope"></i> 发私信
          </a>                    </div></div>
      <div class="work-intro j-work-intro">
        <div class="work-intro-detail">
          <div class="intro-detail-main"><h4>作品详情</h4>
            <div class="detail-txt">
              <p>呃····如你所见····就是个脸谱····</p>
            </div>
          </div>
          <div class="mod-actions work-actions clearfix">
            <a href="javascript:void(0);" class="action-item action-praise j-praise">		<i class="icon-heart"></i><span> 赞</span>	</a>
            <a href="javascript:void(0);" class="action-item j-comment-op"><i class="icon-comment"></i> 评论</a>
            <a href="javascript:void(0);" class="action-item j-share"><i class="icon-share"></i> 分享</a>
          </div>
        </div>
        <div class="j-scroll j-comment-scroll">
          <div class="j-scroll-scrollbar disable" style="height: 397px;">
            <div class="j-scroll-track" style="height: 397px;">
              <div class="j-scroll-thumb" style="height: 397px;"></div>
            </div>
          </div>
          <div class="work-intro-inner j-scroll-viewport" style="height: 397px;">
            <div class="j-scroll-overview" style="top: 0px;">
              <div class="work-comment j-comment-list"><div class="comment-box"></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

