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
<ul class="list-group list-unstyled">
  <?php foreach ($view->result as $i => $v): ?>

    <?php
    $node_title = $v->node_title;
    $nid = $v->nid;
    $taxonomy = $v->field_field_industry_classify[0]['rendered']['#title'];
    $tax_id = $v->field_field_industry_classify[0]['raw']['tid'];
    ?>

    <li class="list-group-item industry-item">
      <a href="<?php print drupal_get_path_alias('industry-news/' . $tax_id) ?>">[<?php print $taxonomy ?>]</a>

      <a href="<?php print drupal_get_path_alias('node/' . $nid) ?>"><?php print $node_title ?></a>
    </li>

  <?php endforeach; ?>

</ul>