<?php get_header(); ?>

<main id="main">
 <header class="header">
      <div class="ucla campus">
        <div class="col span_12_of_12">
  <div class= "author-bio">
<br>
  <h2><?php if(get_post_meta($post->ID, 'first_name',true)):?> <?php echo get_post_meta($post->ID, 'first_name', true);?> <?php endif;?><?php if(get_post_meta($post->ID, 'middle_name',true)):?> <?php echo get_post_meta($post->ID, 'middle_name', true);?> <?php endif;?><?php if(get_post_meta($post->ID, 'last_name',true)):?> <?php echo get_post_meta($post->ID, 'last_name', true);?><?php endif;?>
</h2>
  <br>
 </div> </div>
      </div>
    </header>
<hr/>
<div class="ucla campus">

      <div class="col span_9_of_12">
<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
      </div>
<div class="col span_3_of_12">
<h3><?php if(get_post_meta($post->ID, 'first_name',true)):?> <?php echo get_post_meta($post->ID, 'first_name', true);?> <?php endif;?><?php if(get_post_meta($post->ID, 'middle_name',true)):?> <?php echo get_post_meta($post->ID, 'middle_name', true);?> <?php endif;?><?php if(get_post_meta($post->ID, 'last_name',true)):?> <?php echo get_post_meta($post->ID, 'last_name', true);?><?php endif;?></h3>
<br><br>
<?php if(get_post_meta($post->ID, 'role',true)):?> <?php echo get_post_meta($post->ID, 'role', true);?> <?php endif;?>
</hr>
<h4>Contact information</h4>
<b>Email:</b><a  href="mailto:<?php if(get_post_meta($post->ID, 'email',true)):?> <?php echo get_post_meta($post->ID, 'email', true);?> <?php endif;?>"><?php if(get_post_meta($post->ID, 'email',true)):?> <?php echo get_post_meta($post->ID, 'email', true);?> <?php endif;?></a>
<br><br>
<b>Office location:</b><?php if(get_post_meta($post->ID, 'office',true)):?> <?php echo get_post_meta($post->ID, 'office', true);?> <?php endif;?>
<br><br>
<b>Phone Number:</b><a href="tel:<?php if(get_post_meta($post->ID, 'phone',true)):?> <?php echo get_post_meta($post->ID, 'phone', true);?> <?php endif;?>"><?php if(get_post_meta($post->ID, 'phone',true)):?> <?php echo get_post_meta($post->ID, 'phone', true);?> <?php endif;?></a>
<br><br>
<b>Website:</b>
<a  href="<?php if(get_post_meta($post->ID, 'website',true)):?> <?php echo get_post_meta($post->ID, 'website', true);?> <?php endif;?>"><?php if(get_post_meta($post->ID, 'website',true)):?> <?php echo get_post_meta($post->ID, 'website', true);?> <?php endif;?></a>
</div>
      </div>
</main>
<?php get_footer();?>
