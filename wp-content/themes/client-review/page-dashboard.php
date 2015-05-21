<?php get_header(); ?>

<?php if (is_user_logged_in()) { ?>

	<div class="wrapper" id="main-wrapper">

		<div class="section" id="main">

			<div class="section-content" id="main-content">

				<section id="content" role="main">

					<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

					<article <?php post_class('ng-cloak') ?> id="post-<?php the_ID(); ?>">

						<header class="page-header clearfix">

						</header>

						<div ng-controller="ConceptFilter">

							<form class="row form" role="form">

								<div class="form-group col-lg-4" ng-hide="clients.length <= 1">

									<h3>Entity</h3>

									<div loading-spinner="viewLoading" ng-select ng-model="selectedClient" select-class="{'label label-warning': $optSelected, 'label': !$optSelected}">

										<h4 ng-repeat="client in clients" style="margin-top:0;">
											<span ng-click="changeClient(client);refreshProjects();" style="width:100%; cursor:pointer; display:block; text-align:left" data-id="{{client.ID}}" ng-select-option="client">{{client.post_title}}</span>
										</h4>

									</div>

								</div>

								<div class="form-group col-lg-8" ng-hide="projects.length < 1">

									<h3>Project</h3>

									<div loading-spinner="viewLoading" ng-select ng-model="selectedProject" select-class="{'label label-warning': $optSelected, 'label': !$optSelected}">

										<h4 ng-repeat="project in projects" style="margin-top:0;">
											<span ng-click="refreshConcepts();changeProject(project);" style="width:100%; cursor:pointer; display:block; text-align:left" ng-select-option="project">{{project.name}}</span>
										</h4>

									</div>

								</div>

								<div class="col-lg-12">
									<hr>
								</div>

							</form>


							<div class="row voffset20">

								<a class="col-lg-3 voffset20 concept-card" ng-repeat="concept in concepts" ng-href="{{concept.permalink}}">

									<div class="panel panel-default">

										<div class="panel-heading">
											<h3 class="panel-title">{{concept.post_title}}</h3>
										</div>

										<div class="panel-body concept-body-{{concept.concept_type}}" style="background-image: url({{concept.thumbnail.sizes.medium}})">

										</div>

									</div>

								</a>

							</div>


						</div>

					</article>

					<?php } } ?>

				</section>

			</div><!-- End #main-content -->

		</div><!-- End #main -->

	</div><!-- End #main-wrapper -->

<?php } ?>

<?php get_footer(); ?>
