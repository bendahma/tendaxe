<?php

//////-------------modification---------------------////
use App\Http\Controllers\OffergroupController;
////-----------------------------------------------///
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\AdminPhoneNotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddOffreController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OffreController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\SearchOffreController;
use App\Http\Controllers\verificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SettingsController;
use App\Http\Controllers\Admin\AbonnementController;
use App\Http\Controllers\Auth\DeviceManagerController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\Journalfr;
use App\Models\Journalar;
use App\Models\Wilaya;
use App\Models\User;
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

// MUST RUN ONLY ONCE
Route::get('/fillDatabase', function () {

    User::query()->update(['phoneVerified'=>true]);

    Journalar::query()->update(['source'=>'journalAr']);
    Journalfr::query()->update(['source'=>'journalFr']);

    $wilaya = Wilaya::where('wilaya','=','Adrar')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '01']);  }

    $wilaya = Wilaya::where('wilaya','=','Chlef')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '02']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Laghouat')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '03']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Oum El Bouaghi')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '04']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Batna')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '05']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Béjaïa')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '06']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Biskra')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '07']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Béchar')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '08']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Blida')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '09']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Bouira')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '10']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tamanrasset')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '11']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tébessa')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '12']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tlemcen')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '13']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tiaret')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '14']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tizi Ouzou')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '15']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Alger')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '16']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Djelfa')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '17']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Jijel')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '18']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Sétif')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '19']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Saïda')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '20']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Skikda')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '21']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Sidi Bel Abbès')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '22']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Annaba')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '23']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Guelma')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '24']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Constantine')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '25']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Médéa')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '26']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Mostaganem')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '27']);  }
    
    $wilaya = Wilaya::where('wilaya','=','M\'Sila')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '28']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Mascara')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '29']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Ouargla')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '30']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Oran')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '31']);  }
    
    $wilaya = Wilaya::where('wilaya','=','El Bayadh')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '32']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Illizi')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '33']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Bordj Bou Arreridj')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '34']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Boumerdès')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '35']);  }
    
    $wilaya = Wilaya::where('wilaya','=','El Tarf')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '36']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tindouf')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '37']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tissemsilt')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '38']);  }
    
    $wilaya = Wilaya::where('wilaya','=','El Oued')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '39']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Khenchela')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '40']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Souk Ahras')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '41']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Tipaza')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '42']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Mila')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '43']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Aïn Defla')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '44']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Naâma')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '45']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Aïn Témouchent')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '46']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Ghardaïa')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '47']);  }
    
    $wilaya = Wilaya::where('wilaya','=','Relizane')->get();
    foreach ($wilaya as $w) { $w->update(['codeWilaya'  => '48']);  }

    Wilaya::create(['notif_id'=>3,'wilaya'=>'Timimoun','codeWilaya' => '49']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'Bordj Badji Mokhtar','codeWilaya' => '50']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'Ouled Djellal','codeWilaya' => '51']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'Béni Abbès','codeWilaya' => '52']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'In Salah','codeWilaya' => '53']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'In Guezzam','codeWilaya' => '54']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'Touggourt','codeWilaya' => '55']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'Djanet','codeWilaya' => '56']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'El M’Ghaier','codeWilaya' => '57']);
    Wilaya::create(['notif_id'=>3,'wilaya'=>'El Meniaa','codeWilaya' => '58']);

    return "DONE";
});

Route::get('/test', function () {
    return view('user.notif');
});
Route::get('/documents', function () {
    return view('docs');
})->name('docs');
Route::get('/conditions', function () {
    return view('conditions');
})->name('conditions');
// email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// phone number routes
Route::get('/phone/verify', [verificationController::class,'index'])->middleware('auth')->name('phone.verification');
Route::post('/phone/check', [verificationController::class,'check'])->middleware('auth')->name('phone.check');
Route::get('/phone/notification', [verificationController::class,'notification'])->middleware('auth')->name('phone.notification');
Route::get('/phone/sendNotification/{user}', [verificationController::class,'sendNotification'])->middleware('auth')->name('phone.sendNotification');
Route::get('/phone/confirmation/{user}', [verificationController::class,'confirmation'])->middleware('auth')->name('phone.confirmation');
Route::get('/phone/{user}/edit/', [verificationController::class,'edit'])->middleware('auth')->name('phone.edit');

Route::patch('/phone/update/{user}', [verificationController::class,'update'])->middleware('auth')->name('phone.update');

Route::get('/users/{user}/relogin', [UsersController::class,'relogin'])->name('users.relogin');


// admin phone verification 
Route::resource('/adminphone', AdminPhoneNotificationController::class);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// password reset
Route::get('/forgot-password',[PasswordResetController::class, 'GetPasswordLinkForm'])->name('password.request')->middleware('guest');
Route::post('/forgot-password',[PasswordResetController::class, 'GetPasswordLink'])->name('password.email')->middleware('guest');
Route::get('/reset-password/{token}',[PasswordResetController::class, 'PasswordResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password',[PasswordResetController::class, 'PasswordReset'])->middleware('guest')->name('password.update');
Route::get('/suspended', function () {
    return view('suspended');
})->name('suspended');
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/help',function () {
    return view('help');
})->name('help');
Route::get('/search',[SearchOffreController::class, 'index'])->name('search')->middleware(['PhoneVerified','SessionLimiter']);
Route::get('/device_manager',[DeviceManagerController::class, 'index'])->name('device_manager')->middleware(['auth','PhoneVerified']);
Route::post('/device_manager/logout/all',[DeviceManagerController::class, 'logout_all'])->name('device_manager.logout.all')->middleware(['auth']);
Route::post('/device_manager/logout/{device_id}',[DeviceManagerController::class, 'logout_single'])->name('device_manager.logout.single')->middleware(['auth']);
Route::middleware(['auth','PhoneVerified' ,'SessionLimiter'])->group(function () {
    Route::get('/add',[AddOffreController::class, 'index'])->name('offre.add');
    Route::post('/add',[AddOffreController::class, 'store']);
    // Route::delete('/offre',[AddOffreController::class, 'destroy'])->name('offre.destroy');
    Route::get('/settings/profile',[ProfileController::class, 'index'])->name('profile');
    Route::get('/settings/abonnement',[ProfileController::class, 'abonnement'])->name('abonnement');
    Route::get('/settings/notification',[ProfileController::class, 'notif'])->name('notification')->middleware('EmailVerified');
    Route::get('/settings/offres',[AddOffreController::class, 'mesoffres'])->name('user.offers');
    Route::post('/pack',[SettingsController::class, 'DemandeAbonnement'])->name('user.pack.add');
    Route::post('/chang_pswd',[SettingsController::class, 'EditPassword'])->name('user.password');
    Route::post('/chang_email',[SettingsController::class, 'editemail'])->name('user.email');
    Route::post('/chang_phone',[SettingsController::class, 'editphone'])->name('user.phone');
    Route::post('/favories/{offre}',[FavoritController::class, 'toggle'])->name('favorit.toggle');
    Route::get('/favories',[FavoritController::class, 'index'])->name('offre.favorit');
    Route::post('/settings/notif/',[SettingsController::class, 'Editnotif'])->name('user.notif');
    Route::delete('/settings/notif/wilaya/{wilaya}',[SettingsController::class, 'deleteWilaya'])->name('user.notif.wilaya');
    Route::delete('/settings/notif/sect/{secteur}',[SettingsController::class, 'deleteSecteur'])->name('user.notif.secteur');
    Route::delete('/settings/notif/keyword/{keyword}',[SettingsController::class, 'deleteKeyword'])->name('user.notif.keyword');
    Route::delete('/settings/notif/statut/{statut}',[SettingsController::class, 'deletestatut'])->name('user.notif.statut');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login',[LoginController::class, 'index'])->name('login');
    Route::post('/login',[LoginController::class, 'store']);
    Route::get('/register',[RegisterController::class, 'index'])->name('register');
    // Route::get('/register/{choice}',[RegisterController::class, 'index']);
    Route::post('/register',[RegisterController::class, 'store']);
});
Route::get('/detail/{offre_id}',[SearchOffreController::class, 'detail'])->name('detail')->middleware('SessionLimiter');
// adminpanel (both admin & publisher can access those routes)
Route::group(['prefix' => 'admin',  'middleware' => 'adminpanel'], function()
{
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::post('/logout',[LogoutController::class, 'index'])->name('admin.logout');
    Route::get('/phone/verification',[verificationController::class, 'notification'])->name('admin.phone.notification');
    Route::get('/offers',[OffreController::class, 'index'])->name('admin.offers');
    Route::get('/offers/add',[OffreController::class, 'addform'])->name('admin.offers.add');
    Route::post('/offers/add',[OffreController::class, 'store']);
    ///////////////////////////------Modification-------////////////////////
    Route::get('/offers/addgroupform',[OffergroupController::class, 'index'])->name('admin.offers.addoffergroupform');
    Route::post('/offers/addgrouplist',[OffergroupController::class, 'addgroupofferlist'])->name('admin.offers.addoffergrouplist');
    Route::post('/offers/addgroup',[OffergroupController::class, 'addgroupoffer'])->name('admin.offers.addoffergroup');
    Route::get('/offers/pendding',[OffergroupController::class, 'penddingOffers'])->name('admin.offers.penddingOffers');
    ///////////////////////////////////////////////////////////////////////
    Route::delete('/offre',[OffreController::class, 'destroy'])->name('admin.offre.destroy');
    Route::get('/offers/edit/{offer}',[OffreController::class, 'editform'])->name('admin.offers.edit');
    Route::post('/offers/edit/{offer}',[OffreController::class, 'edit']);
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    Route::post('/settings',[SettingsController::class, 'EditPassword']);
});

Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function() {
    Route::get('/users',[UsersController::class, 'index'])->name('admin.users');
    Route::post('/users/etat/{user}',[UsersController::class, 'update_etat'])->name('admin.user.etat');
    Route::post('/users/email/{user}',[UsersController::class, 'Email_Verify'])->name('admin.user.email');
    Route::post('/users/phone/{user}',[UsersController::class, 'Phone_Verify'])->name('admin.user.phoneVerify');
    Route::post('/users/password/{user}',[UsersController::class, 'update_password'])->name('admin.user.password');
    Route::post('/users/detail/{user}',[UsersController::class, 'update_details'])->name('admin.user.details');
    Route::delete('/users/delete/{user}',[UsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::delete('/abonnement',[AbonnementController::class, 'destroy'])->name('admin.abonnement.destroy');
    Route::post('/abonnement/add/{user}',[AbonnementController::class, 'store'])->name('admin.abonnement.store');
    Route::post('/abonnement/edit',[AbonnementController::class, 'edit'])->name('admin.abonnement.edit');
    Route::get('/abonnement/{abonnement}',[AbonnementController::class, 'detail'])->name('admin.abonnement.detail');
    Route::get('/users/add',[UsersController::class, 'addform'])->name('admin.user.add');
    Route::post('/users/add',[UsersController::class, 'store']);
    Route::get('/users/{user}',[UsersController::class, 'detail'])->name('admin.users.detail');
    Route::get('/admins',[AdminController::class, 'index'])->name('admin.admins');
    Route::get('/admins/add', function () {
        return view('admin.add_admin');
    })->name('admin.admins.add');
    Route::post('/admins/add',[AdminController::class, 'store']);
    Route::post('/admins/role/{user}',[AdminController::class, 'role'])->name('admin.user.role');
    Route::get('/offers/trash',[OffreController::class, 'trashed'])->name('admin.trash');
    Route::post('/offers/restore',[OffreController::class, 'restore'])->name('admin.offre.restore');
    Route::get('/offers/pending',[OffreController::class, 'pending'])->name('admin.pending');
    Route::post('/offers/accept',[OffreController::class, 'accept'])->name('admin.offre.accept');
    Route::post('/admin/notif/{notif}',[UsersController::class, 'Editnotif'])->name('admin.notif');
    Route::delete('/notif/sect/{user}/{secteur}',[UsersController::class, 'deleteSecteur'])->name('admin.notif.secteur');
});

Route::group(['prefix' => 'representant',  'middleware' => 'ContentCreator'], function()
{
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('rep.dashboard');
    Route::get('/offers',[OffreController::class, 'index'])->name('rep.offers');
    Route::get('/offers/add',[OffreController::class, 'addform'])->name('rep.offers.add');
    Route::post('/offers/add',[AddOffreController::class, 'store']);
    Route::get('/offers/edit/{offer}',[OffreController::class, 'editform'])->name('rep.offers.edit');
    Route::post('/offers/edit/{offer}',[AddOffreController::class, 'edit']);
    Route::delete('/offre',[OffreController::class, 'destroy'])->name('rep.offre.destroy');
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('rep.settings');
    Route::post('/settings',[SettingsController::class, 'EditPassword']);
});

Route::post('/logout',[LogoutController::class, 'index'])->name('logout')->middleware('auth');