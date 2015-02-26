<?php echo head(array('title' => metadata('exhibit', 'title'),
		      'bodyclass'=>'exhibits summary')); 
?>

<?php 
      $collection = get_theme_option('Associated Collection Id');
?>

<?php
  // Following piece of code creates exhibition title block, black background, lhs color rectangle
  // This code can also be moved to common/header.php to display the title block on
  // all three pages (summary.php, show.php, and item.php)
?>

<h1 class="head">
  <span class="keycolor" style="height:30px;min-width:30px;display:inline">
    &nbsp;
  </span>
  &nbsp;
  <?php
    $title = exhibit_builder_link_to_exhibit();
    echo $title;
  ?>
</h1>

<?
  $color_scheme = get_theme_option('Color Scheme');
?>
<table>
  <tr>
    <td class="cul-general-content-td">

      <div id="primary">

        <div class="cul-show-collection-banner">
           <?php
             echo cul_theme_logo(metadata('exhibit','title'));
           ?>
        </div><!--end id="cul-show-collection-banner"-->

        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                <div class="exhibit-description">
                  <?php echo $exhibitDescription; ?>
                </div> <!--end class="exhibit-description"-->
        <?php endif; ?>
 
        <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
                <div class="exhibit-credits">
                  <h3><?php echo 'Exhibit Curator' ?></h3>
                  <p><?php echo $exhibitCredits; ?></p>
                </div> <!--end class="exhibit-credits"-->
        <?php endif; ?>


      <div id="collection-items">
        <?php
          //  $items = get_items(array('collection'=>$collection), 5);
          $items = get_records('Item', array('collection'=>$collection), 0);
          set_loop_records('items',$items);
        ?>

        <?php foreach (loop('items') as $item): ?>
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>

          <div class="item hentry">

            <div class="item-files">

	      <?php cul_files_for_item(); ?>

            </div> <!--end class="item-files"-->

            <h3><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h3>

            <?php if ($text = metadata('item', array('Item Type Metadata', 'Text'), array('snippet'=>250))): ?>

              <div class="item-description">
                <p><?php echo $text; ?></p>
              </div>

	       <?php elseif ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
            <div class="item-description">
  <?php echo $description; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

</div><!-- end collection-items -->






            </div> <!--end id="primary"-->
          </td>
        </tr>
      </table>
      <?php echo foot(); ?>
