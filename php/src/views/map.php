<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sign in</title>
</head>

<body>
<div class="main">
    <div id="googleMap" style="width:100%;height:400px;"></div>

    <script>
        function myMap() {
            const lng = <?php echo $unit->lng; ?>;
            const lat = <?php echo $unit->lat; ?>;
            const mapProp = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 5,
            };
            const map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            new google.maps.Marker({
                position: {lat, lng},
                label: 'End',
                map: map,
            });
            new google.maps.Marker({
                position: {lat: <?php echo $route->start->lat; ?>, lng: <?php echo $route->start->lng; ?>},
                label: 'Start',
                map: map,
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcsiWzseBJLZ9mQqipHWqr0P1IjgWZJjI&callback=myMap"></script>

</div>

</body>

</html>