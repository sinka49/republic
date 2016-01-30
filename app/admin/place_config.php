<?php
Admin::model('republic\Place')->async()->title('Места')->with('rest', 'city','cat','location','images')->columns(function ()
{
	    Column::string('place_id', '№');
		Column::string('place_name', 'Название');
		Column::string('place_desc', 'Описание');
	    Column::string('location.longitude', 'Долгота');
	    Column::string('location.latitude', 'Широта');
	    Column::string('city.city_name', 'Город');
	    Column::string('cat_for_app.cat_for_app_id', 'Категория');
	    Column::string('picture', 'Рисунок');
	    Column::lists('rest.rest_type', 'Вид отдыха');
	    Column::lists('images.image_src', 'Изображения');
})->columnFilter()



/*->display(function ()
{
	$display = AdminDisplay::table();
	$display->columns([
		Column::string('place_id', 'Place Id'),
		Column::string('category_id', 'Category Id'),
		Column::string('place_name', 'Place Name'),
		Column::string('place_city', 'Place City'),
		Column::string('views', 'Views'),
		Column::string('place_desc', 'Place Desc'),
	]);
	return $display;
})
	/*->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::columns()->columns([
			[
				FormItem::text('place_id', 'Place'),
	FormItem::text('category_id', 'Category'),

			],
			[
				FormItem::text('place_name', 'Place Name'),
	FormItem::text('place_city', 'Place City'),
	FormItem::ckeditor('place_desc', 'Place Desc'),
			]
		]),
	]);
	return $form;
})->delete(null);*/;