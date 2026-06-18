<?php get_header(); ?>

<main>
    <?php Container(function() { ?>
        <?php get_template_part('template-parts/contact/section', null, []); ?>
    <?php }, "px-0! text-sm md:px-6! md:text-base mt-30 md:mt-40"); ?>
</main>


<?php get_footer(); ?>