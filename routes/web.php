<?php

/*
 * TODO add correct middleware
 * TODO add permission checks.
 * */

Route::get("/", 'HomeController@index');
Route::get("/home", 'HomeController@index')->name('home');

// Authentication Routes...
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('registered', 'Auth\RegisterController@showRegistered')->name('registered');



// Agency
Route::group(['prefix' => 'agencies'], function (){
    // User can create an Agency while registering an account
    Route::post('/', 'AgencyController@store')->name('agencies.store');

    // used with <select> element
    Route::get('/indexselect', 'AgencyController@indexSelect');
});


// User Authenticated Routes...
//
Route::middleware(["auth"])->group(function (){

    Route::resource("new-products", "NewProductController");
    Route::post('/search', 'SearchController@search')->name('search');

    Route::view('/built-and-priced', 'builtAndPriced.show')->name("built-and-priced.index");
    //Route::get("/contact-us", function () { return view('pages.contact_us'); })->name("pages.contact-us");
    Route::get("/contact-us", "HomeController@getContactUs")->name("pages.contact-us");

    Route::prefix("agencies")->group(function (){
        Route::get("/", "AgencyController@index")->name("agencies.index");
        Route::get("/awaiting", "AgencyController@index")->name("agencies.awaiting");
        Route::post("/ajaxindex","AgencyController@AjaxIndex")->name('agencies.ajaxindex');
        Route::post("/ajaxawaiting","AgencyController@postAjaxAwaiting")->name('agencies.ajaxawaiting');
        Route::post("/approved","AgencyController@postApproved")->name('agencies.approved');
        Route::post("/deletemultiple","AgencyController@postDeleteMultiple")->name('agencies.deletemultiple');
        Route::get("/create", "AgencyController@create")->name("agencies.create");
        Route::get("/{slug}", "AgencyController@show")->name("agencies.show");
        Route::get("/{slug}/edit", "AgencyController@edit")->name("agencies.edit");
        Route::put("/{slug}/update", "AgencyController@update")->name("agencies.update");
        Route::delete("/{slug}/destroy", "AgencyController@destroy")->name("agencies.destroy");
        Route::post("/getteam/{id}","AgencyController@postTeamDetail")->name("agencies.getteam");
        Route::post("/setmanager","AgencyController@SetManager")->name("agencies.setmanager");
    });


    Route::prefix("agents")->group(function (){
        Route::get("/", "AgentController@index")->name("agents.index");
        Route::get("/create", "AgentController@create")->name("agents.create");
        Route::get("/{slug}", "AgentController@show")->name("agents.show");
        Route::get("/{slug}/edit", "AgentController@edit")->name("agents.edit");
        Route::put("/{slug}/update", "AgentController@update")->name("agents.update");
        Route::delete("/{slug}/destroy", "AgentController@destroy")->name("agents.destroy");
    });


    Route::prefix("marketing-tools")->group(function (){
        Route::get("/", "MarketingToolsController@index")->name("marketing.tools.index");
        Route::get("/sales-literature", "MarketingToolsController@getSalesLiterature")->name("marketing.sales-literature.get");
        Route::post("/sales-literature", "MarketingToolsController@postSalesLiterature")->name("marketing.sales-literature.post");
        Route::get("/custom-brochure", "MarketingToolsController@getCustomBrochure")->name("marketing.custom-brochure.get");
        Route::post("/custom-brochure", "MarketingToolsController@postCustomBrochure")->name("marketing.custom-brochure.post");
        Route::get("/display-board", "MarketingToolsController@getDisplayBoard")->name("marketing.display-board.get");
        Route::post("/display-board", "MarketingToolsController@postDisplayBoard")->name("marketing.display-board.post");
    });



    // REVIEW this methods, now that training modules are no longer attached to products. ------------!!!!!!!!!!!!!! REVIEW
    //
    Route::prefix("product-training-videos")->group(function (){
        Route::get("/", "ProductTrainingVideoController@index")->name("product-training-videos.index");
        Route::get("/create", "ProductTrainingVideoController@create")->name("product-training-videos.create");
        Route::get("/{slug}", "ProductTrainingVideoController@show")->name("product-training-videos.show");
        Route::get("/{slug}/edit", "ProductTrainingVideoController@edit")->name("product-training-videos.edit");

        Route::put("/{productTrainingVideo}/update", "ProductTrainingVideoController@update")->name("product-training-videos.update");
        Route::post("/store", "ProductTrainingVideoController@store")->name("product-training-videos.store");
        Route::delete("/{productTrainingVideo}/destroy", "ProductTrainingVideoController@destroy")->name("product-training-videos.destroy");
    });



    /*
    |--------------------------------------------------------------------------
    | AJAX calls
    |--------------------------------------------------------------------------
    */

    Route::prefix('ajax')->group(function (){
        Route::post('/new-products/index', 'NewProductController@indexQuery')->name("ajax.new-product.index");
        Route::post("/product-training-videos/index", "ProductTrainingVideoController@indexQuery")->name("ajax.product-training-videos.index");

        // <select> Product Category
        Route::get('/product-category/index', 'ProductCategoryController@indexSelect');
    });
});

Route::resource('new-products','NewProductController');