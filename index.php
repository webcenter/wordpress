<!-- COMO CHAMAR UMA CATEGORIA -->
<?php query_posts('category_name=SLUG_CATEGORY&posts_per_page=2'); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <!-- conteudo true -->
<?php endwhile; ?>
<?php else: ?>
    <!-- conteudo false -->
<?php endif; ?>


<!--COMO VERIFICAR SE HÁ IMAGEM EM DESTAQUE-->
<?php if (has_post_thumbnail()) { // Check if Thumbnail exists ?>
    <?php the_post_thumbnail('news', array('class' => 'img-responsive')); ?>
<?php } else { ?>
    <!-- imagem padrao -->
<?php } ?>

<!--GET URL THUMBNAIL-->
<?php if (has_post_thumbnail()) : ?>
    <img src="<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'size', false, ''); echo $src[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="img-responsive"/>
<?php else : ?>
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/thumb.jpg">
<?php endif; ?>
