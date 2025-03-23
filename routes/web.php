<?php

use App\Http\Controllers\AdditionalResourceController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\dashBoardController;
use App\Http\Controllers\DigitalSolutionCommentsController;
use App\Http\Controllers\DigitalSolutionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportantController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartinerController;
use App\Http\Controllers\UserController;
use App\Models\DigitalSolutionComments;
use App\Models\Important;
use App\Models\Partiner;
use App\Models\Partner;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::POST('/login', [UserController::class, 'auth'])->name('auth');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/ds', [HomeController::class, 'ds'])->name('ds');
Route::get('/blogs/all', [HomeController::class, 'blogs'])->name('blogs.all');
Route::get('/blog/{blog}/show', [HomeController::class, 'blog_show'])->name('blog.show');
Route::get('/add_resource/index', [AdditionalResourceController::class, 'guest_index'])->name('add_resource.index');
Route::get('/additional_resources/{id}/edit}', [AdditionalResourceController::class, 'edit'])->middleware(['auth'])->name('additional_resources.edit');
Route::post('/additional_resources/edit',[AdditionalResourceController::class,'update'])->name('additional_resources.edit_save');
Route::get('/elearning', [HomeController::class, 'elearning'])->name(
    'elearning'
);
Route::get('/user/create',
function()
{
    return view('Users.create');
}
)->middleware(['auth'])->name('user.create_user');
Route::post('/user/store',[UserController::class,'create_save'])->middleware('auth')->name('user.store');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::resource("contact",ContactController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [dashBoardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');
    Route::get('/User/{User}/change_password', [UserController::class, 'change_password'])
        ->middleware(['auth'])
        ->name('change_password');
    Route::post('/User/{User}/changepassword', [UserController::class, 'change_password_store'])
        ->middleware(['auth'])
        ->name('User.change_password');
    Route::get('news/{news}/deactivate', [
        NewsController::class,
        'deactivate',
    ])->name('news.deactivate');
    Route::resource('news', NewsController::class)->middleware('auth');
    Route::resource('User', UserController::class)->middleware('auth');
    Route::get('/User/{User}/profile', [UserController::class,"profile"])->middleware('auth')->name("User.profile");
    Route::resource('event', EventController::class)->middleware('auth');
    Route::resource('additional_resources', AdditionalResourceController::class)->middleware('auth');
    Route::resource('role', RoleController::class)->middleware('auth');
    Route::get('permission', [RoleController::class, 'allPermissions'])->name(
        'permission.index'
    );

    Route::post('role/{role}/permission/assign', [
        RoleController::class,
        'permissionAssign',
    ])->name('role.permission.assign');
    Route::post('user/{user}/role_permission_update', [
        UserController::class,
        'updateRoleAndPermission',
    ])->name('user.role.permission.update');
    Route::resource('/users', UserController::class);
    Route::get('permission', [RoleController::class, 'allPermissions'])->name(
        'permission.index'
    );
    Route::resource('/digitalSolution', DigitalSolutionController::class);
    Route::resource('DigitalSolution/{DigitalSolution}/comment', DigitalSolutionCommentsController::class);
    Route::resource('blog/{blog}/user/{user}/blog_comment', BlogCommentController::class);
    Route::resource('/catagories', CatagoryController::class);
    Route::resource('resource.exercise', ExerciseController::class);
    Route::resource('blogs', BlogsController::class);
    Route::get('/digitalSolution/{digitalSolution}/activate', [
        DigitalSolutionController::class,
        'activate',
        ])->name('digitalSolution.activate');

        Route::get('/digitalSolution/{digitalSolution}/deactivate', [
            DigitalSolutionController::class,
            'deactivate',
            ])->name('digitalSolution.deactivate');
        });
        Route::get('send-email', [MailController::class, 'index']);

        Route::get('/digitalSolutions/{digitalSolution}/show', [
            HomeController::class,
            'show',
            ])->name('digitalSolutions.show');
            Route::resource('/partner', PartinerController::class);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/partners', [PartinerController::class, 'partner'])->name('partners');
Route::get('/forget', [UserController::class, 'forget'])->name('forget');
Route::post('/forgetpass', [UserController::class, 'forgetpass'])->name('forgetpass');
Route::get('user/{user}/forgetpass', [UserController::class, 'forgetpass_create'])->name('user.forgetpass');
Route::post('user/{user}/change_forgotten_password', [UserController::class, 'change_forgottenpassword'])->name('user.change_forgottenpassword');

Route::post('/login', [UserController::class, 'auth'])->name('auth');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/ds', [HomeController::class, 'ds'])->name('ds');
Route::get('/ds/{sector?}', [HomeController::class, 'ds'])->name('ds.search');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
Route::get('/elearning', [HomeController::class, 'elearning'])->name(
    'elearning'
);
Route::get('get-video/resource/{resource}', [
    ClassController::class,
    'getVideo',
])->name('getVideo');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/important', [ImportantController::class, 'index'])->name('Important.index');
Route::get('/new/{id?}', [NewsController::class, 'index_guest'])->name('new');
Route::get('/contacts', [HomeController::class, 'contact'])->name('contact');
// Route::post('/contact', [CommentController::class, 'store'])->name('contact');
// Route::get('/news_guest/{new_id}', [NewsController::class, 'news_guest_view'])->name('new_show');
Route::get("/digital_solutions/{search?}",[HomeController::class,"search"])->name("digitalSolution.search");
Route::get("/events",[HomeController::class,"events"])->name("event");

require __DIR__ . '/elearning.php';
