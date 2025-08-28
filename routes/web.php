<?php
use App\Http\Controllers\ManagerLeadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesmanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
Route::post('leads/store', [LeadController::class, 'store'])->name('leads.store');



// Protected routes
Route::middleware('auth')->group(function () {

    // Dashboard with role check
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role == 'manager') {
            return redirect()->route('manager.dashboard');
        } else {
            return view('dashboard');
        }
    })->name('dashboard');

    // web.php me
    Route::post('/salesmanlead/store', [SalesmanController::class, 'storeSalesmanLead'])->name('salesmanlead.store');

    // Manager lead edit routes
    Route::get('/manager/lead/{id}/edit', [ManagerLeadController::class, 'edit'])->name('manager.lead.edit');
    Route::put('/manager/lead/{id}', [ManagerLeadController::class, 'update'])->name('manager.lead.update');

    // Manager specific routes
    Route::get('/manager/dashboard', [ManagerLeadController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/manager/assigned-salesmen', [ManagerLeadController::class, 'getAssignedSalesmen']);
    Route::get('/managerlead', [ManagerLeadController::class, 'index'])->name('managerlead.index');
    Route::post('/managerlead/store', [ManagerLeadController::class, 'store'])->name('managerlead.store');

    // Lead routes
    Route::get('/lead/{id}/edit', [LeadController::class, 'edit'])->name('lead.edit');
    Route::put('/lead/{id}', [LeadController::class, 'update'])->name('leads.update');
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');

    Route::post('/manager/notifications/{id}/read', [ManagerLeadController::class, 'markNotificationAsRead']);
    Route::post('/manager/notifications/mark-all-read', [ManagerLeadController::class, 'markAllNotificationsAsRead']);
    Route::get('/manager/notifications/get', [ManagerLeadController::class, 'getNotifications']);


    // Salesman notification routes
   
    Route::post('/salesman/notifications/{id}/read', [SalesmanController::class, 'markNotificationAsRead']);
Route::post('/salesman/notifications/mark-all-read', [SalesmanController::class, 'markAllNotificationsAsRead']);

    Route::get('/notifications/{id}', [SalesmanController::class, 'show'])->name('notifications.show');


    Route::get('/manager/leads/{id}', [ManagerLeadController::class, 'show'])->name('manager.lead.view');
    // routes/web.php mein
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    // 2. Routes (web.php mein ye add kariye)

    // web.php me ye line add karo
    Route::get('/salesman/lead/{id}/edit', [SalesmanController::class, 'editLead'])->name('salesman.edit.lead');
    Route::put('/salesman/lead/{id}', [SalesmanController::class, 'updateLead'])->name('salesman.update.lead');
    // routes/web.php
    Route::post('/salesmanlead/store', [SalesmanController::class, 'storeSalesmanLead'])
        ->name('salesmanlead.store');

    // routes/web.php mein ye route add karo
    Route::get('/salesman/lead-success/{id}', [SalesmanController::class, 'leadSuccess'])
        ->name('salesman.leadSuccess');

    // 4. Routes add kariye (web.php mein)

    Route::middleware(['auth'])->group(function () {
        // Salesman routes
        Route::get('/salesman/dashboard', [SalesmanController::class, 'dashboard'])->name('salesman.dashboard');
        // web.php me ye routes hain?



    });






    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';