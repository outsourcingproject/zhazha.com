<?php
/**
 * Created by IntelliJ IDEA.
 * User: zl
 * Date: 15-11-23
 * Time: 下午5:42
 */
$v = $view->result[0];
$nid = $v->nid;
$flagarr = flag_get_counts('node', $v->nid);
$bookmarksNum = 0;
$praiseNum = 0;

if (isset($flagarr['bookmarks']))
    $bookmarksNum = $flagarr['bookmarks'];
if (isset($flagarr['praise']))
    $praiseNum = $flagarr['praise'];
?>

<div class="excellent-video-front-item">
    <?php foreach ($view->result as $i => $v): ?>
    <div class="excellent-video-front-item">
        <a href="<?php print '/' . drupal_get_path_alias('node/' . $nid) ?>">
            <img src="<?php echo file_create_url($v->field_field_image[0]['raw']['uri']); ?>">
        </a>

        <div class="curtain"></div>
        <p>
            <span><a href="<?php print '/' . drupal_get_path_alias('node/' . $nid) ?>"><?php echo $v->node_title; ?></a></span>
            <span class="icon-heart"><?php echo $bookmarksNum; ?></span>
        </p>
    </div>
    <?php endforeach; ?>
</div>


