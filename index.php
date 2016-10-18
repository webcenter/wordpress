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