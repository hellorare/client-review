<!doctype html>
<html lang="en" class="no-js" ng-app="review">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="author" href="<?php bloginfo('url'); ?>/humans.txt" />
<meta name="generator" content="WordPress" />

<!--[if IE]><![endif]-->

<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>

<!-- Mobile specific -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<!-- Stylesheets and Icons -->
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon.png">

<!-- Compiled Stylesheet -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">

<!-- Start Wordpress Head -->
<?php wp_head(); ?>
<!-- End Wordpress Head -->

<!--[if lte IE 8]>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<!--[if IE 8 ]><body <?php body_class('ie8'); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body <?php body_class(); ?>><!--<![endif]-->

<div id="page-wrapper">

	<div class="wrapper" id="header-wrapper">

		<header class="section" id="header" role="banner">

			<div class="section-content" id="header-content">

				<div id="logo">

					<img id="rare-logo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJ4AAAAhCAMAAAAfx+LpAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAACylBMVEX/2hr/////2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr/2hr///+xeIO8AAAA7HRSTlMAAAqY9fKPBm/p0zBd4P28JgSJ8PZ4CJxObmGh7dCRN9ZK+x5gELiqAeUX7gPEVrNosUupUfEZIyE4CVNQzsdXDWIOJOSUsNrbOxGEqzPALeuVP6zG9xznNYh6Zuz6fr61Koo0/jFbg0J37yD4EgLql0m2pnOi/NJP82nfB1nUWp/DWBNHZMlE6AyCXmpGFso8ZZZIbK0b9IGLVQ8lMtkV4y9r5tyOsh99GBSkds23BaU++ZlBHYDXcMFNPaO9y38o3tXYwjlnna9tGimTdVyufCu7qOELTIYu4t2NJ5BAX7rRz6AiQzbImsxFv0keNhcAAAABYktHRAH/Ai3eAAAACXBIWXMAAAsSAAALEgHS3X78AAAFmUlEQVRYw5WY+UMUZRjH31lZ0dUdXFgMD0JW0VFX0QKPVVAB2SSPTUUFXfHY8MJFPFYpErzFA0tDNCvUELWyNNPKo7RSU7PDKLPCsiw7vn9Es+zs7FzvODw/7Pu8z/vMM5995n2feeclxNQmCjQxt40mmtKuvaWD5kBHKzUYG9NJdLPFxlH97PEML50fS+jSlSGkG7on0iQOj2tCJMGOHjaNgWQ4LLRgVlhNYb9YmHVu2jPI1yuldx+OELZvCqFJv/52p5Z9AAamYpDGwGA8QQ3GPYm0sJ5uHkLxYoZaMSyIN9w1YiRDOAwmdMmAS8M6ApncKLQfreVvoweLxxhBy8IAmlN2DsYyovB4ufSAJodbwxr9FMaRPBZPq4cSofNfx2OCoKVgIsVnkgfPcEbxJqObhrULpvC/U5E/rXV406PCqaXizfCggGGM4hViptqYMss7lG9mQ4NdD28YisQQFLykdMxmjOPNwVy1cR7aBpv5gO/Z1uAVY8Ej8BbasYgxjsf1X8ypjEtKFi8Ntv5SIKY1eMtQpo+XbOdZWoE3F8vVxhVYGVJWIYDkVuCt9okVTBNvjZctx3OtwJuJQpVtBp6vCGkvIBNrFXVEBy+LtYi6Fl4x661MisIY43hVmKyyrcN6QdvAJqYql44O3ka00cPbxHoTgrOPLTaM5w6YlKY0bBanYya2BLZWG8Xbhu06eDtg3xlsy7yOBIN4NdilNNnceFHszMZLuyOr8VF4MRhKx4uHeWFISwh49xjDSwtVEKm8jNpIZz5ya8z2vcbwnHVbIx0l3j6kJwkqU8zaJxjC249XFJYDHu+rkZ6/tK6iEFXG8F6T/jE5HhcLj1hBGWYQUo3gOV/31StMBfIN1ipscR30HTKEtw2HKXjcMrwxSewxjD/QYADPdgSNCtPR/LgN0n5XHCMdZbWZircxv/y4Np6zCjnZkaFg9hofiffmygaUHlUY38Lbsn4aYon/hLQ2a+PZRr4DcTOlwHv3JBqk9zEy906teA+o7amwzoe1s8xwGr0IeR9rI1tWLbwzZ/sCbtn7JYIX3YgPZBsffuWW6a7cpR/2AErnZavu8xEqZf1idtZovknFJjqe81wqC0ftTr/MKuKZesMim+Bl3oBu3Tt/oQS4OFDjEygBH0s2CIc+scB7LqhdCkwXa7MC78zZg8DlwuPKUGG80UXYvFQ6oP/WaEkc8OkEohbbZzgfTsmpI5d5t8+vhLq7sU8LryVxQMlVvyqWgHdgM9YdkNp137lC4q5Mhe9aP1XIHfiipXWdu8ZvpRwXr4tTs8YcdUOFJyTu5pcBZJxXxgrh1WegSPbW7JBO3bFIZhxXmQPzLcXjzSp1dCIk76spdUDU19tlj+QbXJPjSWfct7eB73pq4B23oFG+1ArRZNLEGyefcd8vyIf7B9mldzB27+HbDmBW1Rrl15srx/ejBO/GsbtA07FwRsnIn2A/61LiTWvAFEUKTEV8OlV4Kdct/F1//kXquWQ80PtmpH8mHw38RGpqvqf14fsrfgvj+ZNzAwjkJksnXEV8Oe6OkqwrHi/bipOqUKZMzIlW4HW3AxMrK5Su9+7D0Szuby/wbKv3qb4tBPH/jj0CXpMscWEZ8ge/kiJXp8Cdg2Uaf5RfLIOdcjxl4sLiHOSB52ooxgNf+aIHhC5/4oSAp0icKH89hO/vGhEPaOa03OotfFJleE3VhCJ5zQHsygtqxZHaoS3/oKW4ZWAnzYPr2Bdx/4b0LGA/xa3ejdMSPMIepJ+xkJv/4VawTUAfjuhItdXXspb1zlhI9R3fCUGNwyWKEzNNOGMR8LphcSJdmtAueJHrMqw6XokeoSgmg11L97qPhwJEgc5NhRMqAU/vfA9gl4ce/YMYVscLJauE6q9zvhdc+MMFPGdBOv18rzDycP8HZoUJvHlnHUwAAAAASUVORK5CYII=" alt="The Rare Logo" title="<?php wp_title(); ?>"/>

					<a class="dashboard-link" href="<?php echo get_permalink( 4 ); ?>"><span class="glyphicon glyphicon-th"></span> Dashboard</a>

					<span class="pull-right">Hello <?php $current_user = wp_get_current_user(); echo $current_user->display_name; ?></span>

				</div>

			</div>

		</header>

	</div>

	<div class="wrapper" id="nav-wrapper">

		<div class="menu-header">

			<nav id="main-nav" role="navigation">

				<?php // wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'false' ) ); ?>

			</nav>

		</div>

	</div>


	<?php if (!is_user_logged_in()) { ?>

		<div class="wrapper" id="login-form-wrapper">

			<div class="section" id="login-form">

				<div class="section-content" id="login-form-content">

					<form method="post" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ) ?>" class="col-lg-6 col-lg-offset-3 col-sm-12 col-sm-offset-0">

						<div class="login-form">

							<div class="form-group">

								<input name="log" type="text" class="form-control login-field" value="" placeholder="Username" id="user_login" />
								<label class="login-field-icon fui-user" for="user_login"></label>

							</div>

							<div class="form-group">

								<input name="pwd" type="password" class="form-control login-field" value="" placeholder="Password" id="user_pass" />
								<label class="login-field-icon fui-lock" for="user_pass"></label>

							</div>

							<input class="btn btn-primary btn-lg btn-block" type="submit"  name="wp-submit" value="Log in" />
							<input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

						</div>

					</form>

				</div>

			</div>

		</div>

	<?php } ?>

