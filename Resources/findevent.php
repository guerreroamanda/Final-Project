<!DOCTYPE html> 
<html manifest="manifest.appcache.php">
	<head> 
	<meta charset="UTF-8" />
	<title>Find an Event</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.css" />
  <script src="js/cache-manager.js" type="text/javascript"></script>
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script type="text/javascript">
    // Need to bind to mobileinit before jQ mobile library is loaded
    $(document).bind('mobileinit',function(){
      $.mobile.selectmenu.prototype.options.nativeMenu = false;
    });
  </script>
  <script src="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.js"></script>
  <link rel="stylesheet" href="css/styles.css" />
</head> 
<body> 

<div data-role="page" id="event_page">

<script>
(function () {
  var $page, $searchForm, $submitButton, $stateFilter;

  $page = $('#event_page');
  if (!$page.data.initialized) {
    $page.live('pagecreate', initGeo);
    $page.data.initialized = true;
  }

  function initGeo() {
    $searchForm = $('#search_form');
    $submitButton = $('#search_submit');
    $stateFilter = $('#state_filter');
    if (geo_position_js.init()) {
      initGeoOptions();
    }
  }
  function initGeoOptions() {
    var $latField, $longField, $flipSwitch;
    $flipSwitch = $('<select name="usegeo" id="usegeo" data-role="slider"><option value="off">Off</off><option value="on">On</option></select>').change(toggleLocation);
    $flipSwitch.prependTo($searchForm).wrap('<div data-role="fieldcontain"></div>');
    $flipSwitch.before('<label for="usegeo">Use my Location:</label>');
    $latField = $('<input type="hidden" />').attr({ name : 'latitude', id : 'latitude'})
    $longField = $('<input type="hidden" />').attr({ name: 'longitude', id : 'longitude' })
    $latField.appendTo($searchForm);
    $longField.appendTo($searchForm);          
  }
  function toggleLocation(event) {
    var geoActivated = ($(event.target).val() == 'on') ? true : false;
    if (geoActivated) {
      $submitButton.button('disable');
      $stateFilter.selectmenu('disable');
      $.mobile.showPageLoadingMsg();
      geo_position_js.getCurrentPosition(onGeoSuccess, onGeoError);
    } else {
      $stateFilter.selectmenu('enable');
      $submitButton.button('enable');
    }
  }
  function onGeoSuccess(position) {
    var coordinates = position.coords;
    $('#latitude').val(coordinates.latitude);
    $('#longitude').val(coordinates.longitude);
    $.mobile.hidePageLoadingMsg();
    $submitButton.button('enable');
  }
  function onGeoError(error) {
    $('#usegeo').val('off').trigger('change');
    $.mobile.changePage( "dialogs/geolocation_error.html", { 
    transition: "pop", 
    reverse: false, 
    role: 'dialog'
	});
  }
  
})();	
</script>

	<div data-role="header" data-position="fixed">
		<h1>Find Event</h1>
	</div><!-- /header -->

	<div data-role="content"> 
  <script src="js/geo.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/geolocation.js"></script>
  <form method="get" action="events.php" id="search_form"> 
    <div data-role="fieldcontain"> 
      <label for="state_filter">Search by State</label> 
      <select id="state_filter" name="state_filter"> 
        <option value="">Choose State</option> 
        <option value="AL">Alabama</option> 
<option value="AK">Alaska</option> 
<option value="AZ">Arizona</option> 
<option value="AR">Arkansas</option> 
<option value="CA">California</option> 
<option value="CO">Colorado</option> 
<option value="CT">Connecticut</option> 
<option value="DE">Delaware</option> 
<option value="DC">District Of Columbia</option> 
<option value="FL">Florida</option> 
<option value="GA">Georgia</option> 
<option value="HI">Hawaii</option> 
<option value="ID">Idaho</option> 
<option value="IL">Illinois</option> 
<option value="IN">Indiana</option> 
<option value="IA">Iowa</option> 
<option value="KS">Kansas</option> 
<option value="KY">Kentucky</option> 
<option value="LA">Louisiana</option> 
<option value="ME">Maine</option> 
<option value="MD">Maryland</option> 
<option value="MA">Massachusetts</option> 
<option value="MI">Michigan</option> 
<option value="MN">Minnesota</option> 
<option value="MS">Mississippi</option> 
<option value="MO">Missouri</option> 
<option value="MT">Montana</option> 
<option value="NE">Nebraska</option> 
<option value="NV">Nevada</option> 
<option value="NH">New Hampshire</option> 
<option value="NJ">New Jersey</option> 
<option value="NM">New Mexico</option> 
<option value="NY">New York</option> 
<option value="NC">North Carolina</option> 
<option value="ND">North Dakota</option> 
<option value="OH">Ohio</option> 
<option value="OK">Oklahoma</option> 
<option value="OR">Oregon</option> 
<option value="PA">Pennsylvania</option> 
<option value="RI">Rhode Island</option> 
<option value="SC">South Carolina</option> 
<option value="SD">South Dakota</option> 
<option value="TN">Tennessee</option> 
<option value="TX">Texas</option> 
<option value="UT">Utah</option> 
<option value="VT">Vermont</option> 
<option value="VA">Virginia</option> 
<option value="WA">Washington</option> 
<option value="WV">West Virginia</option> 
<option value="WI">Wisconsin</option> 
<option value="WY">Wyoming</option>
      </select> 
    </div> 
    <div data-role="fieldcontain"> 
      <input type="submit" value="Find Events" id="search_submit" /> 
    </div> 
  </form> 
</div><!-- /content -->

	<div data-role="footer" data-position="fixed">
		<div data-role="navbar"> 
			<ul> 
				<li><a href="index.php" data-icon="info">About</a></li> 
				<li><a href="findevent.php" data-icon="star" class="ui-btn-active">Events</a></li> 
				<li><a href="tartans.php" data-icon="grid">Tartans</a></li> 
			</ul> 
		</div><!-- /navbar --> 
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>