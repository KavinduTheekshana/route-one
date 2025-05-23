<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CalanderController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PayslipsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacanciesController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;





Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('policy', [HomeController::class, 'policy'])->name('policy');
Route::get('verify', [HomeController::class, 'verify'])->name('verify');
Route::get('verify/draft', [HomeController::class, 'verifyCosDraft'])->name('verify.draft');
Route::post('/contact/store', [EnquiryController::class, 'store'])->name('contact.store');
Route::get('jobs', [HomeController::class, 'jobs'])->name('jobs');
Route::get('/vacancies/{slug}', [HomeController::class, 'vacancy'])->name('vacancies.show');
Route::get('services', [HomeController::class, 'services'])->name('services');
Route::get('user/login', [HomeController::class, 'login'])->name('user.login');
Route::get('user/register', [HomeController::class, 'register'])->name('user.register');
Route::post('user/register', [UserController::class, 'register'])->name('user.register');
Route::get('user/forgot', [HomeController::class, 'forgot'])->name('user.forgot');
Route::post('user/password/email', [HomeController::class, 'sendResetLink'])->name('user.password.email');
Route::get('password/reset/{token}', [HomeController::class, 'showResetForm'])->name('password.reset');
Route::post('user/password/update/token', [HomeController::class, 'reset'])->name('user.password.update.token');
// Route::get('/search-vacancies', [VacanciesController::class, 'search'])->name('vacancies.search');
Route::post('/vacancies/search', [VacanciesController::class, 'search'])->name('vacancies.search');
Route::post('/verify-certificate', [CertificateController::class, 'verify'])->name('certificate.verify');
Route::post('/check/cos/draft', [CertificateController::class, 'check'])->name('check.draft');

Route::get('/agent/register', [HomeController::class, 'agentRegister'])->name('agent.register');
Route::post('/agent/register', [HomeController::class, 'agentStore'])->name('agent.store');



// Route::get('/generate-application-numbers', [ApplicationController::class, 'generateApplicationNumbers']);
// Route::get('/generate-slugs', [HomeController::class, 'generateSlugs']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // User Routes
    Route::post('/user/profile/update/image', [AccountController::class, 'profile_image'])->name('user.profile.update.image');
    Route::post('/user/profile/update/details', [AccountController::class, 'profile_details'])->name('user.profile.update.details');
    Route::get('/user/application', [ApplicationController::class, 'application'])->name('user.application');
    Route::get('/user/documents', [ApplicationController::class, 'documents'])->name('user.documents');
    Route::get('/user/applied/positions', [JobApplicationController::class, 'positions'])->name('user.applied.positions');
    Route::get('/user/message', [JobApplicationController::class, 'message'])->name('user.message');
    Route::get('/user/payslips', [JobApplicationController::class, 'payslips'])->name('user.payslips');
    Route::post('/user/message/save', [JobApplicationController::class, 'save'])->name('user.message.save');
    Route::delete('/user/application/destroy/{id}', [JobApplicationController::class, 'destroy'])->name('user.application.destroy');
    Route::post('/user/application/store', [ApplicationController::class, 'store'])->name('user.application.store');
    Route::post('/user/jobs/apply', [JobApplicationController::class, 'store'])->name('user.jobs.apply');
    Route::post('/agent/register/documents', [HomeController::class, 'agentStoreDocuments'])->name('agent.store.documents');

    Route::middleware(['auth', 'status'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/monthly-data', [DashboardController::class, 'getMonthlyData'])->name('admin.monthlyData');

        Route::get('/auth/account', [DashboardController::class, 'account'])->name('auth.account');
        Route::post('/auth/profile/update', [ProfileController::class, 'profile'])->name('auth.profile.update');
        Route::post('/auth/password/update', [ProfileController::class, 'password'])->name('auth.password.update');

        Route::get('/team/manage', [UserController::class, 'team'])->name('team.manage')->middleware(['auth', 'superadmin']);
        Route::get('/team/settings/{user}', [UserController::class, 'settings'])->name('team.settings')->middleware(['auth', 'superadmin']);
        Route::get('/team/block/{user}', [UserController::class, 'block'])->name('team.block')->middleware(['auth', 'superadmin']);
        Route::get('/team/unblock/{user}', [UserController::class, 'unblock'])->name('team.unblock')->middleware(['auth', 'superadmin']);
        Route::put('/team/update/{user}', [UserController::class, 'update'])->name('team.update')->middleware(['auth', 'superadmin']);
        Route::post('/user/{user}/update-password', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware(['auth', 'superadmin']);
        Route::post('/member/store', [UserController::class, 'member_store'])->name('member.store')->middleware(['auth', 'superadmin']);
        Route::delete('/team/{user}', [UserController::class, 'destroy'])->name('team.destroy')->middleware(['auth', 'superadmin']);
        Route::get('/download-users-csv', [UserController::class, 'downloadUsersCsv'])->name('download.users.csv');
        Route::get('/agent/verification', [UserController::class, 'verification'])->name('agent.verification');
        Route::get('/agent/block/{user}', [UserController::class, 'agent_block'])->name('agent.block')->middleware(['auth', 'role:superadmin']);
        Route::get('/agent/unblock/{user}', [UserController::class, 'agent_unblock'])->name('agent.unblock')->middleware(['auth', 'role:superadmin']);

        // admin, superadmin and agent
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware(['auth', 'role:superadmin|agent']);
        Route::get('/user/manage', [UserController::class, 'users'])->name('user.manage')->middleware(['auth', 'role:superadmin|agent']);
        Route::get('/user/block/{user}', [UserController::class, 'user_block'])->name('user.block')->middleware(['auth', 'role:superadmin|agent']);
        Route::get('/user/unblock/{user}', [UserController::class, 'user_unblock'])->name('user.unblock')->middleware(['auth', 'role:superadmin|agent']);
        Route::delete('/users/{user}', [UserController::class, 'user_destroy'])->name('user.destroy')->middleware(['auth', 'role:superadmin|agent']);
        Route::post('/user/submit/details', [UserController::class, 'details'])->name('user.submit.details')->middleware(['auth', 'role:superadmin|agent']);
        Route::get('/user/settings/{user}', [UserController::class, 'user_settings'])->name('user.settings')->middleware(['auth', 'role:superadmin|agent']);
        Route::put('/user/update/{user}', [UserController::class, 'user_update'])->name('user.update')->middleware(['auth', 'role:superadmin|agent']);
        Route::post('/user-notes', [UserController::class, 'storeOrUpdate'])->name('user.notes.storeOrUpdate');
        Route::post('/messages/{sender_id}/read', [MessageController::class, 'markAsRead'])->name('messages.read');




        // Staff Management
        Route::get('/staff/manage', [UserController::class, 'staff'])->name('staff.manage')->middleware(['auth', 'role:superadmin']);
        Route::get('staff/hierarchy', [UserController::class, 'staff_hierarchy'])->name('staff.hierarchy')->middleware(['auth', 'role:superadmin']);
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create')->middleware(['auth', 'role:superadmin']);
        Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.submit.details');
        Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');





        Route::get('/admin/vacancies/list', [VacanciesController::class, 'list'])->name('admin.vacancies.list')->middleware(['auth', 'superadmin']);
        Route::get('/admin/vacancies/create', [VacanciesController::class, 'create'])->name('admin.vacancies.create')->middleware(['auth', 'superadmin']);
        Route::post('/admin/vacancies/store', [VacanciesController::class, 'store'])->name('admin.vacancies.store')->middleware(['auth', 'superadmin']);
        Route::get('/vacancies/block/{vacancies}', [VacanciesController::class, 'vacancies_block'])->name('vacancies.block')->middleware(['auth', 'superadmin']);
        Route::get('/vacancies/unblock/{vacancies}', [VacanciesController::class, 'vacancies_unblock'])->name('vacancies.unblock')->middleware(['auth', 'superadmin']);
        Route::delete('/vacancies/{vacancies}', [VacanciesController::class, 'vacancies_destroy'])->name('vacancies.destroy')->middleware(['auth', 'superadmin']);
        Route::get('/admin/vacancies/settings/{vacancies}', [VacanciesController::class, 'vacancies_settings'])->name('vacancies.settings')->middleware(['auth', 'superadmin']);
        Route::put('/admin/vacancies/update/{vacancies}', [VacanciesController::class, 'vacancies_update'])->name('admin.vacancies.update')->middleware(['auth', 'superadmin']);


        // Testimonial
        Route::get('/admin/testimonial/list', [TestimonialController::class, 'list'])->name('admin.testimonial.list')->middleware(['auth', 'superadmin']);
        Route::get('/admin/testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial.create')->middleware(['auth', 'superadmin']);
        Route::post('/admin/testimonial/store', [TestimonialController::class, 'store'])->name('admin.testimonial.store')->middleware(['auth', 'superadmin']);
        Route::put('/admin/testimonial/update/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonial.update')->middleware(['auth', 'superadmin']);
        Route::get('/testimonial/block/{testimonial}', [TestimonialController::class, 'block'])->name('testimonial.block')->middleware(['auth', 'superadmin']);
        Route::get('/testimonial/unblock/{testimonial}', [TestimonialController::class, 'unblock'])->name('testimonial.unblock')->middleware(['auth', 'superadmin']);
        Route::get('/admin/testimonial/settings/{testimonial}', [TestimonialController::class, 'testimonial_settings'])->name('testimonial.settings')->middleware(['auth', 'superadmin']);
        Route::delete('/testimonial/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy')->middleware(['auth', 'superadmin']);

        Route::resource('documents', DocumentController::class);
        Route::get('/users/{user}/documents/download', [DocumentController::class, 'downloadAll'])->name('documents.downloadAll');
        Route::get('/users/{user}/documents/pdf', [DocumentController::class, 'generatePDF'])->name('documents.pdf');
        Route::get('/users/{user}/documents/merge-pdf', [DocumentController::class, 'generateMergedPDF'])->name('documents.merge-pdf');


        // Contact Messagers
        Route::get('/admin/contact', [EnquiryController::class, 'contact'])->name('admin.contact')->middleware(['auth', 'superadmin']);
        Route::get('/contact/unread/{enquiry}', [EnquiryController::class, 'unread'])->name('contact.unread')->middleware(['auth', 'superadmin']);
        Route::get('/contact/read/{enquiry}', [EnquiryController::class, 'read'])->name('contact.read')->middleware(['auth', 'superadmin']);
        Route::delete('/contact/{enquiry}', [EnquiryController::class, 'destroy'])->name('contact.destroy')->middleware(['auth', 'superadmin']);
        Route::get('/enquiries/{id}', [EnquiryController::class, 'show'])->middleware(['auth', 'superadmin']);

        // Application
        Route::get('/admin/applications', [ApplicationController::class, 'applications'])->name('admin.applications')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::post('/user/application/update', [ApplicationController::class, 'update'])->name('user.application.update')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::post('/user/application/create', [ApplicationController::class, 'create'])->name('user.application.create')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::get('/application/approve/{id}', [ApplicationController::class, 'approve'])->name('application.approve')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::get('/application/reject/{id}', [ApplicationController::class, 'reject'])->name('application.reject')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::get('/user/settings/application/{user}', [ApplicationController::class, 'user_settings_application'])->name('user.settings.application')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::get('/issue/certificate/{user}', [CertificateController::class, 'issueCertificate'])->name('certificate.issue')->middleware(['auth', 'role:superadmin|teacher']);
        Route::post('/certificate/store', [CertificateController::class, 'store'])->name('certificates.store')->middleware(['auth', 'role:superadmin|teacher']);
        Route::put('/certificates/update/{id}', [CertificateController::class, 'update'])->name('certificates.update');
        Route::Post('/certificates/send-email', [CertificateController::class, 'sendCertificateEmail'])->name('certificates.sendEmail');
        Route::get('/certificates/download', [CertificateController::class, 'downloadCertificate'])->name('certificates.download');
        Route::get('/admin/certificate', [CertificateController::class, 'certificate'])->name('admin.certificate');
        Route::post('/assign-position', [JobApplicationController::class, 'assignPosition'])->name('assign.position');
        Route::get('/download-applications-csv', [ApplicationController::class, 'downloadApplicationsCsv'])->name('download.applications.csv');

        //  Calander application
        Route::get('/admin/calander', [CalanderController::class, 'index'])->name('admin.calander')->middleware(['auth', 'role:superadmin|teacher|agent']);
        Route::post('/admin/calander', [CalanderController::class, 'store'])->name('calander.store');
        Route::get('/admin/calander/data', [CalanderController::class, 'getData'])->name('calander.data');
        Route::get('/admin/calander/events/{id}', [CalanderController::class, 'show'])->name('admin.calander.events');
        Route::get('/search-users-calander', [CalanderController::class, 'search'])->name('users.search.calander');
        Route::post('/event/update-status', [CalanderController::class, 'updateStatus'])->name('event.updateStatus');

        //  Message management
        Route::get('/admin/message', [MessageController::class, 'index'])->name('admin.message')->middleware(['auth', 'role:superadmin|agent|teacher']);
        Route::get('/search-users', [MessageController::class, 'searchUsers'])->name('search.users');
        Route::get('/messages/{userId}', [MessageController::class, 'getMessages']);
        Route::post('/messages/store', [MessageController::class, 'sendMessage'])->name('messages.store');
        Route::get('/userdata/{userId}', [MessageController::class, 'getUser']);


        Route::resource('invoice', InvoiceController::class)->names('admin.invoice')->middleware(['auth', 'role:superadmin|agent']);
        Route::delete('/invoice/{invoice}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
        Route::delete('/invoice/agent/{invoice}', [InvoiceController::class, 'destroyAgent'])->name('invoice.destroy.agent');
        Route::get('/search-users-invoice', [InvoiceController::class, 'search'])->name('users.search.invoice');
        Route::get('/invoice/view/{invoiceId}', [InvoiceController::class, 'view'])->name('admin.invoice.view');
        Route::post('/sendpdf', [InvoiceController::class, 'sendPdf']);
        Route::patch('admin/invoice/{invoice}/toggle-status', [InvoiceController::class, 'toggleStatus'])->name('admin.invoice.toggleStatus');

        Route::get('/admin/bulk/mail', [MailController::class, 'index'])->name('admin.bulk.mail')->middleware(['auth', 'superadmin']);
        Route::POST('/send-bulk-emails', [MailController::class, 'sendBulkEmails'])->middleware(['auth', 'superadmin']);


        // Route::resource('admin/services', ServicesController::class)->names('admin.services')->middleware(['auth', 'role:superadmin|agent']);
        // Route::get('admin/services/create', [ServicesController::class, 'create'])->names('admin.services')->middleware(['auth', 'superadmin']);
        // Apply role:superadmin only to create
        Route::get('admin/services/create', [ServicesController::class, 'create'])
            ->name('admin.services.create')
            ->middleware(['auth', 'role:superadmin']);

        // Resource route for other methods
        Route::resource('admin/services', ServicesController::class)
            ->except(['create'])
            ->names('admin.services')
            ->middleware(['auth', 'role:superadmin|agent']);
        Route::patch('admin/services/{service}/toggle-status', [ServicesController::class, 'toggleStatus'])->name('admin.services.toggleStatus');

        // Route::patch('admin/services/{service}/status', [ServicesController::class, 'changeStatus'])->name('admin.services.changeStatus');
        Route::post('/update-staff-status', [UserController::class, 'updateStaffStatus'])->name('update.staff.status');
        Route::post('/payslip/store', [PayslipsController::class, 'store'])->name('payslip.store')->middleware(['auth', 'superadmin']);
        Route::resource('payslips', PayslipsController::class);

        Route::get('/application/{id}/create-draft', [ApplicationController::class, 'createDraft'])->name('draft.create');
        Route::post('/application/store-draft', [ApplicationController::class, 'storeDraft'])->name('draft.store');
        Route::get('/application/{id}/cos-draft', [ApplicationController::class, 'generateCosDraft'])->name('draft.issue');
        Route::get('/application/{id}/download-cos-draft', [ApplicationController::class, 'downloadCosDraft'])->name('draft.download');
    });
});

// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/sample', [HomeController::class, 'sample'])->name('sample')->middleware(['auth', 'superadmin']);
