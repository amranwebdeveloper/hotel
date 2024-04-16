<?php
use \Illuminate\Support\Facades\Route;
Route::get('/','HotelController@index')->name('hotel.admin.index');
Route::get('/create','HotelController@create')->name('hotel.admin.create');
Route::get('/edit/{id}','HotelController@edit')->name('hotel.admin.edit');
Route::post('/store/{id}','HotelController@store')->name('hotel.admin.store');
Route::post('/bulkEdit','HotelController@bulkEdit')->name('hotel.admin.bulkEdit');
Route::get('/recovery','HotelController@recovery')->name('hotel.admin.recovery');
Route::get('/getForSelect2','HotelController@getForSelect2')->name('hotel.admin.getForSelect2');

Route::get('/category','CategoryController@index')->name('hotel.admin.category.index');
Route::get('/category/edit/{id}','CategoryController@edit')->name('hotel.admin.category.edit');
Route::post('/category/store/{id}','CategoryController@store')->name('hotel.admin.category.store');
Route::get('/category/getForSelect2','CategoryController@getForSelect2')->name('hotel.admin.category.category.getForSelect2');
Route::post('/category/bulkEdit','CategoryController@bulkEdit')->name('hotel.admin.category.bulkEdit');

Route::get('/institutional','InstitutionalController@index')->name('hotel.admin.institutional.index');
Route::get('/institutional/edit/{id}','InstitutionalController@edit')->name('hotel.admin.institutional.edit');
Route::post('/institutional/store/{id}','InstitutionalController@store')->name('hotel.admin.institutional.store');
Route::get('/institutional/getForSelect2','InstitutionalController@getForSelect2')->name('hotel.admin.institutional.institutional.getForSelect2');
Route::post('/institutional/bulkEdit','InstitutionalController@bulkEdit')->name('hotel.admin.institutional.bulkEdit');

Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('hotel.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('hotel.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('hotel.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('hotel.admin.attribute.bulkEdit');

    Route::get('terms/{id}','AttributeController@terms')->name('hotel.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('hotel.admin.attribute.term.edit');
    Route::post('term_store','AttributeController@term_store')->name('hotel.admin.attribute.term.store');
    Route::post('editTermBulk','AttributeController@editTermBulk')->name('hotel.admin.attribute.term.bulkEdit');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('hotel.admin.attribute.term.getForSelect2');
    Route::get('getAttributeForSelect2','AttributeController@getAttributeForSelect2')->name('hotel.admin.attribute.getForSelect2');
});
Route::group(['prefix'=>'room'],function (){

    Route::group(['prefix'=>'attribute'],function (){
        Route::get('/','RoomAttributeController@index')->name('hotel.admin.room.attribute.index');
        Route::get('edit/{id}','RoomAttributeController@edit')->name('hotel.admin.room.attribute.edit');
        Route::post('store/{id}','RoomAttributeController@store')->name('hotel.admin.room.attribute.store');
        Route::post('editAttrBulk','RoomAttributeController@editAttrBulk')->name('hotel.admin.room.attribute.editAttrBulk');

        Route::get('terms/{id}','RoomAttributeController@terms')->name('hotel.admin.room.attribute.term.index');
        Route::get('term_edit/{id}','RoomAttributeController@term_edit')->name('hotel.admin.room.attribute.term.edit');
        Route::post('term_store','RoomAttributeController@term_store')->name('hotel.admin.room.attribute.term.store');

        Route::get('getForSelect2','RoomAttributeController@getForSelect2')->name('hotel.admin.room.attribute.term.getForSelect2');
    });

    Route::get('{hotel_id}/index','RoomController@index')->name('hotel.admin.room.index');
    Route::get('{hotel_id}/create','RoomController@create')->name('hotel.admin.room.create');
    Route::get('{hotel_id}/edit/{id}','RoomController@edit')->name('hotel.admin.room.edit');
    Route::post('{hotel_id}/store/{id}','RoomController@store')->name('hotel.admin.room.store');


    Route::post('/bulkEdit','RoomController@bulkEdit')->name('hotel.admin.room.bulkEdit');

});

Route::group(['prefix'=>'{hotel_id}/availability'],function(){
    Route::get('/','AvailabilityController@index')->name('hotel.admin.room.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('hotel.admin.room.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('hotel.admin.room.availability.store');
});
