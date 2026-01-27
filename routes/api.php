<?php

use App\Http\Controllers\Api\AccessController;
use App\Http\Controllers\Api\ConnectionTypeController;
use App\Http\Controllers\Api\MaintenanceController;
use App\Http\Controllers\Api\NetworkTypeController;
use App\Http\Controllers\Api\PavingController;
use App\Http\Controllers\Api\PoleController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\TransformerController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::get('validateToken', [AuthController::class, 'validateToken']);

Route::prefix('tickets')->group(callback: function () {
    Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
    Route::post('/', [TicketController::class, 'store'])->name('ticket.store');
});

Route::middleware(['jwt'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('user')->group(function(){
        Route::get('me', [AuthController::class, 'me']);
    });

    Route::prefix('dashboard')->group(function () {
       Route::get('/cards', [DashboardController::class, 'cards'])->name('dashboard.cards');
    });

    Route::prefix('types')->group(function () {
        Route::get('/', [TypeController::class, 'index'])->name('types.index');           // GET    /types
        Route::post('/', [TypeController::class, 'store'])->name('types.store');          // POST   /types
        Route::get('/{type}', [TypeController::class, 'show'])->name('types.show');       // GET    /types/{type}
        Route::put('/{type}', [TypeController::class, 'update'])->name('types.update');   // PUT    /types/{type}
        Route::patch('/{type}', [TypeController::class, 'update']);                       // PATCH  /types/{type}
        Route::delete('/{type}', [TypeController::class, 'destroy'])->name('types.destroy');// DELETE /types/{type}
    });

    /**
     * PAVINGS
     */
    Route::prefix('pavings')->group(function () {
        Route::get('/', [PavingController::class, 'index'])->name('pavings.index');
        Route::post('/', [PavingController::class, 'store'])->name('pavings.store');
        Route::get('/{paving}', [PavingController::class, 'show'])->name('pavings.show');
        Route::put('/{paving}', [PavingController::class, 'update'])->name('pavings.update');
        Route::patch('/{paving}', [PavingController::class, 'update']);
        Route::delete('/{paving}', [PavingController::class, 'destroy'])->name('pavings.destroy');
    });

    /**
     * POSITIONS
     */
    Route::prefix('positions')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('positions.index');
        Route::post('/', [PositionController::class, 'store'])->name('positions.store');
        Route::get('/{position}', [PositionController::class, 'show'])->name('positions.show');
        Route::put('/{position}', [PositionController::class, 'update'])->name('positions.update');
        Route::patch('/{position}', [PositionController::class, 'update']);
        Route::delete('/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
    });

    /**
     * NETWORK TYPES
     */
    Route::prefix('network-types')->group(function () {
        Route::get('/', [NetworkTypeController::class, 'index'])->name('network_types.index');
        Route::post('/', [NetworkTypeController::class, 'store'])->name('network_types.store');
        Route::get('/{networkType}', [NetworkTypeController::class, 'show'])->name('network_types.show');
        Route::put('/{networkType}', [NetworkTypeController::class, 'update'])->name('network_types.update');
        Route::patch('/{networkType}', [NetworkTypeController::class, 'update']);
        Route::delete('/{networkType}', [NetworkTypeController::class, 'destroy'])->name('network_types.destroy');
    });

    /**
     * CONNECTION TYPES
     */
    Route::prefix('connection-types')->group(function () {
        Route::get('/', [ConnectionTypeController::class, 'index'])->name('connection_types.index');
        Route::post('/', [ConnectionTypeController::class, 'store'])->name('connection_types.store');
        Route::get('/{connectionType}', [ConnectionTypeController::class, 'show'])->name('connection_types.show');
        Route::put('/{connectionType}', [ConnectionTypeController::class, 'update'])->name('connection_types.update');
        Route::patch('/{connectionType}', [ConnectionTypeController::class, 'update']);
        Route::delete('/{connectionType}', [ConnectionTypeController::class, 'destroy'])->name('connection_types.destroy');
    });

    /**
     * TRANSFORMERS
     */
    Route::prefix('transformers')->group(function () {
        Route::get('/', [TransformerController::class, 'index'])->name('transformers.index');
        Route::post('/', [TransformerController::class, 'store'])->name('transformers.store');
        Route::get('/{transformer}', [TransformerController::class, 'show'])->name('transformers.show');
        Route::put('/{transformer}', [TransformerController::class, 'update'])->name('transformers.update');
        Route::patch('/{transformer}', [TransformerController::class, 'update']);
        Route::delete('/{transformer}', [TransformerController::class, 'destroy'])->name('transformers.destroy');
    });

    /**
     * ACCESSES
     */
    Route::prefix('accesses')->group(function () {
        Route::get('/', [AccessController::class, 'index'])->name('accesses.index');
        Route::post('/', [AccessController::class, 'store'])->name('accesses.store');
        Route::get('/{access}', [AccessController::class, 'show'])->name('accesses.show');
        Route::put('/{access}', [AccessController::class, 'update'])->name('accesses.update');
        Route::patch('/{access}', [AccessController::class, 'update']);
        Route::delete('/{access}', [AccessController::class, 'destroy'])->name('accesses.destroy');
    });

    /**
     * CHARACTERISTICS
     */
    Route::prefix('characteristics')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\CharacteristicController::class, 'index'])->name('characteristics.index');
        Route::post('/', [\App\Http\Controllers\Api\CharacteristicController::class, 'store'])->name('characteristics.store');
        Route::get('/{characteristic}', [\App\Http\Controllers\Api\CharacteristicController::class, 'show'])->name('characteristics.show');
        Route::put('/{characteristic}', [\App\Http\Controllers\Api\CharacteristicController::class, 'update'])->name('characteristics.update');
        Route::patch('/{characteristic}', [\App\Http\Controllers\Api\CharacteristicController::class, 'update']);
        Route::delete('/{characteristic}', [\App\Http\Controllers\Api\CharacteristicController::class, 'destroy'])->name('characteristics.destroy');
    });

    /**
     * ARMS
     */
    Route::prefix('arms')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\ArmController::class, 'index'])->name('arms.index');
        Route::post('/', [\App\Http\Controllers\Api\ArmController::class, 'store'])->name('arms.store');
        Route::get('/{arm}', [\App\Http\Controllers\Api\ArmController::class, 'show'])->name('arms.show');
        Route::put('/{arm}', [\App\Http\Controllers\Api\ArmController::class, 'update'])->name('arms.update');
        Route::patch('/{arm}', [\App\Http\Controllers\Api\ArmController::class, 'update']);
        Route::delete('/{arm}', [\App\Http\Controllers\Api\ArmController::class, 'destroy'])->name('arms.destroy');
    });

    /**
     * LAMPS
     */
    Route::prefix('lamps')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\LampController::class, 'index'])->name('lamps.index');
        Route::post('/', [\App\Http\Controllers\Api\LampController::class, 'store'])->name('lamps.store');
        Route::get('/{lamp}', [\App\Http\Controllers\Api\LampController::class, 'show'])->name('lamps.show');
        Route::put('/{lamp}', [\App\Http\Controllers\Api\LampController::class, 'update'])->name('lamps.update');
        Route::patch('/{lamp}', [\App\Http\Controllers\Api\LampController::class, 'update']);
        Route::delete('/{lamp}', [\App\Http\Controllers\Api\LampController::class, 'destroy'])->name('lamps.destroy');
    });

    /**
     * POWERS
     */
    Route::prefix('powers')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\PowerController::class, 'index'])->name('powers.index');
        Route::post('/', [\App\Http\Controllers\Api\PowerController::class, 'store'])->name('powers.store');
        Route::get('/{power}', [\App\Http\Controllers\Api\PowerController::class, 'show'])->name('powers.show');
        Route::put('/{power}', [\App\Http\Controllers\Api\PowerController::class, 'update'])->name('powers.update');
        Route::patch('/{power}', [\App\Http\Controllers\Api\PowerController::class, 'update']);
        Route::delete('/{power}', [\App\Http\Controllers\Api\PowerController::class, 'destroy'])->name('powers.destroy');
    });

    /**
     * REACTORS
     */
    Route::prefix('reactors')->group(function () {
        Route::get('/', [\App\Http\Controllers\Api\ReactorController::class, 'index'])->name('reactors.index');
        Route::post('/', [\App\Http\Controllers\Api\ReactorController::class, 'store'])->name('reactors.store');
        Route::get('/{reactor}', [\App\Http\Controllers\Api\ReactorController::class, 'show'])->name('reactors.show');
        Route::put('/{reactor}', [\App\Http\Controllers\Api\ReactorController::class, 'update'])->name('reactors.update');
        Route::patch('/{reactor}', [\App\Http\Controllers\Api\ReactorController::class, 'update']);
        Route::delete('/{reactor}', [\App\Http\Controllers\Api\ReactorController::class, 'destroy'])->name('reactors.destroy');
    });

    /**
     * POLES
     * (rota fixa /by-qrcode antes de /{pole})
     */
    Route::prefix('poles')->group(function () {
        Route::get('/', [PoleController::class, 'index'])->name('poles.index');
        Route::post('/', [PoleController::class, 'store'])->name('poles.store');
        Route::get('/{pole}', [PoleController::class, 'show'])->name('poles.show');        
        Route::patch('/{pole}', [PoleController::class, 'update'])->name('poles.update');
        Route::delete('/{pole}', [PoleController::class, 'destroy'])->name('poles.destroy');
    });

    /**
     * MAINTENANCES
     */
    Route::prefix('maintenances')->group(function () {
        Route::get('/', [MaintenanceController::class, 'index'])->name('maintenances.index');
        Route::get('/list', [MaintenanceController::class, 'list'])->name('maintenances.list');
        Route::post('/', [MaintenanceController::class, 'store'])->name('maintenances.store');
        Route::get('/{maintenance}', [MaintenanceController::class, 'show'])->name('maintenances.show');
        Route::put('/{maintenance}', [MaintenanceController::class, 'update'])->name('maintenances.update');
        Route::patch('/{maintenance}', [MaintenanceController::class, 'update']);
        Route::delete('/{maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenances.destroy');
});    
});
