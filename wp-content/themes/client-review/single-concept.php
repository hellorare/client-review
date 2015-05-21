<?php get_header(); ?>

	<div class="wrapper" id="main-wrapper">

		<div class="section" id="main">

			<div class="section-content" id="main-content">

				<section id="content" role="main">

				<?php if (review_can_user_view()) { ?>

					<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

						<header class="page-header clearfix">

							<?php $terms = get_the_terms(get_the_id(), 'project'); ?>



							<h1 class="pull-left">

								<a href="<?php echo get_permalink( 4 ); ?>/#?selectedClient=<?php echo get_field('client', 'project_' . $terms[0]->term_id); ?>"><?php echo get_the_title( get_field('client', 'project_' . $terms[0]->term_id) ); ?> </a>
								 	-
								<a href="<?php echo get_permalink( 4 ); ?>/#?selectedProject=<?php echo $terms[0]->term_id; ?>"><?php echo $terms[0]->name; ?></a>
								 	-
								<?php the_title(); ?></h1>

							<dl class="meta small dl-horizontal pull-right">

								<dt>Added</dt>
								<dd><time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time></dd>

								<dt>Modified</dt>
								<dd><time datetime="<?php the_modified_time('Y-m-d')?>"><?php the_modified_time('F jS, Y') ?></time></dd>

							</dl>

						</header>

						<?php get_template_part( 'concept-content' ); ?>

					</article>

					<?php comments_template(); ?>

					<?php } } ?>

				<?php } else { ?>

					<article>

						<header class="page-header clearfix">

							<h1 class="pull-left">Sorry, you don't have permission to view this concept</h1>

						</header>

					</article>

				<?php } ?>

				</section>

			</div><!-- End #main-content -->

		</div><!-- End #main -->

	</div><!-- End #main-wrapper -->

<?php get_footer(); ?>
