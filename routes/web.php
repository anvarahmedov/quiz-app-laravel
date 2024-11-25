<?php

use App\Http\Middleware\IsSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CheckResultsController;
use App\Http\Controllers\MixController;
use App\Http\Controllers\HemisController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;




//Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('oauth-login-student',[\App\Http\Controllers\OAuth2Controller::class,'loginStudent'])->name('oauth-login-student');
Route::get('oauth-login-teacher',[\App\Http\Controllers\OAuth2Controller::class,'loginTeacher'])->name('oauth-login-teacher');

//Route::get('login', [HemisController::class, 'login'])->name('login-student');

Route::middleware('auth')->group(function (){
    Route::get('/', [MixController::class, 'firstPage'])->name('first-page');
//    Route::get('login', [HemisController::class, 'login'])->name('login-student');
    Route::post('login-student-user', [HemisController::class, 'loginUser'])->name('login-student-user');
    Route::get('logout-student', [HemisController::class, 'logout'])->name('logout-student');
});

Route::get('/log.student', function() {
    return view('auth.login');
});

Route::get('/welcome', [\App\Http\Controllers\OAuth2Controller::class, 'welcome'])->name('home')->middleware('auth:sanctum');

use Illuminate\Http\Request;

//Route::post('/tokens/create', function (Request $request) {
  //  $token = $request->user()->createToken($request->token_name);

    //return ['token' => $token->plainTextToken];
//});
Route::get('/setup', function() {



   // $credentials = [
 //        'email' => 'admin@example.com',
   //      'password' => '12345678'
 //    ];

  //   dd($credentials);

  //   if(!Auth::attempt($credentials)) {
  //       dd(vars: 'ewew');
     //    $user = new App\Models\User();

    //     $user->name = 'Admin_2';
     //    $user->role = 'ADMIN';
     //    $user->email = $credentials['email'];
    //     $user->password = Hash::make($credentials['password']);

   //      $user->save();

    //     if(Auth::attempt($credentials)) {
   //          $user = auth()->user();

    //         $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
    //         $updateToken = $user->createToken('update-token', ['create', 'update']);
    //         $basicToken = $user->createToken('basic-token');

   //          return [
     //            'admin' => $adminToken->plainTextToken,
        //         'update' => $updateToken->plainTextToken,
      //           'basic' => $basicToken->plainTextToken
    //         ];
    //     }

  //  }

   // $user = auth()->user();
  //  $superAdminToken = $user->createToken('super-admin-token');
  //  if (auth()->user()->tokens()) {
  //    return [
  //      'superAdmin' => auth()->user()->tokens()->plainTextToken,
  //    ];
   // }
  //  return [
 //       'superAdmin' => $superAdminToken->plainTextToken,
 //   ];

 })->middleware(IsSuperAdminMiddleware::class);



Route::get('/', [\App\Http\Controllers\OAuth2Controller::class, 'login'])->name('home');

Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');

Route::get('/show/{quiz_id}', [QuizController::class, 'show'])->name('quiz.show')->middleware('auth');
Route::get('/ask', [QuestionController::class, 'get'])->name('question.ask');
Route::post('/create', [QuestionController::class, 'create'])->name('question.create');

Route::post('/check/{id}', [CheckResultsController::class, 'check'])->name('check');
Route::post('/precheck/{id}', [CheckResultsController::class, 'preCheck'])->name('pre_check');

Route::post('/answer/{id}', [CheckResultsController::class, 'answer'])->name('make_answered');
Route::post('/addpoints/{id}', [CheckResultsController::class, 'addPointsToResult'])->name('add_points');
Route::post('/started/{id}', [CheckResultsController::class, 'quizHasStarted'])->name('quizHasStarted');

Route::get('webLogout', [AuthController::class, 'logoutForWeb']);
//Route::get('/language/{locale}', function($locale) {
 //   if(array_key_exists($locale, config('app.supported_locales'))) {
 //       session()->put('locale', $locale);
//    }
//    return redirect()->back();
//})->name('language.switch');

//Route::post('/attempt', [AttemptController::class, 'store'])->name('attempt');

Route::get('/finish/{id}/{quiz_id}', [CheckResultsController::class, 'finish'])->name('finish');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
  //  Route::get('/dashboard', function () {
   //     return view('dashboard');
 //   })->name('dashboard');
});
