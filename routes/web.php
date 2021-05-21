<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
set_time_limit(0);
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Global Functions
Route::get('/previous','QuotationsController@previous')->name('previous','previous');

//Quotations
Route::get('/quotations','QuotationsController@index')->name('quotations','quotations')->middleware('auth');
Route::get('/unquoted','QuotationsController@unquoted')->name('unquoted','unquoted')->middleware('auth');
Route::get('/allquotes','QuotationsController@all_quotes')->name('all_quotes','all_quotes')->middleware('auth');
Route::get('/authorized','QuotationsController@authorized_quotes')->name('authorized','authorized')->middleware('auth');
Route::get('/quoted','QuotationsController@quoted')->name('quoted','quoted')->middleware('auth');
Route::get('/openQuotation/{id}','QuotationsController@open_quotation')->name('open_quotation','open_quotation')->middleware('auth');
Route::get('/viewQuotation/{id}','QuotationsController@client_quote')->name('client_quote','client_quote')->middleware('auth');
Route::get('/searchPart','QuotationsController@searchPart')->name('search','search')->middleware('auth');
Route::post('/saveQuote','QuotationsController@save_quote')->name('saveQuote','saveQuote')->middleware('auth');
Route::get('/save-quote-money-edit','QuotationsController@save_quote_money_edit')->name('save-quote-money-edit','save-quote-money-edit')->middleware('auth');
Route::get('/editQuote','QuotationsController@edit_quote')->name('editQuote','editQuote')->middleware('auth');
Route::get('/deleteQuote/{id}','QuotationsController@delete_quote')->name('deleteQuote','deleteQuote')->middleware('auth');
Route::get('/assessor','QuotationsController@assessor')->name('assessor','assessor')->middleware('auth');
Route::put('/editAssessor','QuotationsController@edit_assessor')->name('edit_assessor','edit_assessor')->middleware('auth');
Route::get('/deleteAssessor/{id}','QuotationsController@delete_assessor')->name('delete_assessor','delete_assessor')->middleware('auth');
Route::post('/createAssessor','QuotationsController@save_assessor')->name('save_assessor','save_assessor')->middleware('auth');
Route::get('/autocomplete','QuotationsController@autocomplete')->name('autocomplete','autocomplete')->middleware('auth');
Route::get('/prebookings/{id}','QuotationsController@prebooking')->name('prebookings','prebooking')->middleware('auth');
Route::put('/client-prebooking-update','QuotationsController@pprebooking_notes')->name('prebooking_update','prebooking_update')->middleware('auth');
Route::get('/proforma-invoice/{id}','QuotationsController@proforma')->name('proforma','proforma')->middleware('auth');
Route::get('/create-quote','QuotationsController@create_client')->name('create_client','create_client')->middleware('auth');
Route::post('/create-client-quote','QuotationsController@create_client_quotes')->name('create_client_quote','create_client_quote')->middleware('auth');
Route::get('/assessor-info','QuotationsController@assessor_info_auto')->name('assessor-info','assessor-info')->middleware('auth');
Route::get('/broker-info','QuotationsController@broker_info_auto')->name('broker-info','broker-info')->middleware('auth');
Route::get('/tow-info','QuotationsController@tow_info_auto')->name('tow-info','tow-info')->middleware('auth');
Route::get('/select-vehicle','QuotationsController@select_vehicle')->name('select-vehicle','select-vehicle')->middleware('auth');
Route::post('/new_client_qoutes','QuotationsController@new_client_qoutes')->name('new_client_qoutes','new_client_qoutes')->middleware('auth');
Route::post('/authorize-quote','QuotationsController@authorize_quote')->name('authorize_quote','authorize_quotes')->middleware('auth');
Route::post('/waste-quote','QuotationsController@waste_quote')->name('waste_quote','waste_quote')->middleware('auth');
Route::post('/agreed-quote','QuotationsController@agreed_quote')->name('agreed_quote','agreed_quote')->middleware('auth');
Route::post('/polish-quote','QuotationsController@polish_quote')->name('polish_quote','polish_quote')->middleware('auth');
Route::post('/unauthorize-quote','QuotationsController@unauthorize_quote')->name('unauthorize_quote','unauthorize_quotes')->middleware('auth');
Route::post('/unwaste-quote','QuotationsController@unwaste_quote')->name('unwaste_quote','unwaste_quote')->middleware('auth');
Route::post('/unagreed-quote','QuotationsController@unagreed_quote')->name('unagreed_quote','unagreed_quote')->middleware('auth');
Route::post('/unpolish-quote','QuotationsController@unpolish_quote')->name('unpolish_quote','unpolish_quote')->middleware('auth');
Route::get('/view-quote-money/{id}','QuotationsController@view_quote_money')->name('view_quote_money','view_quote_money')->middleware('auth');
Route::get('/view-proforma/{id}','QuotationsController@view_proforma')->name('view_proforma','view_proforma')->middleware('auth');
Route::get('/remove-track-photo/{id}','QuotationsController@remove_track_photo')->name('remove-track-photo','remove-track-photo')->middleware('auth');
Route::post('/proforma-save','QuotationsController@proforma_save')->name('proforma-save','proforma-save')->middleware('auth');
Route::post('/proforma-write-off','QuotationsController@proforma_write_off')->name('proforma-write-off','proforma-write-off')->middleware('auth');
Route::post('/proforma-write-off-remove','QuotationsController@proforma_write_off_remove')->name('proforma-write-off-remove','proforma-write-off-remove')->middleware('auth');
Route::get('/edit-client-details','QuotationsController@edit_client_quotes')->name('edit-client-details','edit-client-details')->middleware('auth');
Route::post('/save-quote-money','QuotationsController@save_quote_money')->name('save-quote-money','save-quote-money')->middleware('auth');
Route::get('/wip-sms/{id}','QuotationsController@wip_sms')->name('wip-sms','wip-sms')->middleware('auth');
Route::post('/covid-quote','QuotationsController@covid_quote')->name('covid-quote','covid-quote')->middleware('auth');
Route::post('/covid-unquote','QuotationsController@covid_unquote')->name('covid-unquote','covid-unquote')->middleware('auth');
Route::post('/quote-photo-email','Quotationscontroller@quote_photo_email')->name('quote-photo-email','quote-photo-email')->middleware('auth');
Route::post('/delete-quoted-photo','QuotationsController@delete_selected_photos')->name('delete-quoted-photo','delete-quoted-photo')->middleware('auth');
Route::post('/send-email-photo','QuotationsController@send_email_photo')->name('send-email-photo','send-email-photo')->middleware('auth');
Route::get('/get-photos-side','QuotationsController@get_photos_side')->name('get-photos-side','get-photos-side')->middleware('auth');
Route::get('/search-archive','QuotationsController@search_archive')->name('search-archive','search-archive')->middleware('auth');
Route::post('/create-insurer','QuotationsController@create_insurer')->name('create-insurer','create-insurer')->middleware('auth');
Route::get('/send-test','QuotationsController@send_sms')->name('send-test','send-test')->middleware('auth');
Route::post('/upload-quoted-photos','QuotationsController@upload_quoted_photos')->name('upload-quoted-photos','upload-quoted-photos')->middleware('auth');

Route::get('/delete-quotes','QuotationsController@delete_quotes')->name('delete-quotes','delete-quotes');

# [ ADD A NEW LINE QOUTE ]
Route::get('/qoutation-new-line','QuotationsController@add_new_line')->name('qoutation-new-line','qoutation-new-line')->middleware('auth');

# [ ADDED THE EDIT IN MONEY FUNCTIONALITY ]
Route::get('/editMoneyQuote','QuotationsController@edit_quote_money')->name('editMoneyQuote','editMoneyQuote')->middleware('auth');



//Final Stages
Route::get('/final-stage','FinalStageController@index')->name('final-stage','final-stage')->middleware('auth');
Route::get('/final-stage-client/{id}','FinalStageController@final_stage_client')->name('final-stage-client','final-stage-client')->middleware('auth');
Route::post('/update-final-parts','FinalStageController@update_final_parts')->name('update-final-parts','update-final-parts')->middleware('auth');
Route::post('/update-final-check','FinalStageController@update_final_check')->name('update-final-check','update-final-check')->middleware('auth');
Route::post('/update-final-markup-only','FinalStageController@update_final_markup_only')->name('update-final-markup-only','update-final-markup-only')->middleware('auth');

#Route::get('/update-final-markup','FinalStageController@update_final_markup')->name('update-final-markup','update-final-markup');
Route::post('/update-final-markup','FinalStageController@update_final_markup')->name('update-final-markup','update-final-markup')->middleware('auth');


Route::post('/update-final-betterment','FinalStageController@update_final_bettement')->name('update-final-betterment','update-final-betterment')->middleware('auth');
Route::post('/get-sundrie','FinalStageController@get_sundries')->name('get-sundrie','get-sundrie')->middleware('auth');
Route::post('/get-sundries','FinalStageController@get_sundries_')->name('get-sundries','get-sundries')->middleware('auth');
Route::post('/update-final-labour','FinalStageController@update_final_labour')->name('update-final-labour','update-final-labour')->middleware('auth');
Route::post('/update-final-consumable','FinalStageController@update_final_consumerables')->name('update-final-consumable','update-final-consumable')->middleware('auth');
Route::post('/update-final-consumables','FinalStageController@update_final_consumerables_')->name('update-final-consumables','update-final-consumables')->middleware('auth');
Route::post('/update-final-paint','FinalStageController@update_final_paint')->name('update-final-paint','update-final-paint')->middleware('auth');
Route::post('/update-final-waste','FinalStageController@update_final_waste')->name('update-final-waste','update-final-waste')->middleware('auth');
Route::post('/final-excess','FinalStageController@get_final_excess')->name('final-excess','final-excess')->middleware('auth');
Route::post('/get-final-excess','FinalStageController@get_final_excess_')->name('get-final-excess','get-final-excess')->middleware('auth');
Route::post('/get-final-discount','FinalStageController@get_final_discount')->name('get-final-discount','get-final-discount')->middleware('auth');
Route::post('/update-final-operate','FinalStageController@update_final_oper')->name('update-final-operate','update-final-operate')->middleware('auth');
Route::post('/update-final-desc','FinalStageController@update_final_desc')->name('update-final-desc','update-final-desc')->middleware('auth');
Route::post('/update-signed','FinalStageController@update_signed')->name('update-signed','update-signed')->middleware('auth');
Route::post('/update-unsigned','FinalStageController@update_unsigned')->name('update-unsigned','update-unsigned')->middleware('auth');
Route::get('/statements','FinalStageController@statements')->name('statements','statements')->middleware('auth');
Route::get('/final-pop','FinalStageController@pop')->name('final-pop','final-pop')->middleware('auth');
Route::get('/final-rfcs','FinalStageController@rfcs')->name('final-rfcs','final-rfcs')->middleware('auth');
Route::post('/update-closed','FinalStageController@update_closed_record')->name('upadate-closed','update-closed')->middleware('auth');
Route::get('/final-additional','FinalStageController@final_stage_additional')->name('final-stage-additional','final-stage-additional')->middleware('auth');
Route::get('/fetch-additionals','FinalStageController@fetch_additionals')->name('fetch-additionals','fetch-additionals')->middleware('auth');

#[ CURRENT UPDATE ]
Route::get('/fetch-additionals-grouped','FinalStageController@fetch_additionals_grouped')->name('fetch-additionals-grouped','fetch-additionals-grouped')->middleware('auth');
//fetch-additional-edits
Route::get('/fetch-additional-edits','FinalStageController@fetch_additional_edits')->name('fetch-additional-edits','fetch-additional-edits')->middleware('auth');
//update-additional
Route::post('/update-additional','FinalStageController@update_additional')->name('update-additional','update-additional')->middleware('auth');
//Route::get('/update-additional','FinalStageController@update_additional')->name('update-additional','update-additional')
//delete-additional
Route::get('/delete-additional/{id}','FinalStageController@delete_additional')->name('delete-additional','delete-additional')->middleware('auth');


Route::post('/final-stage-add-create','FinalStageController@final_stage_add_create')->name('final-stage-add-create','final-stage-add-create')->middleware('auth');
Route::post('/final-stage-send-email','FinalStageController@final_stage_send_email')->name('final-stage-send-email','final-stage-send-email')->middleware('auth');
Route::get('/final-docs','FinalStageController@final_docs')->name('final-docs','final-docs')->middleware('auth');
Route::get('/final-notes','FinalStageController@final_notes')->name('final-notes','final-notes')->middleware('auth');

Route::post('/final-discount-2' ,'FinalStageController@update_final_discount2')->name('final-discount-2','final-discount-2')->middleware('auth');
Route::post('/update-final-mark-up-2','FinalStageController@update_final_markup2')->name('update-final-mark-up-2','update-final-mark-up-2')->middleware('auth');
Route::get('/update-final-stage-vat','FinalStagecontroller@update_final_vat')->name('update-final-stage-vat','update-final-stage-vat')->middleware('auth');


#UPDATING THE ROUTE, FROM POST TO GET

Route::get('/final-stage-save-notes','FinalStageController@final_stage_save_notes')->name('final_stage_save_notes','final_stage_save_notes')->middleware('auth');

#PRINT WHEEL ALIGNMENT

Route::get('/final-stage-print-wheel-alignment/{id}','FinalStageController@print_wheel_alignment')->name('final-stage-print-wheel-alignment','final-stage-print-wheel-alignment')->middleware('auth');

Route::get('/final-stage-update-client','FinalStageController@final_stage_client_detail')->name('final-stage-update-client','final-stage-update-client')->middleware('auth');
Route::get('/final-stage-edit-client','FinalStageController@final_stage_client_edit')->name('final-stage-client-edit','final-stage-client-edit')->middleware('auth');
Route::get('/final-stage-wheel-alignment','FinalStageController@final_stage_wheel_alignment')->name('final-stage-wheel-alignment','final-stage-wheel-alignment')->middleware('auth');
Route::get('/final-stage-photos','FinalStageController@final_stage_photos')->name('final-stage-photos','final-stage-photos')->middleware('auth');
Route::get('/final-stage-ordering','FinalStageController@final_stage_ordering')->name('final-stage-ordering','final-stage-ordering')->middleware('auth');
Route::get('/final-stage-diagnostic' ,'FinalStageController@ddiagnostic')->name('final-stage-diagnostics','final-stage-diagnostics')->middleware('auth');
#LIVE
Route::get('/search-archive-final-stage','FinalStageController@search_archive_finalstage')->name('search-archive-final-stage','search-archive-final-stage')->middleware('auth');
//Oper list
Route::get('/fetch-oper-list','FinalStageController@fetch_oper_dropdown_list')->name('fetch-oper-list','fetch-oper-list')->middleware('auth');

# [ CURRENT LOAD ]
Route::get('/final-generate-rfc/{id}','FinalStageController@generate_rfc')->name('final-generate-rfc','final-generate-rfc')->middleware('auth');
Route::get('/final-stage-rate','FinalStageController@final_stage_rate')->name('final-stage-rate','final-stage-rate')->middleware('auth');

# [ CURRENT LOADED UPDATES ]
Route::post('/final-stage-save-wheel-alignment','FinalStageController@final_stage_save_wheel_alignment')->name('final-stage-save-wheel-alignment','final-stage-save-wheel-alignment')->middleware('auth');

# [ DATE: 25 MARCH 2021 ]
Route::get('/final-stage-email-photos','FinalStageController@email_photos')->name('final-stage-email-photos','final-stage-email-photos')->middleware('auth');

# [ DATE: 30 MARCH 2021 ]
Route::get('/final-original-landing-price','FinalStageController@update_landing_price')->name('final-original-landing-price','final-original-landing-price');

# [ DATE: 31 MARCH 2021 ] UPDATE ALL ADDITIONALS VALUES
# [ DESCRIPTION ]
Route::post('/update-additional-description','FinalStageController@update_additional_description')->name('update-additional-description','update-additional-description');

# [ OPERATION ]
Route::post('/update-additional-operation','FinalStageController@update_additional_operation')->name('update-additional-operation','update-additional-operation');

# [ LANDING PRICE ]
Route::post('/update-additional-landing-price','FinalStageController@update_additional_landing_price')->name('update-additional-landing-price','update-additional-landing-price');

# [ CHECKBOX LANGING PAGE ]
Route::post('/update-additional-landing-price-check','FinalStageController@update_additional_landing_price_check')->name('update-additional-landing-price-check','update-additional-landing-price-check');

# [ NETT + MARK + UP ]
Route::post('/update-additional-net-markup','FinalStageController@update_additional_net_markup')->name('update-additional-net-markup','update-additional-net-markup');

# [ MARK UP ONLY ]
Route::post('/update-additional-net-markup-only','FinalStageController@update_additional_net_markup_only')->name('update-additional-net-markup-only','update-additional-net-markup-only');

# [ BETTERMENT ]
Route::post('/update-additional-betterment','FinalStageController@update_additional_betterment')->name('update-additional-betterment','update-additional-betterment');


##[ OUTWORK | OUTWORK ]
## OUTWORK OUTPUT [ 01 MARCH 2021 ]

# LANDING PRICE 
Route::post('/update-additional-outwork-landing-price','FinalStageController@update_additional_outwork_landing_price')->name('update-additional-outwork-landing-price','update-additional-outwork-landing-price');



##[ INHOUSE | INHOUSE ]
## OUTWORK OUTPUT [ 01 MARCH 2021 ]

# LANDING PRICE
Route::post('/update-additional-inhouse-landing-price','FinalStageController@update_additional_inhouse_landing_price')->name('update-additional-inhouse-landing-price','update-additional-inhouse-landing-price');


##[ R + R | R + R ]
## R + R OUTPUT [ 01 MARCH 2021 ]

# LANDING PRICE
Route::post('/update-additional-rr-landing-price','FinalStageController@update_additional_rr_landing_price')->name('update-additional-rr-landing-price','update-additional-rr-landing-price');


##[ LABOUR | LABOUR ]
## LABOUR OUTPUT [ 01 MARCH 2021 ]

# LANDING PRICE
Route::post('/update-additional-labour-landing-price','FinalStageController@update_additional_labour_landing_price')->name('update-additional-labour-landing-price','update-additional-labour-landing-price');


##[ FRAME | FRAME ]
## FRAME OUTPUT [ 01 MARCH 2021 ]

# LANDING PRICE
//Route::post('/update-additional-labour-landing-price','FinalStageController@update_additional_labour_landing_price')->name('update-additional-labour-landing-price','update-additional-labour-landing-price');



##[ PAINT | PAINT ]
## PAINT OUTPUT [ 01 MARCH 2021 ]

# LANDING PRICE
Route::post('/update-additional-paint-landing-price','FinalStageController@update_additional_paint_landing_price')->name('update-additional-paint-landing-price','update-additional-paint-landing-price');

# UPDATE THE FINAL CLIENT DETAILS
Route::post('/update-final-client-details','FinalStageController@update_final_client_details')->name('update-final-client-details','update-final-client-details');



//Client
Route::get('/createClient','ClientController@create_client')->name('create_client','create_client')->middleware('auth');
Route::get('/editClient/{id}','ClientController@edit_client')->name('edit_client','edit_client')->middleware('auth');
Route::get('/client-rate/{id}','ClientController@client_rate')->name('client_rate','client_rate')->middleware('auth');
Route::get('/client-rate-edit','ClientController@client_rate_edit')->name('client_rate_edit','client_rate_edit')->middleware('auth');
Route::get('/client-document/{id}','ClientController@client_documents')->name('client_documents','client_documents')->middleware('auth');
Route::get('/client-notes/{id}','ClientController@client_notes')->name('client_notes','client_notes')->middleware('auth');
Route::post('/client-notes-add','ClientController@insert_client_notes')->name('client-note-add','client-note-add')->middleware('auth');
Route::get('/client-save-doc/{id}','ClientController@client_save_document')->name('client-save-doc','client-save-doc')->middleware('auth');
Route::get('/client-security-photos/{id}','ClientController@client_security_photos')->name('client-security-photos','client-security-photos')->middleware('auth');


//Double Cab Functions

Route::get('/doublecabdoor/{id}','DoubleCabController@frontdoor')->name('frontdoor','frontdoor')->middleware('auth');
Route::get('/doublecabreardoor/{id}','DoubleCabController@reardoor')->name('reardoor','reardoor')->middleware('auth');
Route::get('/doublecabfrontsuspension/{id}','DoubleCabController@frontsuspension')->name('frontsuspension','frontsuspension')->middleware('auth');
Route::get('/doublecabrearsuspension/{id}','DoubleCabController@rearsuspension')->name('rearsuspension','rearsuspension')->middleware('auth');
Route::get('/doublecabfrontbumper/{id}','DoubleCabController@frontbumper')->name('frontbumper','frontbumper')->middleware('auth');
Route::get('/doublecabrearbumper/{key_ref}','DoubleCabController@rearbumper')->name('rearbumper','rearbumper')->middleware('auth');
Route::get('/doublecabengine/{id}','DoubleCabController@engine')->name('engine','engine')->middleware('auth');
Route::get('/doublecabtranmission/{id}','DoubleCabController@transmission')->name('transmission','transmission')->middleware('auth');
Route::get('/doublecabAirConditioner/{id}','DoubleCabController@conditioner')->name('conditioner','conditioner')->middleware('auth');
Route::get('/doublecabDashboard/{id}','DoubleCabController@dashboard')->name('dashboard','dashboard')->middleware('auth');
Route::get('/doublecabFrontSeat/{id}','DoubleCabController@frontseat')->name('frontseat','frontseat')->middleware('auth');
Route::get('/doublecabRearSeat/{id}','DoubleCabController@rearseat')->name('rearseat','rearseat')->middleware('auth');
Route::get('/doublecabFuel/{id}','DoubleCabController@fuel')->name('fuel','fuel')->middleware('auth');
Route::get('/doublecabExhaust/{id}','DoubleCabController@exhaust')->name('exhaust','exhaust')->middleware('auth');
Route::get('/exterior/{id}','DoubleCabController@exterior')->name('exterior','exterior')->middleware('auth');


//Hatchback Functions
Route::get('/hatchback/{id}','HatchbackController@index')->name('hatch_exterior','hatch_exterior')->middleware('auth');
Route::get('/hatchbackfrontdoor/{id}','HatchbackController@frontdoor')->name('hatch_frontdoor','hatch_frontdoor')->middleware('auth');
Route::get('/hatchbackfrontbumper/{id}','HatchbackController@frontbumper')->name('hatch_frontbumper','hatch_frontbumper')->middleware('auth');
Route::get('/hatchbackreardoor/{id}','HatchbackController@reardoor')->name('hatch_reardoor','hatch_reardoor')->middleware('auth');
Route::get('/hatchbackrearbumper/{id}','HatchbackController@rearbumper')->name('hatch_rearbumper','hatch_rearbumper')->middleware('auth');
Route::get('/hatchbackfrontsuspension/{id}','HatchbackController@frontsuspension')->name('hatch_frontsuspension','hatch_frontsuspension')->middleware('auth');
Route::get('/hatchbackrearsuspension/{id}','HatchbackController@rearsuspension')->name('hatch_rearsuspension','hatch_rearsuspension')->middleware('auth');
Route::get('/hatchbackinterior/{id}','HatchbackController@interior')->name('hatch_interior','hatch_interior')->middleware('auth');
Route::get('/hatchbackfrontseat/{id}','HatchbackController@frontseat')->name('hatch_frontseat','hatch_frontseat')->middleware('auth');
Route::get('/hatchbackrearseat/{id}','HatchbackController@rearseat')->name('hatch_rearseat','hatch_rearseat')->middleware('auth');
Route::get('/hatchbackair/{id}','HatchbackController@aircooler')->name('hatch_aircooler','hatch_aircooler')->middleware('auth');
Route::get('/hatchbacExhaust/{id}','HatchbackController@exhaust')->name('hatch_exhaust','hatch_exhaust')->middleware('auth');
Route::get('/hatchbacFuel/{id}','HatchbackController@fuel')->name('hatch_fuel','hatch_fuel')->middleware('auth');
Route::get('/hatchbackTransmission/{id}','HatchbackController@transmission')->name('hatch_transmission','hatch_transmission')->middleware('auth');
Route::get('/hatchbackEngine/{id}','HatchbackController@engine')->name('hatch_engine','hatch_engine')->middleware('auth');
Route::get('/hatchbackDashboard/{id}','HatchbackController@dashboard')->name('hatch_dashboard','hatch_dashboard')->middleware('auth');


//Single Cab Functions
Route::get('/singlecab/{id}','SingleCabController@index')->name('singlecab','singlecab')->middleware('auth');
Route::get('/singlecabFuel/{id}','SingleCabController@fuel')->name('singlecab_fuel','singlecab_fuel')->middleware('auth');
Route::get('/singlecabFrontSeat/{id}','SingleCabController@frontseat')->name('singlecab_frontseat','singlecab_frontseat')->middleware('auth');
Route::get('/singlecabAirConditioner/{id}','SingleCabController@cooler')->name('singlecab_cooler','singlecab_cooler')->middleware('auth');
Route::get('/singlecabExhaust/{id}','SingleCabController@exhaust')->name('singlecab_exhaust','singlecab_exhaust')->middleware('auth');
Route::get('/singlecabdoor/{id}','SingleCabController@frontdoor')->name('singlecab_frontdoor','singlecab_frontdoor')->middleware('auth');
Route::get('/singlecabrearsuspension/{id}','SingleCabController@rearsuspension')->name('singlecab_rearsuspension','singlecab_rearsuspension')->middleware('auth');
Route::get('/singlecabtransmission/{id}','SingleCabController@transmission')->name('singlecab_transmission','singlecab_transmission')->middleware('auth');
Route::get('/singlecabFrontSuspension/{id}','SingleCabController@frontsuspension')->name('singlecab_frontsuspension','singlecab_frontsuspension')->middleware('auth');
Route::get('/singlecabDashboard/{id}','SingleCabController@dashboard')->name('singlecab_dashboard','singlecab_dashboard')->middleware('auth');
Route::get('/singlecabFrontBumper/{id}','SingleCabController@bumper')->name('singlecab_frontbumper','singlecab_frontbumper')->middleware('auth');
Route::get('/singlecabEngine/{id}','SingleCabController@engine')->name('singlecab_engine','singlecab_engine')->middleware('auth');

//2 Door Functions
Route::get('/2door/{id}','TwoDoorController@index')->name('2door_exterior','2door_exterior')->middleware('auth');
Route::get('/2doorFrontDoor/{id}','TwoDoorController@frontdoor')->name('2door_frontdoor','2door_frontdoor')->middleware('auth');
Route::get('/2doorAirConditioner/{id}','TwoDoorController@conditioner')->name('2door_aircondition','2door_aircondition')->middleware('auth');
Route::get('/2doorDashboard/{id}','TwoDoorController@dashboard')->name('2door_dashboard','2door_dashboard')->middleware('auth');
Route::get('/2doorEngine/{id}','TwoDoorController@engine')->name('2door_engine','2door_engine')->middleware('auth');
Route::get('/2doorFrontBumper/{id}','TwoDoorController@frontbumper')->name('2door_frontdoor','2door_frontdoor')->middleware('auth');
Route::get('/2doorRearBumper/{id}','TwoDoorController@rearbumper')->name('2door_rearbumper','2door_rearbumper')->middleware('auth');
Route::get('/2doorExhaust/{id}','TwoDoorController@exhaust')->name('2door_exhaust','2door_exhaust')->middleware('auth');
Route::get('/2doorFrontSuspension/{id}','TwoDoorController@frontsuspension')->name('2door_frontsuspension','2door_frontsuspension')->middleware('auth');
Route::get('/2doorTransmission/{id}','TwoDoorController@transmission')->name('2door_transmission','2door_transmission')->middleware('auth');
Route::get('/2doorRearSuspension/{id}','TwoDoorController@rearsuspension')->name('2door_rearsuspension','2door_rearsuspension')->middleware('auth');
Route::get('/2doorFuel/{id}','TwoDoorController@fuel')->name('2door_fuel','2door_fuel')->middleware('auth');
Route::get('/2doorFrontSeat/{id}','TwoDoorController@frontseat')->name('2door_frontseat','2door_frontseat')->middleware('auth');
Route::get('/2doorRearSeat/{id}','TwoDoorController@rearseat')->name('2door_rearseat','2door_rearseat')->middleware('auth');
Route::get('/2doorInterior/{id}','TwoDoorController@interior')->name('2door_interior','2door_interior')->middleware('auth');

//Line Manager Functions
Route::get('/line-manager','LineManagerController@index')->name('line-manager','line-manager');
Route::get('/line-manager-timesheet','LineManagerController@timesheet')->name('line-manager-timesheet','line-manager-timesheet');
Route::get('/line-manager-general','LineManagerController@general_work')->name('line-manager-general','line-manager-general');
Route::get('/line-manager-workshop','LineManagerController@workshop')->name('line-manager-workshop','line-manager-workshop');
Route::get('/line-manager-analysis','LineManagerController@labours')->name('line-manager-labor','line-manager-labor');
Route::get('/line-manager-print','LineManagerController@print')->name('line-manager-print','line-manager-print');
Route::get('/line-manager-analysis-view/{id}','LineManagerController@labours_details')->name('line-manager-analysis-view','line-manager-analysis-view');
Route::get('/line-manager-sms/{id}','LineManagerController@sms_customer')->name('line-manager-sms','line-manager-sms');
Route::get('/line-manager-notes/{id}','LineManagerController@line_manager_notes')->name('line-manager-notes','line-manager-notes');
Route::get('/line-manager-photos/{id}','LineManagerController@line_manager_photos')->name('line-manager-photos','line-manager-photo');
Route::post('/line-manager-upload','LineManagerController@line_manager_upload')->name('line-manager-upload','line-manager-upload');
Route::get('/line-manager-delete/{id}','LineManagerController@line_manger_delete_photo')->name('line-manager-delete','line-manager-delete');
Route::get('/line-manager-docs/{id}','LineManagerController@line_manager_docs')->name('line-manager-docs','line-manager-docs');
Route::post('/line-manager-upload-doc','LineManagerController@line_manager_docs_upload')->name('line-manager-doc-upload','line-manager-doc-upload');
Route::post('/line-manager-security-upload','LineManagerController@line_manager_security_upload')->name('line-manager-security-upload','line-manager-security-upload');
Route::get('/line-manager-security-delete/{id}','LineManagerController@security_delete')->name('line-manager-security-delete','line-manager-security-delete');
Route::post('/line-manager-additional-quotes','LineManagerController@additional_quote')->name('line-manager-additional-quotes','line-manager-additional-quotes');
Route::post('/line-manager-additional-photo-upload','LineManagerController@line_manager_upload_photo_additional')->name('line-manager-additional-photo-upload','line-manager-additional-photo-upload');
Route::post('/line-manager-upload-photo-wip','LineManagerController@line_manager_upload_photo_wip')->name('line-manager-upload-photo-wip','line-manager-upload-photo-wip');
Route::get('/line-manager-employees','LineManagerController@get_all_users')->name('line-manager-employees','line-manager-employees');
Route::post('/line-manger-worker-timesheet','LineManagerController@worker_timesheet')->name('line-manger-worker-timesheet','line-manger-worker-timesheet');
Route::get('/search-archive-labor','LineManagerController@search_archieve_labours')->name('search-archive-labor','search-archive-labor');
Route::get('/line-manager-wip','LineManagerController@search_report')->name('line-manager-wip','line-manager-wip');
Route::post('/line-manager-wip-upload','LineManagerController@line_manager_wip_upload')->name('line-manager-wip-upload','line-manager-wip-upload');
# [ CUREENT LOADED UPDATES ]
Route::post('/line-manager-upload-photo-final-stage','LineManagerController@line_manager_upload_photo_final_stage')->name('line-manager-upload-photo-final-stage','line-manager-upload-photo-final-stage');


//Driver Module
Route::get('/driver-current-location','DriverController@current_location')->name('driver-current-location','driver-current-location')->middleware('auth');
Route::get('/driver-new-location/{id}','DriverController@new_location')->name('driver-new-location','driver-new-location');
Route::post('/driver-create-location','DriverController@create_new_location')->name('driver-create-location','driver-create-location');
Route::get('/driver-cancel-trip','DriverController@cancel_trip')->name('driver-cancel-trip','driver-cancel-trip');

//Consumerables
Route::get('/consumerables','ConsumerablesController@index')->name('consumerables','consumerables');
Route::get('/consumerable-stock','ConsumerablesController@stock')->name('consumerable-stock','consumerable-stock');
Route::get('/consumerable-compare','ConsumerablesController@comparison')->name('consumerable-compare','consumerable-compare');
Route::get('/consumerable-supplier','ConsumerablesController@supplier')->name('consumerable-supplier','consumerable-supplier');
Route::get('/consumerable-supplier-edit','ConsumerablesController@edit_supplier')->name('consumerable-supplier-edit','consumerable-supplier-edit');
Route::post('/consumerable-supplier-create','ConsumerablesController@create_supplier')->name('consumerable-supplier-create','consumerable-supplier-create');
Route::get('/consumerable-stock-add','ConsumerablesController@add_supplies')->name('consumerable-stock-add','consumerable-stock-add');
Route::get('/consumerable-stock-subtract','ConsumerablesController@subtract_supplies')->name('consumerable-stock-subtract','consumerable-stock-subtract');
Route::get('/comsumerable-order-stock','ConsumerablesController@order_stock')->name('consumerable-order-stock','consumerable-order-stock');
Route::post('/consumerable-create-orders','ConsumerablesController@consumerable_create_orders')->name('consumerable-create-orders','consumerable-create-orders');
Route::get('/consumerable-order-list/{id}','ConsumerablesController@edit_order_stock')->name('consumerable-order-list','consumerable-order-list');
Route::get('/consumerable-order-list-remove/{id}','ConsumerablesController@remove_order_stock')->name('consumerable-order-remove','consumerable-order-remove');
Route::post('/consumerable-order-list-add','ConsumerablesController@add_order_stock')->name('consumerable-order-add','consumerable-order-add');
Route::get('/consumerable-invoice','ConsumerablesController@invoice')->name('consumerables-invoice','consumerables-invoice');
Route::get('/consumerable-orderlist-add','ConsumerablesController@add_to_order')->name('consumerable-orderlist-add','consumerable-orderlist-add');
Route::post('/consumerable-create-order','ConsumerablesController@create_stock')->name('consumerable-create-order','consumerable-create-order');
Route::get('/consumerable-email','ConsumerablesController@send_email')->name('consumerable-email','consumerable-email');
Route::post('/consumerable-upload','ConsumerablesController@save_invoice_doc')->name('consumerable-upload','consumerable-upload');
Route::get('/consumerable-inventory-stock','ConsumerablesController@inventory_stock')->name('inventory-stock','inventory-stock');
Route::get('/consumerable-inventory-branch/{id}','ConsumerablesController@inventory_branch')->name('inventory-branch','inventory-branch');
Route::post('/consumerable-add-new-inventory','ConsumerablesController@add_new_inventory')->name('add-new-inventory','add-new-inventory');
Route::get('/consumer-inventory-equipment-save','ConsumerablesController@consumer_inventory_equipment_save')->name('consumer-inventory-equipment-save','consumer-inventory-equipment-save');
Route::post('/consumer-inventory-equipment-sell','ConsumerablesController@consumer_inventory_equipment_sell')->name('consumer-inventory-equipment-sell','consumer-inventory-equipment-sell');
Route::get('/consumer-inventory-paint-save','ConsumerablesController@consumer_inventory_paint_save')->name('consumer-inventory-paint-save','consumer-inventory-paint-save');

#UPDATED THE METHODS
Route::get('/consumer-parts-requesation','ConsumerablesController@consumer_parts_requesation')->name('consumer-parts-requesation','consumer-parts-requesation');
Route::get('/comsumer-requesation-status','ConsumerablesController@requesation_status')->name('comsumer-requesation-status','comsumer-requesation-status');

//Route::post('/consumer-requesation-close','ConsumerablesController@requesation_close')->name('consumer-requesation-close','consumer-requesation-close');
Route::get('/consumer-requesation-close','ConsumerablesController@requesation_close')->name('consumer-requesation-close','consumer-requesation-close');
Route::get('/consumerable_approve_items_status','ConsumerablesController@approve_items_status')->name('consumerable_approve_items_status','consumerable_approve_items_status');
#LIVE



//Customer Care
Route::get('/customer-care','CustomerCareController@index')->name('customer-care','customer-care');
Route::get('/customer-care-release/{id}','CustomerCareController@release_car')->name('customer-care-release','customer-care-release');
Route::post('/customer-care-note','CustomerCareController@note')->name('customer-care-note','customer-care-note');
Route::get('/customer-care-edit','CustomerCareController@edit_client')->name('customer-care-edit','customer-care-edit');
Route::get('/customer-care-edit-update','CustomerCareController@edit_feedback_notes')->name('customer-care-edit-feedback','customer-care-edit-feedback');
Route::get('/customer-wip','CustomerCareController@customer_wip')->name('customer-wip','customer-wip');
Route::get('/customer','CustomerCareController@customers')->name('customer','customer');
Route::get('/customer-care-clients','CustomerCareController@client_details')->name('customer-care-clients','customer-care-clients');
Route::get('/customer-care-client-details/{id}','CustomerCareController@view_client_details')->name('customer-care-client-details','customer-care-client-details');
Route::post('/customer-care-save','CustomerCareController@save_customer')->name('customer-care-save','customer-care-save');
Route::post('/customer-care-send-sms','CustomerCareController@customer_care_send_sms')->name('customer-care-send-sms','customer-care-send-sms');
Route::get('/customer-care-security-photo','CustomerCareController@customer_care_security_photo')->name('customer-care-security-photo','customer-care-security-photo');
Route::get('/customer-care-add-photo','CustomerCareController@customer_care_additional_photo')->name('customer-care-add-photo','customer-care-add-photo');
Route::get('/customer-care-wip-photo','CustomerCareController@customer_care_wip_photo')->name('customer-care-wip-photo','customer-care-wip-photo');
Route::get('/customer-care-final-stage-photo','CustomerCareController@customer_care_final_stage_photo')->name('customer-care-final-stage-photo','customer-care-final-stage-photo');
Route::get('/customer-care-documents','CustomerCareController@customer_care_documents')->name('customer-care-documents','customer-care-documents');
Route::post('/customer-care-save-note','CustomerCareController@customer_care_save_note')->name('customer-care-save-note','customer-care-save-note');
Route::post('/customer-care-save-document','CustomerCareController@customer_care_save_document')->name('customer-care-save-document','customer-care-save-document');
Route::get('/customer-care-doc-type','CustomerCareController@customer_care_doc_type')->name('customer-care-doc-type','customer-care-doc-type');
Route::get('/customer-care-create-note','CustomerCareController@customer_care_create_note')->name('customer-care-create-note','customer-care-create-note');
Route::get('/customer-care-search','CustomerCareController@search_archive')->name('customer-care-search','customer-care-search');
Route::get('/customer-care-create-note','CustomerCareController@create_notes')->name('customer-care-create-note','customer-care-create-note');
Route::get('/customer-care-archieve','CustomerCareController@care_archieve')->name('customer-care-archieve','customer-care-archieve');


//Creditors
Route::get('/creditors','CreditorsController@index')->name('creditors','creditors');
Route::get('/creditor/{id}','CreditorsController@supplier_info')->name('creditors-info','creditors-info');
Route::post('/creditor-docs','CreditorsController@save_document')->name('creditors-docs','creditors-docs');
Route::get('/creditor-filter','CreditorsController@filter')->name('creditors-filter','creditors-filter');
Route::post('/creditor-statement','CreditorsController@save_statement_doc')->name('creditor-statement','creditor-statement');
Route::post('/creditor-proof','CreditorsController@save_proof_doc')->name('creditor-proof','creditor-proof');
Route::post('/creditor-supplier-rfcs','CreditorsController@save_supplier_rfcs')->name('creditor-supplier-rfcs','creditor-supplier-rfcs');
Route::post('/creditors-invoice','CreditorsController@save_supplier_invoices')->name('creditors-invoice','creditors-invoice');
Route::get('/creditors-supplier-invo','CreditorsController@creditiors_supplier_invoices')->name('creditors-supplier-invo','creditors-supplier-invo');


//Parts 
Route::get('/parts','PartsController@index')->name('parts','parts');
Route::get('/additionals','PartsController@additional')->name('additional','additional');
Route::get('/pre-costing','PartsController@precosting')->name('pre-costing','pre-costing');
Route::get('/stores','PartsController@stores')->name('stores','stores');
Route::get('/view-precosting/{id}','PartsController@view_precosting')->name('view-precosting','view-precosting');
Route::post('/save-docs-precosting','PartsController@precosting_docs_upload')->name('save-docs-precosting','save-docs-precosting');
Route::get('/delete-docs-precosting/{id}','PartsController@precosting_docs_delete')->name('delete-docs-precosting','delete-docs-precosting');
Route::post('/pre-costing-additionals','PartsController@precosting_additional')->name('pre-costing-additionals','pre-costing-additionals');
Route::post('/pre-costing-additionals-edit','PartsController@precost_addition_edit')->name('pre-costing-additionals-edit','pre-costing-additionals-edit');
Route::get('/pre-costing-suppliers','PartsController@get_suppliers')->name('pre-costing-suppliers','pre-costing-suppliers');
Route::post('/pre-costing-landing','PartsController@landing_cost')->name('pre-costing-landing','pre-costing-landing');
Route::get('/parts-check-otp','PartsController@otp_check')->name('parts-check-otp','parts-check-otp');


#TUESDAY MY BOI
#ADD THE ADDITIONALS OTP  [ 11 MAY 2021 ]
Route::get('/additional-order-otp','PartsController@otp_show_additional_order')->name('additional-order-otp','additional-order-otp');

Route::get('/pre-costing-additional-order','PartsController@additional_orders')->name('pre-costing-additional-order','pre-costing-additional-order');


#REDO ROUTE [  ]
//Route::post('/pre-costing-order','PartsController@orders')->name('pre-costing-order','pre-costing-order');
Route::get('/pre-costing-order','PartsController@orders')->name('pre-costing-order','pre-costing-order');
Route::get('/pre-costing-order_store','PartsController@store_orders')->name('pre-costing-order_store','pre-costing-order_store');


Route::get('/pre-costing-order-email/{id}','PartsController@order_send_email')->name('pre-costing-order-email','pre-costing-order-email');
Route::get('/pre-costing-order-email-delete/{id}','PartsController@delete_order_email')->name('pre-costing-order-email-delete','pre-costing-order-email-delete');
Route::post('/pre-costing-create-supplier','PartsController@create_supplier')->name('pre-costing-create-supplier','pre-costing-create-supplier');
Route::get('/pre-costing-get-order-parts','PartsController@get_order_parts')->name('pre-costing-get-order-parts','pre-costing-get-order-parts');
Route::get('/pre-costing-create-credit-note','PartsController@credit_notes')->name('pre-costing-create-credit-note','pre-costing-create-credit-note');
Route::get('/search-archive-precosting','PartsController@search_archive_precosting')->name('search-archive-precosting','search-archive-precosting');

#Route::get('/pre-costing-get-part-quantity','PartsController@get_quantity')->name('pre-costing-get-part-quantity','pre-costing-get-part-quantity');

#WILL SAVE FIRST AND PRINT FUNCTION
#Route::get('/pre-costing-get-part-quantity','PartsController@get_quantity')->name('pre-costing-get-part-quantity','pre-costing-get-part-quantity');
Route::get('/print-parts-credit','PartsController@print_credit_parts')->name('print-parts-credit','print-parts-credit');
Route::get('/print-save-parts-credit','PartsController@save_credit_parts')->name('print-save-parts-credit','print-save-parts-credit');
#LIVE



//Print PDF Functions
Route::get('/printQuote/{id}','PrintController@printQuote')->name('printQuote','printQuote');
Route::get('/moneyQuote/{id}','PrintController@printQuoteMoney')->name('moneyQuote','moneyQuote');
Route::get('/printSalvage','PrintController@printSalvage')->name('printSalvage','printSalvage');
Route::get('/printAssessor','PrintController@print_assessors')->name('print_assessor','print_assessor');
Route::get('/printPreBooking','PrintController@print_prebookings')->name('print_prebooking','print_prebooking');
Route::get('/print-client-note/{id}','PrintController@print_client_notes')->name('print_notes','print_notes');
Route::get('/print-stock-order/{id}','PrintController@print_stock_order')->name('print_stock_order','print_stock_order');
Route::get('/print-line-manager/{id}','PrintController@print_line_manager')->name('print-timesheet','print-timesheet');
Route::get('/print-line-manager-notes/{id}','PrintController@print_line_manager_note')->name('print_line_manager_note','print_line_manager_note');
Route::get('/invoice/{id}/{date}/{inv}','PrintController@print_invoice')->name('print_invoice','print_invoice');
Route::get('/history/{id}/{date}/{credit}','PrintController@print_history')->name('print_history','print_history');
Route::get('/print-customer-feedback','PrintController@print_customer_feedback')->name('print-customer-feedback','print-customer-feedback');
Route::get('/print-branch-statement','PrintController@print_statement')->name('print-branch-statement','print-branch-statement');
Route::get('/print-proforma-invoice/{id}','PrintController@print_proforma_invoice')->name('print-proforma-invoice','print-proforma-invoice');
Route::get('/print-agreed-time/{id}','PrintController@agreed_time_quote')->name('print-agreed-time','print-agreed-time');
Route::get('/print-agreed-money/{id}','PrintController@agreed_money_quote')->name('print-agreed-money','print-agreed-money');
Route::get('/print-auth-money/{id}','PrintController@auth_money_quote')->name('print-auth-money','print-auth-money');
Route::get('/print-auth-time/{id}','PrintController@auth_time_quote')->name('print-auth-time','print-auth-time');
Route::get('/print-final-notation/{id}','PrintController@final_notation')->name('print-final-notation','print-final-notation');
Route::get('/print-final-costing-total/{id}','PrintController@final_costing_total')->name('print-final-costing-total','print-final-costing-total');
Route::get('/print-final-costing-no-extra/{id}','PrintController@final_costing_no_extra')->name('print-final-no-extra','print-final-no-extra');
Route::get('/print-final-costing-all-figure/{id}','PrintController@final_costing_all_figure')->name('print-final-all-figure','print-final-all-figure');
Route::get('/print-time-sheet/{id}','PrintController@timesheet_labour')->name('print-timesheet','print-timesheet');
Route::get('/print-release-register','PrintController@release_vehicle')->name('print-release-register','print-release-register');
Route::get('/print-client-invoice/{id}','PrintController@invoice_client')->name('print-client-invoice','print-client-invoice');
Route::get('/print-clearance-certificate/{id}','PrintController@clearance_certificate')->name('print-clearance-certificate','print-clearance-certificate');
Route::get('/print-non-approved-repair','PrintController@non_approved_repair')->name('print-non-approved-repair','print-non-approved-repair');
Route::get('/print-security-checklist/{id}','PrintController@security_check')->name('print-security-checklist','print-security-checklist');
Route::get('/print-release-payment/{id}','PrintController@release_payment')->name('print-release-payment','print-release-payment');
Route::get('/print-taxi-clearance/{id}','PrintController@taxi_clearance')->name('print-taxi-clearance','print-taxi-clearance');
Route::get('/print-old-mutual/{id}','PrintController@old_mutual')->name('print-old-mutual','print-old-mutual');
Route::post('/print-create-invoice','PrintController@customer_care_invoice')->name('print-create-invoice','print-create-invoice');
Route::get('/print-order','PrintController@print_order')->name('print-order','print-order');
Route::get('/print-pre-costing/{id}','PrintController@print_precosting')->name('print-pre-costing','print-pre-costing');
Route::get('/print-non-approved-part/{id}','PrintController@print_non_approved_part')->name('print-non-approved-part','print-non-approved-part');
Route::get('/print-stores-rfc/{id}','PrintController@print_stores_rfc')->name('print-stores-rfc','print-stores-rfc');
Route::get('/print-job-card/{id}','PrintController@print_job_card')->name('print-job-card','print-job-card');
Route::get('/print-billing-history','PrintController@print_billing_history')->name('print-billing-history','print-billing-history');
Route::get('/print-itemized/{id}','PrintController@print_itemised')->name('print-itemized','print-itemized');
Route::get('/print-consumables/{id}','PrintController@print_consumables')->name('print-consumables','print-consumables');
Route::get('/print-tools-purchase/{id}','PrintController@print_tools_purchase')->name('print-tools-purchase','print-tools-purchase');
Route::get('/print-non-approved-part/{id}','PrintController@print_approved_part')->name('print-non-approved-part','print-non-approved-part');
Route::get('/print-all-parts-list/{id}','PrintController@print_all_parts_list')->name('print-all-parts-list','print-all-parts-list');
Route::get('/print-employee-timesheet/{user}/{from}/{to}','PrintController@print_employee_timesheet')->name('print-employee-timesheet','print-employee-timesheet');
Route::get('/print-wip-report','PrintController@print_wip_report')->name('print-wip-report','print-wip-report');
Route::get('/print-tax-invoice','PrintController@print_client_invoice')->name('print-tax-invoice','print-tax-invoice');

#PRINT OUT [ 17 MAY 2021 ] 
Route::get('/print-suppliers','PrintController@print_suppliers')->name('print-suppliers','print-suppliers');

#PRINT INPUT AND OUTPUT [ 18 MAY 2021 ] 
//Route::get('/print-input-and-output','PrintController@print_input_and_output')->name('print-input-and-output','print-input-and-output');
Route::post('/print-input-and-output','PrintController@print_input_and_output')->name('print-input-and-output','print-input-and-output');


#ADD THE ROUTE TO PRINT ADDITIONAL  [ print-final-additonal-no-extra ]
Route::get('/print-final-additonal/{id}','PrintController@print_additionals')->name('print-final-additonal','print-final-additonal');
Route::get('/print-final-additonal-all-figure/{id}','PrintController@print_additionals')->name('print-final-additonal-all-figure','print-final-additonal-all-figure');
Route::get('/print-final-additonal-no-extra/{id}','PrintController@print_additionals')->name('print-final-additonal-no-extra','print-final-additonal-no-extra');

# [ CURRENT LOADED UPDATES ]
Route::post('/print-and-email-notification/{id}','PrintController@print_and_email_notification')->name('print-and-email-notification','print-and-email-notification');

# [ CURRENT LOADED UPDATES ]
Route::post('/print-notification/{id}','PrintController@print_notification')->name('print-notification','print-notification');

Route::get('/print-covid-report','PrintController@print_covid_report')->name('print-covid-report','print-covid-report');
Route::get('/print-covid-report-all-users','PrintController@print_covid_report_all')->name('print-covid-report-all-users','print-covid-report-all-users');
Route::get('/print-prebooking/{id}','PrintController@print_prebooking')->name('print-prebooking','print-prebooking');


//Super Admin
Route::get('/administrator','AdministratorController@index')->name('administrator','administrator');
Route::get('/users','AdministratorController@users')->name('users','users');
Route::get('/user-delete/{id}','AdministratorController@user_delete')->name('users-delete','users-delete');
Route::post('/user-create','AdministratorController@create_user')->name('user-create','user-create');
Route::get('/user-edit','AdministratorController@edit_user')->name('user-edit','user-edit');
Route::get('/billing','AdministratorController@billing')->name('billing','billing');
Route::get('/statement','AdministratorController@statement' )->name('statement','statement');
Route::get('/ais','AdministratorController@ais_user')->name('ais-user','ais-user');
Route::get('/ais-delete/{id}','AdministratorController@ais_user_delete')->name('ais-delete','ais-delete');
Route::post('/ais-create','AdministratorController@ais_create_user')->name('ais-create','ais-create');
Route::get('/ais-edit','AdministratorController@ais_edit_user')->name('ais-edit','ais-edit');
Route::get('/ais-account-setting','AdministratorController@ais_account_settings')->name('ais_account_setting','ais_account_setting');
Route::post('/ais-create-branch','AdministratorController@create_branch')->name('ais-create-branch','ais-create-branch');
Route::get('/ais-add-credits','AdministratorController@ais_credits')->name('ais-add-credits','ais-add-credits');
Route::get('/ais-stats','AdministratorController@graphs')->name('ais-stats','ais-stats');
Route::get('/ais-sla-ratings','AdministratorController@sla_ratings')->name('ais-sla-ratings','ais-sla-ratings');
Route::get('/ais-sla-ratings-edit/{id}','AdministratorController@sla_ratings_edit')->name('ais-sla-ratings-edit','ais-sla-ratings-edit');
Route::get('/covid-register','AdministratorController@covid_register')->name('covid-register','covid-register');

//Send SMS
Route::get('/sendsms','SendSmsController@send_sms_linemanger');


//System Wide
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout','logout');
Route::get('/user','HomeController@users')->name('user','user');
Route::get('/change-repairer','HomeController@change_repairer')->name('change-repairer','change-repairer');
Route::get('/change-name-surname','HomeController@change_name_surname')->name('change-name-surname','change-name-surname');
Route::get('/change-reg','HomeController@change_reg')->name('change-reg','change-reg');
Route::get('/change-model','HomeController@change_model')->name('change-model','change-model');
Route::get('/change-assessor','HomeController@change_assessor')->name('change-assessor','change-assessor');
Route::get('/change-claim-no','HomeController@change_claim_no')->name('change-claim-no','change-claim-no');
Route::get('/change-final-date','HomeController@change_final_date')->name('change-final-date','change-final-date');