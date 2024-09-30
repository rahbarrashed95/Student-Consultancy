<?php
use Illuminate\Support\Facades\Route;


//Frontend

use App\Http\Controllers\Frontend\HomeController as FrontHomeController;


// Backend

use App\Http\Controllers\Backend\SliderController; 
use App\Http\Controllers\Backend\SocialController; 
use App\Http\Controllers\Backend\FeatureController; 
use App\Http\Controllers\Backend\CountryVisaController; 
use App\Http\Controllers\Backend\ServiceController; 
use App\Http\Controllers\Backend\AboutUsController; 
use App\Http\Controllers\Backend\ChooseUsController; 
use App\Http\Controllers\Backend\FaqController; 
use App\Http\Controllers\Backend\testimonialController; 
use App\Http\Controllers\Backend\BrandController; 
use App\Http\Controllers\Backend\BlogController; 
use App\Http\Controllers\Backend\AppointmentController; 
use App\Http\Controllers\Backend\PageController; 


// Old

use App\Http\Controllers\Backend\PurchaseController; 
use App\Http\Controllers\Backend\SellController; 
use App\Http\Controllers\Backend\CustomerController; 
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OrderPaymentController; 
use App\Http\Controllers\Backend\ProductController;  
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\EmployeeController; 
use App\Http\Controllers\Backend\EmployeeTypeController; 
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\ExpenseCategoryController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\MembershipTypeController;
use App\Http\Controllers\Backend\MembershipController;
use App\Http\Controllers\Backend\BusinessController;
use App\Http\Controllers\Backend\ApiController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::group(['as'=>'front.'], function() {
    Route::controller(FrontHomeController::class)->group(function(){
        Route::get('/', 'index')->name('home');
        Route::get('/{service_id}', 'service_details')->name('service_details');
        Route::get('about/page','about_page')->name('about_page');
        Route::post('make/appointment','make_appointment')->name('make.appointment');
        Route::get('contact/us','contact_us')->name('contact_us');
    });
});

// Backend

Route::group(['prefix' => 'admin','middleware' => 'auth','as'=>'admin.'], function() {

    Route::controller(ReportController::class)->group(function(){
        Route::group(['prefix' => 'reports','as'=>'reports.'], function() {

            Route::get('/worker-payment','workerPayment')->name('workerPayment');
            Route::get('/employee-payment','employeePayment')->name('employeePayment');
            Route::get('/employee-payment-history','employeePaymentHistory')->name('employeePaymentHistory');
            Route::get('/customer-payment','customerPayment')->name('customerPayment');
            Route::get('/supplier-payment','SupplierPayment')->name('supplierPayment');
            Route::get('/product-sell','productSell')->name('productSell');
            Route::get('/profit-loss','profitLoss')->name('profitLoss');
            Route::get('/account-transfer','accountTransfer')->name('accountTransfer');

            Route::get('/category-sell','categorySell')->name('categorySell');
            Route::get('/product-stock','productSTock')->name('productSTock');
            Route::get('/all-payment','allPayment')->name('allPayment');
            Route::get('/expesne','expenseReport')->name('expenseReport');
            Route::get('/order-delivery-check','orderDeliveryCheck')->name('orderDeliveryCheck');             

        });
        
    });
            
    Route::post('/ckeditor-upload',[HomeController::class,'ckeditor_upload'])->name('ckeditor.upload');
    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
    Route::resource('sliders',SliderController::class);
    Route::resource('social',SocialController::class);
    Route::resource('feature',FeatureController::class);
    Route::resource('visa_immigrations',CountryVisaController::class);    
    Route::resource('services',ServiceController::class);    
    Route::resource('abouts',AboutUsController::class);     
    Route::resource('chooses',ChooseUsController::class);     
    Route::resource('faqs',FaqController::class);     
    Route::resource('testimonials',testimonialController::class);     
    Route::resource('brands',BrandController::class);     
    Route::resource('blogs',BlogController::class);     
    Route::resource('appointments',AppointmentController::class);     
    Route::resource('pages',PageController::class);     
    
    // Old
    Route::get('/suppliers',[CustomerController::class,'getSuppliers'])->name('suppliers.index');
    Route::resource('customers',CustomerController::class);
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('purchases',PurchaseController::class);
    Route::resource('sells',SellController::class);
    Route::resource('products',ProductController::class);
    Route::resource('employees',EmployeeController::class);
    Route::resource('api-attendance',ApiController::class);
    
    Route::get('/get-employee-payment/{id}',[EmployeeController::class,'getEmployeePayment'])->name('getEmployeePayment');
    Route::post('/store-employee-payment/{id}',[EmployeeController::class,'storeEmployeePayment'])->name('storeEmployeePayment');

    
    Route::resource('attendance',AttendanceController::class);
    Route::resource('transactions',TransactionController::class);
    Route::resource('memberships',MembershipController::class);
    Route::get('/membership/payment/list',[MembershipController::class,'paymentList'])->name('memberships.paymentList');
    Route::get('/membership/get/payment',[MembershipController::class,'getPayment'])->name('memberships.getPayment');
    Route::post('/membership/store-payment',[MembershipController::class,'storePayment'])->name('memberships.storePayment');


    Route::resource('business',BusinessController::class);
    Route::resource('product-categories', ProductCategoryController::class, 
        ['names' => 'product_categories']);
    Route::resource('order-payments', OrderPaymentController::class, ['names' => 'order_payments']);
    Route::resource('employee-types', EmployeeTypeController::class, ['names' => 'employee_types']);
    Route::resource('membership-types', MembershipTypeController::class, ['names' => 'membership_types']);
    Route::resource('expense-categories', ExpenseCategoryController::class, ['names' => 'expense_categories']);

    Route::get('/get-purchase-product',[PurchaseController::class,'getPurchaseProduct'])->name('getPurchaseProduct');
    Route::get('/purchase-product-entry',[PurchaseController::class,'purchaseProductEntry'])->name('purchaseProductEntry');
    Route::get('/get-sell-product',[SellController::class,'getSellProduct'])->name('getSellProduct');
    Route::get('/sell-product-entry',[SellController::class,'sellProductEntry'])->name('sellProductEntry');
    
    Route::get('/sell-invoice/{id}',[SellController::class,'sellInvoice'])->name('sellInvoice');
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
