<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//main routes
$routes->get('index/', 'Main::index');
$routes->get('main/get_banner', 'Main::get_banner');


$routes->add('get/main/(:any)', 'Main::get_record/$1');
$routes->add('main/add_fav/list', 'Main::add_fav/list');
$routes->add('main/remove_job_post/list', 'Main::remove_job_post/list');
//end main routes

//Home
$routes->add('home/submit_data', 'Home::submit_data');
$routes->add('home/change_password', 'Home::change_password');
//end Home


//schedule routes
$routes->add('schedule/add/(:any)', 'Schedule_vw::index/add/$1');
$routes->add('schedule/edit/(:any)', 'Schedule_vw::index/edit/$1');
$routes->add('schedule/view/(:any)', 'Schedule_vw::index/view/$1');


$routes->add('schedule/load_data/(:any)', 'Schedule_vw::load_data/$1');
$routes->add('schedule/system_notes', 'Schedule_vw::system_notes_list');
$routes->add('schedule/submit_data', 'Schedule_vw::submit_data');
$routes->add('schedule/process_invitation', 'Schedule_vw::process_invitation');

$routes->add('schedule', 'Schedule::index');
$routes->add('get/schedule/(:any)', 'Schedule::get_record/$1');
$routes->add('schedule/add_fav/list', 'Schedule::add_fav/list');
$routes->add('schedule/cancel_schedule/list', 'Schedule::cancel_schedule/list');
//end schedule routes

//compare applicant routes
$routes->add('compare_applicant', 'Compare_applicant::index');
$routes->add('get/compare_applicant/(:any)', 'Compare_applicant::get_record/$1');
$routes->add('compare_applicant/add_fav/list', 'Compare_applicant::add_fav/list');
$routes->add('compare_applicant/cancel_schedule/list', 'Compare_applicant::cancel_schedule/list');
$routes->add('compare_applicant/get_job_post_list', 'Compare_applicant::get_job_post_list');
$routes->add('compare_applicant/get_applicant_list', 'Compare_applicant::get_applicant_list');
$routes->add('compare_applicant/get_master_data', 'Compare_applicant::get_master_data');
//end compare applicant routes


//closed jobs
$routes->add('closed_jobs', 'Closed_jobs::index');
$routes->add('get/closed_jobs/(:any)', 'Closed_jobs::get_record/$1');
$routes->add('closed_jobs/add_fav/list', 'Closed_jobs::add_fav/list');
$routes->add('closed_jobs/remove_job_post/list', 'Closed_jobs::remove_job_post/list');
//end closed jobs

//deactivated jobs
$routes->add('deactivated_jobs', 'Deactivated_jobs::index');
$routes->add('get/deactivated_jobs/(:any)', 'Deactivated_jobs::get_record/$1');
$routes->add('deactivated_jobs/add_fav/list', 'Deactivated_jobs::add_fav/list');
$routes->add('deactivated_jobs/remove_job_post/list', 'Deactivated_jobs::remove_job_post/list');
//end deactivated jobs

//insight
$routes->add('Insights', 'Insight::index');
$routes->add('get/insight/(:any)', 'Insight::get_record/$1');
$routes->add('insight/add_fav/list', 'Insight::add_fav/list');
$routes->add('insight/remove_job_post/list', 'Insight::remove_job_post/list');
//end insight

//insight all
$routes->add('insight_all', 'Insight_all::index');
$routes->add('get/insight_all/(:any)', 'Insight_all::get_record/$1');
//end insight all

//active jobs
$routes->add('active_jobs', 'Active_jobs::index');
$routes->add('get/active_jobs/(:any)', 'Active_jobs::get_record/$1');
$routes->add('active_jobs/add_fav/list', 'Active_jobs::add_fav/list');
$routes->add('active_jobs/remove_job_post/list', 'Active_jobs::remove_job_post/list');
//end active jobs

//active jobs applicant
$routes->add('active_jobs_applicant', 'Active_jobs_applicant::index');
$routes->add('get/active_jobs_applicant/(:any)', 'Active_jobs_applicant::get_record/$1');
$routes->add('active_jobs_applicant/save_profile/list', 'Active_jobs_applicant::save_profile/list');

//$routes->add('active_jobs_applicant/view/(:any)', 'Applicant_search_vw::index/view/$1');
//end active jobs applicant

//all jobs applicant
$routes->add('all_jobs_applicant', 'All_jobs_applicant::index');
$routes->add('get/all_jobs_applicant/(:any)', 'All_jobs_applicant::get_record/$1');
$routes->add('all_jobs_applicant/save_profile/list', 'All_jobs_applicant::save_profile/list');
//$routes->add('active_jobs_applicant/view/(:any)', 'Applicant_search_vw::index/view/$1');
//end all jobs applicant

//applicant search
$routes->add('applicant_search/private', 'Applicant_search::index/private');
$routes->add('get/applicant_search/(:any)', 'Applicant_search::get_record/$1');
$routes->add('applicant_search/add_fav/list', 'Applicant_search::add_fav/list');
$routes->add('applicant_search/view/applied/(:any)', 'Applicant_search_vw::index/view/applied/$1');
$routes->add('applicant_search/view/napplied/(:any)', 'Applicant_search_vw::index/view/napplied/$1');
$routes->add('applicant_search/load_data/(:any)', 'Applicant_search_vw::load_data/$1');
$routes->add('applicant_search/submit_data', 'Applicant_search_vw::submit_data');
$routes->add('applicant_search/check_interview', 'Applicant_search_vw::check_interview');
//end applicant search


//talent database
$routes->add('talent_database/view/(:any)', 'Talent_database_vw::index/view/$1');
$routes->add('talent_database/load_data/(:any)', 'Talent_database_vw::load_data/$1');
$routes->add('talent_database/submit_data', 'Talent_database_vw::submit_data');
$routes->add('talent_database/get_job_post/(:any)', 'Talent_database_vw::get_job_post/$1');
$routes->add('talent_database/invite_to_job/list', 'Talent_database_vw::invite_to_job/list');
//end talent database

//saved profile search
$routes->add('saved_profile', 'Saved_profile::index');
$routes->add('get/saved_profile/(:any)', 'Saved_profile::get_record/$1');
$routes->add('saved_profile/add_fav/list', 'Saved_profile::add_fav/list');
//end saved profile search

//job_search
//$routes->add('job_search/private/add/(:any)', 'Job_search_vw::index/private/add/$1');
//$routes->add('job_search/private/edit/(:any)', 'Job_search_vw::index/private/edit/$1');
$routes->add('job_search/private/view/(:any)', 'Job_search_vw::index/private/view/$1');

$routes->add('job_search/public', 'Job_search::index/public');
$routes->add('job_search/private', 'Job_search::index/private');

$routes->add('get/job_search/(:any)', 'Job_search::get_record/$1');
//$routes->add('get/master_data/(:any)', 'Job_search::get_master_data/$1');
$routes->add('job_search/add_fav/list', 'Job_search::add_fav/list');

$routes->add('job_search/load_data/(:any)', 'Job_search_vw::load_data/$1');
$routes->add('job_search/do_upload', 'Job_search_vw::do_upload');
$routes->add('job_search/do_upload_multiple', 'Job_search_vw::do_upload_multiple');
$routes->add('job_search/submit_data', 'Job_search_vw::submit_data');
$routes->add('job_search/add_fav', 'Job_search_vw::add_fav');
$routes->add('job_search/report_job_post', 'Job_search_vw::report_job_post');
//end job_search

//job application
$routes->add('job_application/private/view/(:any)', 'Job_search_vw::index/private/view/$1');
$routes->add('job_application/(:any)', 'Job_application::index/$1');
$routes->add('get/job_application/(:any)', 'Job_application::get_record/$1');
//$routes->add('get/master_data/(:any)', 'Job_application::get_master_data/$1');
//end job application

//saved jobs
$routes->add('saved_jobs/private/view/(:any)', 'Job_search_vw::index/private/view/$1');
$routes->add('saved_jobs/(:any)', 'Saved_jobs::index/$1');
$routes->add('get/saved_jobs/(:any)', 'Saved_jobs::get_record/$1');
$routes->add('saved_jobs/add_fav', 'Job_search_vw::add_fav');
$routes->add('saved_jobs/add_fav/list', 'Job_search::add_fav/list');
//$routes->add('get/master_data/(:any)', 'Saved_jobs::get_master_data/$1');
//end saved jobs

//more job related
$routes->add('more_related_jobs/(:any)', 'More_related_jobs::index/$1');
$routes->add('get/more_related_jobs/(:any)', 'More_related_jobs::get_record/$1');
//end more job related

//trending jobs
//$routes->add('trending_jobs/(:any)', 'Trending_jobs::index/$1');
$routes->add('get/trending_jobs/(:any)', 'Trending_jobs::get_record/$1');
//end trending jobs

//manage dropdown routes
$routes->add('get/manage_dropdown/(:any)', 'Manage_dropdown::get_record/$1');
$routes->add('load_data/(:any)/(:any)', 'Manage_dropdown::load_data/$1/$2');
$routes->add('manage_dropdown/save_data/(:any)', 'Manage_dropdown::save_data/$1');
$routes->add('manage_dropdown/delete_data/', 'Manage_dropdown::delete_data/');
//manage dropdown

//manage employer routes
$routes->add('manage_employer/add/(:any)', 'Manage_employer_vw::index/add/$1');
$routes->add('manage_employer/edit/(:any)', 'Manage_employer_vw::index/edit/$1');
$routes->add('manage_employer/view/(:any)', 'Manage_employer_vw::index/view/$1');
$routes->add('get/order/(:any)', 'Manage_employer_vw::get_record/$1');
$routes->add('manage_employer/system_notes', 'Manage_employer_vw::system_notes_list');
$routes->add('manage_employer/save_data', 'Manage_employer_vw::save_data');
//end manage employer

//signup
$routes->add('get/signup/(:any)', 'Signup::get_record/$1');
//end signup

//applicant application
$routes->add('applicant_application/add/(:any)', 'Applicant_application_vw::index/view/$1');
$routes->add('applicant_application/edit/(:any)', 'Applicant_application_vw::index/view/$1');
$routes->add('applicant_application/view/(:any)', 'Applicant_application_vw::index/view/$1');
$routes->add('get/applicant_application/(:any)', 'Applicant_application::get_record/$1');
$routes->add('get/master_data/(:any)', 'Applicant_application::get_master_data/$1');
$routes->add('applicant_application/load_data/(:any)', 'Applicant_application_vw::load_data/$1');
//end applicant application

//account management
$routes->add('account_management/add/(:any)', 'Account_management_vw::index/view/$1');
$routes->add('account_management/edit/(:any)', 'Account_management_vw::index/view/$1');
$routes->add('account_management/view/(:any)', 'Account_management_vw::index/view/$1');
$routes->add('get/account_management/(:any)', 'Account_management::get_record/$1');
$routes->add('get/master_data/(:any)', 'Account_management::get_master_data/$1');
$routes->add('account_management/load_data/(:any)', 'Account_management_vw::load_data/$1');
$routes->add('account_management/submit_data', 'Account_management_vw::submit_data');
//end account management

//prospect
$routes->add('get/prospect/(:any)', 'Prospect::get_record/$1');
//end prospect

//active
$routes->add('get/active/(:any)', 'Active::get_record/$1');
//end active

//inactive
$routes->add('get/inactive/(:any)', 'Inactive::get_record/$1');
//end inactive

//paused
$routes->add('get/paused/(:any)', 'Paused::get_record/$1');
//end paused

//partner application
$routes->add('partner_application/add/(:any)', 'Partner_application_vw::index/view/$1');
$routes->add('partner_application/edit/(:any)', 'Partner_application_vw::index/view/$1');
$routes->add('partner_application/view/(:any)', 'Partner_application_vw::index/view/$1');
$routes->add('get/partner_application/(:any)', 'Partner_application::get_record/$1');
$routes->add('get/master_data/(:any)', 'Partner_application::get_master_data/$1');
$routes->add('partner_application/load_data/(:any)', 'Partner_application_vw::load_data/$1');
//end partner application

//employer
$routes->add('employer/add/(:any)', 'Employer_vw::index/add/$1');
$routes->add('employer/edit/(:any)', 'Employer_vw::index/edit/$1');
$routes->add('employer/view/(:any)', 'Employer_vw::index/view/$1');
$routes->add('get/employer/(:any)', 'Employer::get_record/$1');
$routes->add('get/employer_history/(:any)', 'Employer_vw::load_history/$1');

$routes->add('get/master_data/(:any)', 'Employer::get_master_data/$1');
$routes->add('employer/load_data/(:any)', 'Employer_vw::load_data/$1');
$routes->add('employer/do_upload', 'Employer_vw::do_upload');
$routes->add('employer/do_upload_multiple', 'Employer_vw::do_upload_multiple');
$routes->add('employer/submit_data', 'Employer_vw::submit_data');
$routes->add('employer/process_account', 'Employer_vw::process_account');
$routes->add('employer/archive', 'Employer_vw::archive');
//end employer


$routes->add('generate/csv/(:any)', 'Generate_doc::generate_csv/csv/$1');
$routes->add('generate/pdf/(:any)', 'Generate_doc::generate_pdf/pdf/$1');

//user routes
$routes->add('get/user/(:any)', 'User::get_record/$1');
$routes->add('user/add/(:any)', 'User_vw::index/add/$1');
$routes->add('user/edit/(:any)', 'User_vw::index/edit/$1');
$routes->add('user/view/(:any)', 'User_vw::index/view/$1');
$routes->add('get/user/(:any)', 'User_vw::get_record/$1');
$routes->add('user/load_data/(:any)', 'User_vw::load_data/$1');
$routes->add('user/submit_data', 'User_vw::submit_data');
$routes->add('user/delete_data', 'User::delete_data');
//user routes


//banner
$routes->add('homepage_banner/add/(:any)', 'Homepage_banner_vw::index/add/$1');
$routes->add('homepage_banner/edit/(:any)', 'Homepage_banner_vw::index/edit/$1');
$routes->add('homepage_banner/view/(:any)', 'Homepage_banner_vw::index/view/$1');
$routes->add('get/homepage_banner/(:any)', 'Homepage_banner::get_record/$1');
$routes->add('get/master_data/(:any)', 'Homepage_banner::get_master_data/$1');
$routes->add('homepage_banner/load_data/(:any)', 'Homepage_banner::load_data/$1');
$routes->add('homepage_banner/do_upload', 'Homepage_banner::do_upload');
$routes->add('homepage_banner/do_upload_multiple', 'Homepage_banner::do_upload_multiple');
$routes->add('homepage_banner/submit_data', 'Homepage_banner::submit_data');
//end banner

//employer section

//company info
$routes->add('company_info/add/(:any)', 'Company_info_vw::index/add/$1');
$routes->add('company_info/edit/(:any)', 'Company_info_vw::index/edit/$1');
$routes->add('company_info/view/(:any)', 'Company_info_vw::index/view/$1');
$routes->add('get/company_info/(:any)', 'Employer::get_record/$1');
$routes->add('get/master_data/(:any)', 'Employer::get_master_data/$1');
$routes->add('company_info/load_data/(:any)', 'Company_info_vw::load_data/$1');
$routes->add('company_info/do_upload', 'Company_info_vw::do_upload');
$routes->add('company_info/do_upload_multiple', 'Company_info_vw::do_upload_multiple');
$routes->add('company_info/submit_data', 'Company_info_vw::submit_data');
//end company info

//company info public
$routes->add('company_info_public/view/(:any)', 'Company_info_public_vw::index/view/$1');
$routes->add('get/company_info_public/(:any)', 'Employer::get_record/$1');
$routes->add('company_info_public/load_data/(:any)', 'Company_info_public_vw::load_data/$1');
$routes->add('company_info_public/do_upload', 'Company_info_public_vw::do_upload');
$routes->add('company_info_public/do_upload_multiple', 'Company_info_public_vw::do_upload_multiple');
$routes->add('company_info_public/submit_data', 'Company_info_public_vw::submit_data');
//end company info public

//applicant info
//$routes->add('applicant_info/add/(:any)', 'Applicant_info_vw::index/add/$1');
$routes->add('applicant_info/edit/(:any)', 'Applicant_info_vw::index/edit/$1');
$routes->add('applicant_info/view/(:any)', 'Applicant_info_vw::index/view/$1');


$routes->add('applicant_info/load_data/(:any)', 'Applicant_info_vw::load_data/$1');
$routes->add('applicant_info/do_upload', 'Applicant_info_vw::do_upload');
$routes->add('applicant_info/do_upload_multiple', 'Applicant_info_vw::do_upload_multiple');
$routes->add('applicant_info/submit_data', 'Applicant_info_vw::submit_data');
$routes->add('applicant_info/change_email', 'Applicant_info_vw::change_email');
//end applicant info

//applicant info login
$routes->add('applicant_info_login/edit/(:any)', 'Applicant_info_login_vw::index/edit/$1');
$routes->add('applicant_info_login/view/(:any)', 'Applicant_info_login_vw::index/view/$1');
$routes->add('applicant_info_login/load_data/(:any)', 'Applicant_info_login_vw::load_data/$1');
$routes->add('applicant_info_login/do_upload', 'Applicant_info_login_vw::do_upload');
$routes->add('applicant_info_login/do_upload_multiple', 'Applicant_info_login_vw::do_upload_multiple');
$routes->add('applicant_info_login/submit_data', 'Applicant_info_login_vw::submit_data');
//end applicant info login


//Job Post
$routes->add('job_post/add/(:any)', 'Job_post_vw::index/add/$1');
$routes->add('job_post/edit/(:any)', 'Job_post_vw::index/edit/$1');
$routes->add('job_post/view/(:any)', 'Job_post_vw::index/view/$1');
$routes->add('get/job_post/(:any)', 'Job_post_vw::get_record/$1');
$routes->add('get/job_post2/(:any)', 'Job_post_vw::get_record2/$1');
$routes->add('get/job_post_no_inactive/(:any)', 'Job_post_vw::get_record_no_inactive/$1');

$routes->add('get/job_post_pagination/(:any)', 'Job_post::get_record/$1');

$routes->add('get/master_data/(:any)', 'Job_post_vw::get_master_data/$1');
$routes->add('job_post/load_data/(:any)', 'Job_post_vw::load_data/$1');
$routes->add('job_post/do_upload', 'Job_post_vw::do_upload');
$routes->add('job_post/do_upload_multiple', 'Job_post_vw::do_upload_multiple');
$routes->add('job_post/submit_data', 'Job_post_vw::submit_data');
$routes->add('job_post/submit_draft_data', 'Job_post_vw::submit_draft_data');
$routes->add('job_post/delete_data/', 'Job_post::delete_data/');
$routes->add('job_post/check_account_status/', 'Job_post_vw::check_account_status');

$routes->add('job_post/pin_job_post', 'Job_post::pin_job_post');

$routes->add('job_post/perks_and_benefits','Job_post_vw::get_perks_and_benefits');
//end Job Post


//Job Post copy
$routes->add('job_post_copy/add/(:any)', 'Job_post_copy_vw::index/add/$1');
$routes->add('job_post_copy/copy/(:any)', 'Job_post_copy_vw::index/copy/$1');
$routes->add('job_post_copy/edit/(:any)', 'Job_post_copy_vw::index/edit/$1');
$routes->add('job_post_copy/view/(:any)', 'Job_post_copy_vw::index/view/$1');
$routes->add('get/job_post_copy/(:any)', 'Job_post_vw::get_record/$1');
$routes->add('get/master_data/(:any)', 'Job_post_vw::get_master_data/$1');
$routes->add('job_post_copy/load_data/(:any)', 'Job_post_vw::load_data/$1');
$routes->add('job_post_copy/do_upload', 'Job_post_vw::do_upload');
$routes->add('job_post_copy/do_upload_multiple', 'Job_post_vw::do_upload_multiple');
$routes->add('job_post_copy/submit_data', 'Job_post_copy_vw::submit_data');
//end Job Post copy

$routes->add('student_pdf/add/(:any)', 'Student_pdf::index/add/$1');
$routes->get('student_pdf/test', 'Student_pdf::htmlToPDF');







/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
