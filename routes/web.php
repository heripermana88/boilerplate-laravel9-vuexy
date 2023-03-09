<?php

use App\Http\Controllers\AppsController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\FormsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserInterfaceController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

// Main Page Route
Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'dashboardEcommerce')->name('dashboard-ecommerce');
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/analytics', 'dashboardAnalytics')->name('dashboard-analytics');
        Route::get('/ecommerce', 'dashboardEcommerce')->name('dashboard-ecommerce');
    });
});

/* Route Apps */
Route::controller(AppsController::class)->prefix('app')->group(function () {
    Route::get('email', 'emailApp')->name('app-email');
    Route::get('chat', 'chatApp')->name('app-chat');
    Route::get('todo', 'todoApp')->name('app-todo');
    Route::get('calendar', 'calendarApp')->name('app-calendar');
    Route::get('kanban', 'kanbanApp')->name('app-kanban');
    Route::get('invoice/list', 'invoice_list')->name('app-invoice-list');
    Route::get('invoice/preview', 'invoice_preview')->name('app-invoice-preview');
    Route::get('invoice/edit', 'invoice_edit')->name('app-invoice-edit');
    Route::get('invoice/add', 'invoice_add')->name('app-invoice-add');
    Route::get('invoice/print', 'invoice_print')->name('app-invoice-print');
    Route::get('ecommerce/shop', 'ecommerce_shop')->name('app-ecommerce-shop');
    Route::get('ecommerce/details', 'ecommerce_details')->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', 'ecommerce_wishlist')->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', 'ecommerce_checkout')->name('app-ecommerce-checkout');
    Route::get('file-manager', 'file_manager')->name('app-file-manager');
    Route::get('user/list', 'user_list')->name('app-user-list');
    Route::get('user/view', 'user_view')->name('app-user-view');
    Route::get('user/edit', 'user_edit')->name('app-user-edit');
});
/* Route Apps */

// /* Route UI */
Route::controller(UserInterfaceController::class)->group(function() {
    Route::prefix('ui')->group(function () {
        Route::get('typography', 'typography')->name('ui-typography');
        Route::get('colors', 'colors')->name('ui-colors');
    });
    Route::prefix('icons')->group(function () {
        Route::get('feather', 'icons_feather')->name('icons-feather');
    });
});
// /* Route UI */

// /* Route Cards */
Route::controller(CardsController::class)->prefix('card')->group(function () {
    Route::get('basic', 'card_basic')->name('card-basic');
    Route::get('advance', 'card_advance')->name('card-advance');
    Route::get('statistics', 'card_statistics')->name('card-statistics');
    Route::get('analytics', 'card_analytics')->name('card-analytics');
    Route::get('actions', 'card_actions')->name('card-actions');
});
// /* Route Cards */

// /* Route Components */
Route::controller(ComponentsController::class)->prefix('component')->group(function () {
    Route::get('alert', 'alert')->name('component-alert');
    Route::get('avatar', 'avatar')->name('component-avatar');
    Route::get('badges', 'badges')->name('component-badges');
    Route::get('breadcrumbs', 'breadcrumbs')->name('component-breadcrumbs');
    Route::get('buttons', 'buttons')->name('component-buttons');
    Route::get('carousel', 'carousel')->name('component-carousel');
    Route::get('collapse', 'collapse')->name('component-collapse');
    Route::get('divider', 'divider')->name('component-divider');
    Route::get('dropdowns', 'dropdowns')->name('component-dropdowns');
    Route::get('list-group', 'list_group')->name('component-list-group');
    Route::get('modals', 'modals')->name('component-modals');
    Route::get('pagination', 'pagination')->name('component-pagination');
    Route::get('navs', 'navs')->name('component-navs');
    Route::get('tabs', 'tabs')->name('component-tabs');
    Route::get('timeline', 'timeline')->name('component-timeline');
    Route::get('pills', 'pills')->name('component-pills');
    Route::get('tooltips', 'tooltips')->name('component-tooltips');
    Route::get('popovers', 'popovers')->name('component-popovers');
    Route::get('pill-badges', 'pill_badges')->name('component-pill-badges');
    Route::get('progress', 'progress')->name('component-progress');
    Route::get('media-objects', 'media_objects')->name('component-media-objects');
    Route::get('spinner', 'spinner')->name('component-spinner');
    Route::get('toast', 'toast')->name('component-toast');
});
// /* Route Components */

// /* Route Extensions */
Route::controller(ExtensionController::class)->prefix('ext-component')->group(function () {
    Route::get('sweet-alerts', 'sweet_alert')->name('ext-component-sweet-alerts');
    Route::get('block-ui', 'block_ui')->name('ext-component-block-ui');
    Route::get('toastr', 'toastr')->name('ext-component-toastr');
    Route::get('slider', 'slider')->name('ext-component-slider');
    Route::get('drag-drop', 'drag_drop')->name('ext-component-drag-drop');
    Route::get('tour', 'tour')->name('ext-component-tour');
    Route::get('clipboard', 'clipboard')->name('ext-component-clipboard');
    Route::get('plyr', 'plyr')->name('ext-component-plyr');
    Route::get('context-menu', 'context_menu')->name('ext-component-context-menu');
    Route::get('swiper', 'swiper')->name('ext-component-swiper');
    Route::get('tree', 'tree')->name('ext-component-tree');
    Route::get('ratings', 'ratings')->name('ext-component-ratings');
    Route::get('locale', 'locales')->name('ext-component-locale');
});
// /* Route Extensions */

// /* Route Page Layouts */
Route::controller(PageLayoutController::class)->prefix('page-layouts')->group(function () {
    Route::get('collapsed-menu', 'layout_collapsed_menu')->name('layout-collapsed-menu');
    Route::get('boxed', 'layout_boxed')->name('layout-boxed');
    Route::get('without-menu', 'layout_without_menu')->name('layout-without-menu');
    Route::get('empty', 'layout_empty')->name('layout-empty');
    Route::get('blank', 'layout_blank')->name('layout-blank');
});
// /* Route Page Layouts */

// /* Route Forms */
Route::controller(FormsController::class)->prefix('form')->group(function () {
    Route::get('input', 'input')->name('form-input');
    Route::get('input-groups', 'input_groups')->name('form-input-groups');
    Route::get('input-mask', 'input_mask')->name('form-input-mask');
    Route::get('textarea', 'textarea')->name('form-textarea');
    Route::get('checkbox', 'checkbox')->name('form-checkbox');
    Route::get('radio', 'radio')->name('form-radio');
    Route::get('switch', 'switch')->name('form-switch');
    Route::get('select', 'select')->name('form-select');
    Route::get('number-input', 'number_input')->name('form-number-input');
    Route::get('file-uploader', 'file_uploader')->name('form-file-uploader');
    Route::get('quill-editor', 'quill_editor')->name('form-quill-editor');
    Route::get('date-time-picker', 'date_time_picker')->name('form-date-time-picker');
    Route::get('layout', 'layouts')->name('form-layout');
    Route::get('wizard', 'wizard')->name('form-wizard');
    Route::get('validation', 'validation')->name('form-validation');
    Route::get('repeater', 'form_repeater')->name('form-repeater');
});
// /* Route Forms */

// /* Route Tables */
Route::controller(TableController::class)->prefix('table')->group(function () {
    Route::get('', 'table')->name('table');
    Route::get('datatable/basic', 'datatable_basic')->name('datatable-basic');
    Route::get('datatable/advance', 'datatable_advance')->name('datatable-advance');
    Route::get('ag-grid', 'ag_grid')->name('ag-grid');
});
// /* Route Tables */

// /* Route Pages */
Route::controller(PagesController::class)->prefix('page')->group(function () {
    Route::get('account-settings', 'account_settings')->name('page-account-settings');
    Route::get('profile', 'profile')->name('page-profile');
    Route::get('faq', 'faq')->name('page-faq');
    Route::get('knowledge-base', 'knowledge_base')->name('page-knowledge-base');
    Route::get('knowledge-base/category', 'kb_category')->name('page-knowledge-base');
    Route::get('knowledge-base/category/question', 'kb_question')->name('page-knowledge-base');
    Route::get('pricing', 'pricing')->name('page-pricing');
    Route::get('blog/list', 'blog_list')->name('page-blog-list');
    Route::get('blog/detail', 'blog_detail')->name('page-blog-detail');
    Route::get('blog/edit', 'blog_edit')->name('page-blog-edit');

});
Route::controller(MiscellaneousController::class)->prefix('page')->group(function () {
// Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', 'coming_soon')->name('misc-coming-soon');
    Route::get('not-authorized', 'not_authorized')->name('misc-not-authorized');
    Route::get('maintenance', 'maintenance')->name('misc-maintenance');
    Route::get('error', 'errorPage')->name('error');
});
// /* Route Pages */

// /* Route Authentication Pages */
Route::controller(AuthenticationController::class)->prefix('auth')->group(function () {
    Route::get('login-v1', 'login_v1')->name('auth-login-v1');
    Route::get('login-v2', 'login_v2')->name('auth-login-v2');
    Route::get('register-v1', 'register_v1')->name('auth-register-v1');
    Route::get('register-v2', 'register_v2')->name('auth-register-v2');
    Route::get('forgot-password-v1', 'forgot_password_v1')->name('auth-forgot-password-v1');
    Route::get('forgot-password-v2', 'forgot_password_v2')->name('auth-forgot-password-v2');
    Route::get('reset-password-v1', 'reset_password_v1')->name('auth-reset-password-v1');
    Route::get('reset-password-v2', 'reset_password_v2')->name('auth-reset-password-v2');
    Route::get('lock-screen', 'lock_screen')->name('auth-lock_screen');
});
// /* Route Authentication Pages */

/* Route Charts */
Route::controller(ChartsController::class)->group(function () {
    Route::prefix('chart')->group(function () {
        Route::get('apex', 'apex')->name('chart-apex');
        Route::get('chartjs', 'chartjs')->name('chart-chartjs');
        Route::get('echarts', 'echarts')->name('chart-echarts');
    });
    Route::get('/maps/leaflet', 'maps_leaflet')->name('map-leaflet');
});
/* Route Charts */

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
