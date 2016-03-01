<?php

/**
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>

<ul class="list-group">
  <?php foreach ($view->result as $id => $v): ?>
    <li class="list-group-item"><?php print l($v->taxonomy_term_data_name, 'industry-news/' . $v->tid) ?></li>
  <?php endforeach ?>
</ul>

