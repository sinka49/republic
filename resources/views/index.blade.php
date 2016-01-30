<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="<?=asset('css/style.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=asset('css/jquery.formstyler.css')?>" />
    <script src="<?=asset('js/jquery.min.js')?>"></script>
</head>

<body>

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
            <li><a href="#">Где поесть?</a></li>
            <li><a href="#">Где поспать?</a></li>
            <li><a href="#">Экскурсии</a></li>
        </ul>
    </nav>

    <div class="filter">
        <form action="filter/">
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
            <button class="submit"><img src="images/search.png">Искать</button>

    </form>
    </div>

</aside>
<main>

    <img id="mainmap" src="images/map.png" alt="">
    <a href="#" class="put">Предложить услугу</a>

</main>

<script src="<?=asset('js/jquery.formstyler.min.js')?>"></script>
<script>
    (function($) {
        $(function() {
            $('input, select').styler({
                selectSearch: true
            });
        });
    });
</script>
</body>
</html>