<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<?php if ($rows): ?>
  <div class="view-content wrapper">
    <div class="photo_carousel">
	  <?php foreach($view->result as $id => $v){ ?>
		<div>
		  <a href="<?php if($v->field_field_link) echo file_create_url($v->field_field_link['0']['raw']['value']); else echo '#';?>" >
			<img src="<?php echo file_create_url($v->field_field_image['0']['raw']['uri'])?>">
		  </a>
		</div>
	  <?php }?>
	</div>
  </div>
<?php endif; ?>
