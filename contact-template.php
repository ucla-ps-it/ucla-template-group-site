<?php get_header();?>

<main id="main">
<header class="header">
      <div class="ucla campus">
	<div class="col span_12_of_12">
<br>
<h2 class="yellow-side-header">Contacts & Directions</h2>

</div>
</div>
</header>
<br>
<br>
<div class="ucla campus">
<div class="col span_9_of_12">

<h4> Contact Informations </h4>

<p>
	<b>Office: </b><?php if(get_post_meta($post->ID, 'contact_address',true)):  echo get_post_meta($post->ID,'contact_address',true);  endif;?>
<br>
	<b>Email: </b><?php if(get_post_meta($post->ID, 'contact_email',true)): ?> <a href="mailto:<?php  echo get_post_meta($post->ID,'contact_email',true);?>" style="text-decoration:none"><?php  echo get_post_meta($post->ID,'contact_email',true);?></a><?php  endif;?>
<br>
	<b>Phone: </b><?php if(get_post_meta($post->ID, 'contact_phone',true)): ?> <a href="tel:<?php  echo get_post_meta($post->ID,'contact_phone',true);?>" style="text-decoration:none">Call us</a><?php  endif;?>
<br>
	<b>Fax: </b><?php if(get_post_meta($post->ID, 'contact_fax',true)): ?> <a href="fax:<?php  echo get_post_meta($post->ID,'contact_fax',true);?>" style="text-decoration:none">Send a Fax</a><?php  endif;?>
<br>
	<b>Department Website: </b><?php if(get_post_meta($post->ID, 'contact_website',true)): ?> <a href="<?php  echo get_post_meta($post->ID,'contact_website',true);?>" style="text-decoration:none"><?php  echo get_post_meta($post->ID,'contact_website',true);?></a><?php  endif;?>
<br>


</p>

<h4> Mailing Address</h4>

<p><?php if(get_post_meta($post->ID, 'contact_mail',true)):   echo get_post_meta($post->ID,'contact_mail',true); endif;?></p>

<h4> Delivery Address</h4>

<p><?php if(get_post_meta($post->ID, 'contact_delivery',true)):   echo get_post_meta($post->ID,'contact_delivery',true); endif;?></p>

</div></div>
