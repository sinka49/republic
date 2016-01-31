<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/style.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=asset('css/jquery.formstyler.css')?>" />
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="<?=asset('js/jquery.min.js')?>"></script>
    <script src="<?=asset('js/jquery.formstyler.min.js')?>"></script>
</head>

<body class="inside">

<aside>
    <a href="http://republic.tk" class="logo">
		<span class="logoTyapLyap">
			<i></i>
		</span>
        <span>RePublic</span>
        Сервис-гид по Республике Дагестан
    </a>

    <nav class="mainmenu">
        <ul>
            <li><a href="/filter/places">Достопримечательности</a></li>
            <li><a href="/filter/eat">Где поесть?</a></li>
            <li><a href="/filter/sleep">Где поспать?</a></li>
            <li><a href="/filter/gide">Экскурсии</a></li>

            <li class="special"><a href="#">Предложить услугу</a></li>
        </ul>
    </nav>

</aside>
<main>
<div id="info">{{$JSONarray}}</div>
    <div class="filters">
        <form action="#">
            <h1>Фильтровать</h1>
            <select name="typerest" id="typerest">
                @foreach ($rests as $rest)
                    <option>{{$rest->rest_type}}</option>
                @endforeach
            </select>

            <select name="town" id="town">
                @foreach ($cities as $city)
                    <option>{{$city->city_name}}</option>
                @endforeach
            </select>
            <label><input type="checkbox" name="check1"/>{{$check['0']}}</label>
            <label><input type="checkbox" name="check2"/> {{$check['1']}}</label>
            <label><input type="checkbox" name="check3"/> {{$check['2']}}</label>
            <button class="submit"><img src="http://republic.tk/images/search.png">Искать</button>
        </form>
    </div>

    <div class="content">
        <div id="tittle">{{$success}}</div>
        <div id="map" style=" width: 100%; height: 800px;"></div>
    </div>

</main>



<script type="text/javascript">
    var arrayString = $('#info').text();
    var arrayJson = JSON.parse(arrayString);
    var arrayLng = [];
    var arrayLat = [];
    var coords = [];
    var i = 0;

        for (var item in arrayJson['items']){

            arrayLng[item]= arrayJson['items'][item]['longitude'];

            arrayLat[item]= arrayJson['items'][item]['latitude'];
            coords[item]= [arrayLat[item], arrayLng[item]];
            i++;

        }





    if(coords.length>1){

        var minlat = Math.min.apply(null, arrayLat);
        var maxlat = Math.max.apply(null, arrayLat);
        var minlng = Math.min.apply(null, arrayLng);
        var maxlng = Math.max.apply(null, arrayLng);
        var centerLat = minlat +(maxlat - minlat)/2;
        var centerLng = minlng +(maxlng - minlng)/2;
    }
    else{
        var centerLat = coords[0][0];
        var centerLng = coords[0][1];
    }
    ymaps.ready(init);
    var myMap,
            myPlacemark;

    function init(){

        myMap = new ymaps.Map("map", {
            center: [centerLat,centerLng],
            zoom:12
        });

        myCollection = new ymaps.GeoObjectCollection({}, {
            preset: 'islands#redIcon', //все метки красные
            draggable: true // и их можно перемещать
        });

        for (var i = 0; i < coords.length; i++) {
            myCollection.add(new ymaps.Placemark(coords[i]));
        }

        myMap.geoObjects.add(myCollection);
    }

</script>
@section('scripts')
<script  type="text/javascript">
    (function($) {
        $(function() {
            $('input, select').styler({
                selectSearch: true
            });
        });
    })(jQuery);
</script>
@stop
</body>
</html>