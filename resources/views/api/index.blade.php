<h1>Методы сущности Listview</h1>
<ol>
    <li>ListView. Параметры:
        <ol>
            <li>без параметров - выведет все</li>
        </ol>
    </li>
    <li>ListView/Filter. Параметры:
        <ol>
            <li>без параметров - выведет все</li>
            <li>city - сортировка по городу(может быть значение 'любой' )</li>
            <li>rest - сортировка по виду отдыха(может быть значение 'любой')</li>
            <li>categoryApp - сортировка по виду где пожрать(может быть значение 'любой')</li>
        </ol>
    </li>
</ol>
<br/>
<br/>
<h2>Примеры использования api</h2>
<h3>Примеры использования ListView/Filter (сущность ListView с сортировкой для фильтра)</h3>
<ol>
    <li>http://republic.tk/api/ListView/Filter/ - выведет все</li>
    <li>http://republic.tk/api/ListView/Filter/махачкала - выведет все по махачкале</li>
    <li>http://republic.tk/api/ListView/Filter/махачкала/любой - эквивалентно 2</li>
    <li>http://republic.tk/api/ListView/Filter/МахАчКаЛа/ЛюБоЙ - эквивалентно 2</li>
    <li>http://republic.tk/api/ListView/Filter/каккакакак/активный -выведет все по активному</li>
    <li>http://republic.tk/api/ListView/Filter/любой/активный - эквивалентно 5</li>
    <li>http://republic.tk/api/ListView/Filter/ЛЮвВБоЦВ/активный - эквивалентно 5</li>
    <li>http://republic.tk/api/ListView/Filter/махачкала/активный%20отдых - сортировка по городу и виду отдыха</li>
    <li>http://republic.tk/api/ListView/Filter/МахаЧкаЛа/АктиВный - эквивалентно 8</li>
    <li>http://republic.tk/api/ListView/Filter/МахаЧ/АктиВ - эквивалентно 8</li>
    <li>http://republic.tk/api/ListView/Filter/МахаЧ/АктиВ/1 - сортировка по городу, виду отдыха, только достопримечательности</li>
    <li>http://republic.tk/api/ListView/Filter/МахаЧ/АктиВ/3 - сортировка по городу, виду отдыха, только где пожрать</li>
</ol>
