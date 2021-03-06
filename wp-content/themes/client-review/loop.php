				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

						<header>

							<time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>

							<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>

							<p class="meta">

								<span class="author">by <?php the_author_posts_link() ?></span>

							</p>

						</header>

						<section class="post-content">

							<?php the_excerpt(); ?>

						</section>

					</article>

				<?php endwhile; else: ?>
					<p>Sorry, no posts matched your criteria.</p>
				<?php endif; ?>

				<nav class="paging">
					<?php echo paginate_links(); ?>
				</nav>
