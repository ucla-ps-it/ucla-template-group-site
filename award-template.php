<?php

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );

?>

<?php get_header(); ?>

<main id="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <header class="header" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url(<?php echo $thumbnail[0]; ?>);" <?php } ?>>
      <div class="ucla campus">
        <div class="col span_12_of_12">
	  <div class="breadcrumb"><?php get_breadcrumb(); ?></div>

<p>
<?php
//name
if(get_post_meta($post->ID,'name',true)):
	echo get_post_meta($post->ID,'name',true);?>, 
<?php endif;?>
<?php
//date
if(get_post_meta($post->ID,'date',true)):
        echo get_post_meta($post->ID,'date',true); 
endif;?>
<?php
//location
if(get_post_meta($post->ID,'location',true)):?> (<?php
	echo get_post_meta($post->ID,'location',true);?>   )  
<?php endif;?></p></div></div>
</header>
    <div class="ucla campus">

      <div class="col span_9_of_12">
        <?php the_content(); ?>

        <?php
            /** @var string|false|WP_Error $tag_list */
            $tag_list = get_the_tag_list( ' ', ' ' );

            if ( $tag_list && ! is_wp_error( $tag_list ) ) {
                echo $tag_list;
            }
        ?>
      </div>

    <?php endwhile; endif; ?>


  </div>

</main>

<?php get_footer(); ?>
