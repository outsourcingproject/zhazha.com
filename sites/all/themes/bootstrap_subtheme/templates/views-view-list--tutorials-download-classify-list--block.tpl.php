<?php

/**
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>

<?php //print $wrapper_prefix; ?>
<?php //if (!empty($title)) : ?>
<!--    <h3>--><?php //print $title; ?><!--</h3>-->
<?php //endif; ?>
<?php //print $list_type_prefix; ?>

<ul class="list-group">
<?php foreach ($view->result as $id => $v): ?>
    <li class="list-group-item"><?php print l($v->taxonomy_term_data_name, 'tutorials-download/' . $v->tid) ?></li>
<?php endforeach ?>
</ul>

<?php //print $list_type_suffix; ?>
<?php //print $wrapper_suffix; ?>
