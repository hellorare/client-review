
<div class="concept-content" ng-controller="mainController">

	<div class="btn-toolbar" role="toolbar">

		<div class="btn-group pull-right" role="group">
			<!-- <a ng-click="showDiff = !showDiff" ng-class="{'active': showDiff}" class="btn btn-warning toggle">Highlight Differences</a> -->
		</div>

	</div>

	<div class="row voffset30">

		<div ng-class="{ 'col-lg-9': info.concept_type != 'flash', 'col-lg-12': info.concept_type == 'flash' }">

			<div class="panel panel-default">

				<div class="panel-heading">
					<h3 class="panel-title">Revision {{activeRevision.date}}</h3>
				</div>
				<div class="panel-body text-muted">
					<div ng-include="getIncludeFile('active')"></div>
				</div>

			</div>

		</div>

		<div class="col-lg-3">

			<h3>Revisions <br><small>most recent to least recent</small></h3>

			<div class="panel panel-default voffset30" ng-repeat="revision in revisions.slice().reverse()" ng-click="switchRevision(revision)">

				<div class="panel-heading">
					<h3 class="panel-title">Revision {{revision.date}}</h3>
				</div>
				<!-- <div class="panel-body text-muted" ng-include="getIncludeFile('revision')" ></div> -->
				<div class="panel-body clearfix">
					<button ng-hide="activeRevision == revision" type="button" class="btn btn-success pull-right">View <span class="glyphicon glyphicon-share-alt"></span></button>
					<button disabled class="btn btn-default pull-right text-success" ng-if="activeRevision == revision" aria-hidden="true">Current <span class="glyphicon glyphicon-ok"></span></button>
				</div>

			</div>

		</div>

	</div>

</div>



<!-- Copy -->

<script type="text/ng-template" id="copy-active.html">

	<div ng-bind-html="activeRevision.content"></div>

</script>

<script type="text/ng-template" id="copy-revision.html">

	<div ng-bind-html="revision.content | limitTo : 100"></div>

</script>



<!-- Image -->

<script type="text/ng-template" id="image-active.html">

	<div ng-repeat="image in activeRevision.images">

		<img ng-click="openModal()" ng-src="{{image.image.url}}">

		<p>
			<strong ng-bind-html="image.note"></strong>
		</p>

	</div>

</script>

<script type="text/ng-template" id="image-revision.html">

	<img ng-src="{{revision.image.sizes.medium}}">

</script>

<script type="text/ng-template" id="image-modal.html">

	<img ng-src="{{activeRevision.image.url}}">

	<p ng-bind-html="activeRevision.caption"></p>

</script>


<!-- PDF -->

<script type="text/ng-template" id="pdf-active.html">

	<iframe ng-if="activeRevision" ng-src="{{getIframeURL(activeRevision)}}" style="width:100%; height:1200px;" frameborder="0"></iframe>

</script>

<script type="text/ng-template" id="pdf-revision.html">

	<iframe ng-if="revision" ng-src="{{getIframeURL(revision)}}" style="width:100%; height:200px;" frameborder="0"></iframe>

</script>



<!-- Flash -->

<script type="text/ng-template" id="flash-active.html">

	<div ng-repeat="object in activeRevision.swfs">

		<br>

		<p>
			<strong ng-bind-html="object.note"></strong>
		</p>

		<embed embed-src="{{object.swf.url}}" width="{{object.width}}px" height="{{object.height}}px">

	</div>

</script>

<script type="text/ng-template" id="flash-revision.html">

</script>

<script type="text/ng-template" id="flash-modal.html">

	<embed embed-src="{{activeRevision.swf.url}}" width="{{activeRevision.width}}" height="{{activeRevision.height}}">

</script>



<!-- Video -->

<script type="text/ng-template" id="video-active.html">

	<videogular vg-player-ready="onPlayerReady($API)" vg-theme="videoConfig.theme.url">
      <vg-media vg-src="videoConfig.sources"
                vg-native-controls="true">
      </vg-media>
  </videogular>

</script>

<script type="text/ng-template" id="video-revision.html">

</script>


<!-- Storyboard -->

<script type="text/ng-template" id="storyboard-active.html">

	<p>
		<strong ng-bind-html="activeRevision.note"></strong>
	</p>

	<p ng-repeat="image in activeRevision.storyboard">
		<img ng-click="setActive(image);openModal()" ng-src="{{image.url}}" class="storyboard-image">
	</p>

	<p ng-bind-html="image.note"></p>

</script>

<script type="text/ng-template" id="storyboard-revision.html">

</script>

<script type="text/ng-template" id="storyboard-modal.html">

	<img ng-src="{{activeImage.url}}">

	<p ng-bind-html="activeImage.caption"></p>

</script>
