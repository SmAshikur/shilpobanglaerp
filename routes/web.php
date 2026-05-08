<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services/{id}', [HomeController::class, 'serviceDetails'])->name('service.details');
Route::get('/team/{id}', [HomeController::class, 'teamDetails'])->name('team.details');
Route::get('/portfolio/{id}', [HomeController::class, 'portfolioDetails'])->name('portfolio.details');
Route::get('/event/{id}', [HomeController::class, 'eventDetails'])->name('event.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact.page');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard/services', [DashboardController::class, 'services'])->name('dashboard.services');
        Route::get('/dashboard/services/create', [DashboardController::class, 'servicesCreate'])->name('dashboard.services.create');
        Route::post('/dashboard/services', [DashboardController::class, 'serviceStore']);
        Route::get('/dashboard/services/{service}', [DashboardController::class, 'serviceShow'])->name('dashboard.services.show');
        Route::get('/dashboard/services/{service}/edit', [DashboardController::class, 'serviceEdit'])->name('dashboard.services.edit');
        Route::put('/dashboard/services/{service}', [DashboardController::class, 'serviceUpdate'])->name('dashboard.services.update');
        Route::delete('/dashboard/services/{service}', [DashboardController::class, 'serviceDestroy'])->name('dashboard.services.destroy');

        Route::get('/dashboard/team', [DashboardController::class, 'team'])->name('dashboard.team');
        Route::get('/dashboard/team/create', [DashboardController::class, 'teamCreate'])->name('dashboard.team.create');
        Route::post('/dashboard/team', [DashboardController::class, 'teamStore']);
        Route::get('/dashboard/team/{member}', [DashboardController::class, 'teamShow'])->name('dashboard.team.show');
        Route::get('/dashboard/team/{member}/edit', [DashboardController::class, 'teamEdit'])->name('dashboard.team.edit');
        Route::put('/dashboard/team/{member}', [DashboardController::class, 'teamUpdate'])->name('dashboard.team.update');
        Route::delete('/dashboard/team/{member}', [DashboardController::class, 'teamDestroy'])->name('dashboard.team.destroy');

        Route::get('/dashboard/reviews', [DashboardController::class, 'reviews'])->name('dashboard.reviews');
        Route::get('/dashboard/reviews/create', [DashboardController::class, 'reviewsCreate'])->name('dashboard.reviews.create');
        Route::post('/dashboard/reviews', [DashboardController::class, 'reviewStore']);
        Route::get('/dashboard/reviews/{review}/edit', [DashboardController::class, 'reviewEdit'])->name('dashboard.reviews.edit');
        Route::put('/dashboard/reviews/{review}', [DashboardController::class, 'reviewUpdate'])->name('dashboard.reviews.update');
        Route::delete('/dashboard/reviews/{review}', [DashboardController::class, 'reviewDestroy'])->name('dashboard.reviews.destroy');

        Route::get('/dashboard/portfolio', [DashboardController::class, 'portfolio'])->name('dashboard.portfolio');
        Route::get('/dashboard/portfolio/create', [DashboardController::class, 'portfolioCreate'])->name('dashboard.portfolio.create');
        Route::post('/dashboard/portfolio', [DashboardController::class, 'portfolioStore']);
        Route::get('/dashboard/portfolio/{project}', [DashboardController::class, 'portfolioShow'])->name('dashboard.portfolio.show');
        Route::get('/dashboard/portfolio/{project}/edit', [DashboardController::class, 'portfolioEdit'])->name('dashboard.portfolio.edit');
        Route::put('/dashboard/portfolio/{project}', [DashboardController::class, 'portfolioUpdate'])->name('dashboard.portfolio.update');
        Route::delete('/dashboard/portfolio/{project}', [DashboardController::class, 'portfolioDestroy'])->name('dashboard.portfolio.destroy');

        Route::get('/dashboard/events', [DashboardController::class, 'events'])->name('dashboard.events');
        Route::get('/dashboard/events/create', [DashboardController::class, 'eventsCreate'])->name('dashboard.events.create');
        Route::get('/dashboard/events/{event}', [DashboardController::class, 'eventsShow'])->name('dashboard.events.show');
        Route::post('/dashboard/events', [DashboardController::class, 'eventStore']);
        Route::get('/dashboard/events/{event}/edit', [DashboardController::class, 'eventEdit'])->name('dashboard.events.edit');
        Route::put('/dashboard/events/{event}', [DashboardController::class, 'eventUpdate'])->name('dashboard.events.update');
        Route::delete('/dashboard/events/{event}', [DashboardController::class, 'eventDestroy'])->name('dashboard.events.destroy');
        Route::post('/dashboard/events/{event}/media', [DashboardController::class, 'mediaStore'])->name('dashboard.events.media.store');
        Route::delete('/dashboard/media/{media}', [DashboardController::class, 'mediaDestroy'])->name('dashboard.media.destroy');

        Route::get('/dashboard/messages', [DashboardController::class, 'messages'])->name('dashboard.messages');
        Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
        Route::post('/dashboard/settings', [DashboardController::class, 'settingsUpdate'])->name('dashboard.settings.update');

        Route::get('/dashboard/section-settings/{key}', [DashboardController::class, 'sectionSettings'])->name('dashboard.section-settings');
        Route::post('/dashboard/section-settings/{key}', [DashboardController::class, 'sectionSettingsUpdate'])->name('dashboard.section-settings.update');

        Route::post('/dashboard/extra-details', [DashboardController::class, 'extraDetailStore'])->name('dashboard.extra-details.store');
        Route::put('/dashboard/extra-details/{detail}', [DashboardController::class, 'extraDetailUpdate'])->name('dashboard.extra-details.update');
        Route::delete('/dashboard/extra-details/{detail}', [DashboardController::class, 'extraDetailDestroy'])->name('dashboard.extra-details.destroy');

        // ERP Modules
        Route::prefix('dashboard/erp')->name('dashboard.erp.')->group(function() {
            Route::get('/companies', [App\Http\Controllers\ERPController::class, 'companies'])->name('companies');
            Route::get('/companies/create', [App\Http\Controllers\ERPController::class, 'companyCreate'])->name('companies.create');
            Route::post('/companies', [App\Http\Controllers\ERPController::class, 'companyStore'])->name('companies.store');
            Route::get('/companies/{company}/edit', [App\Http\Controllers\ERPController::class, 'companyEdit'])->name('companies.edit');
            Route::put('/companies/{company}', [App\Http\Controllers\ERPController::class, 'companyUpdate'])->name('companies.update');
            Route::delete('/companies/{company}', [App\Http\Controllers\ERPController::class, 'companyDestroy'])->name('companies.destroy');
            Route::post('/companies/{company}/toggle-status', [App\Http\Controllers\ERPController::class, 'companyToggleStatus'])->name('companies.toggle-status');

            // HR
            Route::get('/employees', [App\Http\Controllers\ERPController::class, 'employees'])->name('employees');
            Route::get('/performance', [App\Http\Controllers\HRController::class, 'performance'])->name('performance');
            Route::post('/performance', [App\Http\Controllers\HRController::class, 'performanceStore'])->name('performance.store');
            Route::get('/recruitment', [App\Http\Controllers\HRController::class, 'recruitment'])->name('recruitment');
            Route::get('/notices', [App\Http\Controllers\HRController::class, 'notices'])->name('notices');
            Route::post('/notices', [App\Http\Controllers\HRController::class, 'noticeStore'])->name('notices.store');
            Route::get('/employees/create', [App\Http\Controllers\ERPController::class, 'employeeCreate'])->name('employees.create');
            Route::post('/employees', [App\Http\Controllers\ERPController::class, 'employeeStore'])->name('employees.store');
            Route::get('/employees/{employee}/edit', [App\Http\Controllers\ERPController::class, 'employeeEdit'])->name('employees.edit');
            Route::put('/employees/{employee}', [App\Http\Controllers\ERPController::class, 'employeeUpdate'])->name('employees.update');
            Route::delete('/employees/{employee}', [App\Http\Controllers\ERPController::class, 'employeeDestroy'])->name('employees.destroy');
            Route::post('/employees/{employee}/toggle-status', [App\Http\Controllers\ERPController::class, 'employeeToggleStatus'])->name('employees.toggle-status');
            
            Route::get('/hr/departments', [App\Http\Controllers\ERPController::class, 'departments'])->name('hr.departments');
            Route::post('/hr/departments', [App\Http\Controllers\ERPController::class, 'departmentStore'])->name('hr.departments.store');
            Route::put('/hr/departments/{department}', [App\Http\Controllers\ERPController::class, 'departmentUpdate'])->name('hr.departments.update');
            Route::delete('/hr/departments/{department}', [App\Http\Controllers\ERPController::class, 'departmentDestroy'])->name('hr.departments.destroy');
            Route::post('/hr/departments/{department}/toggle-status', [App\Http\Controllers\ERPController::class, 'departmentToggleStatus'])->name('hr.departments.toggle-status');

            Route::get('/hr/designations', [App\Http\Controllers\ERPController::class, 'designations'])->name('hr.designations');
            Route::post('/hr/designations', [App\Http\Controllers\ERPController::class, 'designationStore'])->name('hr.designations.store');
            Route::put('/hr/designations/{designation}', [App\Http\Controllers\ERPController::class, 'designationUpdate'])->name('hr.designations.update');
            Route::delete('/hr/designations/{designation}', [App\Http\Controllers\ERPController::class, 'designationDestroy'])->name('hr.designations.destroy');
            Route::post('/hr/designations/{designation}/toggle-status', [App\Http\Controllers\ERPController::class, 'designationToggleStatus'])->name('hr.designations.toggle-status');

            // Leave
            Route::get('/leave', [App\Http\Controllers\ERPController::class, 'leave'])->name('leave');

            // Attendance (Admin View)
            Route::get('/attendance', [App\Http\Controllers\ERPController::class, 'attendance'])->name('attendance');
            Route::post('/attendance', [App\Http\Controllers\ERPController::class, 'attendanceStore'])->name('attendance.store');
            Route::put('/attendance/{attendance}', [App\Http\Controllers\ERPController::class, 'attendanceUpdate'])->name('attendance.update');
            Route::delete('/attendance/{attendance}', [App\Http\Controllers\ERPController::class, 'attendanceDestroy'])->name('attendance.destroy');
            Route::get('/attendance/export/pdf', [App\Http\Controllers\ERPController::class, 'attendanceExportPdf'])->name('attendance.export.pdf');
            Route::get('/attendance/export/excel', [App\Http\Controllers\ERPController::class, 'attendanceExportExcel'])->name('attendance.export.excel');
            
            // Payroll
            Route::get('/payroll', [App\Http\Controllers\ERPController::class, 'payroll'])->name('payroll');
            
            // CRM
            // CRM - Clients
            Route::get('/clients', [App\Http\Controllers\CRMController::class, 'clients'])->name('clients');
            Route::get('/clients/create', [App\Http\Controllers\CRMController::class, 'clientCreate'])->name('clients.create');
            Route::post('/clients', [App\Http\Controllers\CRMController::class, 'clientStore'])->name('clients.store');
            Route::get('/clients/{client}/edit', [App\Http\Controllers\CRMController::class, 'clientEdit'])->name('clients.edit');
            Route::put('/clients/{client}', [App\Http\Controllers\CRMController::class, 'clientUpdate'])->name('clients.update');
            Route::delete('/clients/{client}', [App\Http\Controllers\CRMController::class, 'clientDestroy'])->name('clients.destroy');
            Route::get('/leads', [App\Http\Controllers\CRMController::class, 'leads'])->name('leads');
            Route::post('/leads', [App\Http\Controllers\CRMController::class, 'leadStore'])->name('leads.store');
            Route::get('/pipeline', [App\Http\Controllers\CRMController::class, 'pipeline'])->name('pipeline');
            Route::get('/activities', [App\Http\Controllers\CRMController::class, 'activities'])->name('activities');
            Route::get('/invoices', [App\Http\Controllers\CRMController::class, 'invoices'])->name('invoices');
            Route::get('/reports', [App\Http\Controllers\CRMController::class, 'reports'])->name('crm.reports');
            
            // Accounts
            Route::get('/accounts', [App\Http\Controllers\ERPController::class, 'accounts'])->name('accounts');
            Route::get('/projects', [App\Http\Controllers\AccountsController::class, 'projects'])->name('projects');
            Route::post('/projects', [App\Http\Controllers\AccountsController::class, 'projectStore'])->name('projects.store');
            Route::get('/assets', [App\Http\Controllers\AccountsController::class, 'assets'])->name('assets');
            Route::get('/subscriptions', [App\Http\Controllers\AccountsController::class, 'subscriptions'])->name('subscriptions');
            Route::get('/outsourcing', [App\Http\Controllers\AccountsController::class, 'outsourcing'])->name('outsourcing');
            Route::get('/financial-reports', [App\Http\Controllers\AccountsController::class, 'reports'])->name('accounts.reports');
            // Agency
            Route::get('/production', [App\Http\Controllers\AgencyController::class, 'production'])->name('production');
            Route::post('/production/task', [App\Http\Controllers\AgencyController::class, 'taskStore'])->name('production.task.store');
            Route::get('/agency-equipment', [App\Http\Controllers\AgencyController::class, 'equipment'])->name('agency.equipment');
            Route::post('/agency-equipment/loan', [App\Http\Controllers\AgencyController::class, 'loanStore'])->name('agency.loan.store');
            Route::get('/scheduler', [App\Http\Controllers\AgencyController::class, 'scheduler'])->name('scheduler');
            Route::post('/scheduler/post', [App\Http\Controllers\AgencyController::class, 'postStore'])->name('scheduler.post.store');
        });
    });

    // Common Profile access for both
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [DashboardController::class, 'profileUpdate'])->name('dashboard.profile.update');

    // Dashboard redirection/Home
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employee Portal
    Route::prefix('employee')->name('employee.')->group(function() {
        Route::get('/dashboard', [App\Http\Controllers\EmployeePortalController::class, 'index'])->name('dashboard');
        Route::get('/attendance', [App\Http\Controllers\EmployeePortalController::class, 'attendance'])->name('attendance');
        Route::get('/profile', [App\Http\Controllers\EmployeePortalController::class, 'profile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\EmployeePortalController::class, 'profileUpdate'])->name('profile.update');
        Route::post('/check-in', [App\Http\Controllers\EmployeePortalController::class, 'checkIn'])->name('check-in');
        Route::post('/check-out', [App\Http\Controllers\EmployeePortalController::class, 'checkOut'])->name('check-out');
        Route::post('/break-start', [App\Http\Controllers\EmployeePortalController::class, 'breakStart'])->name('break-start');
        Route::post('/break-end', [App\Http\Controllers\EmployeePortalController::class, 'breakEnd'])->name('break-end');
        Route::post('/tasks/{task}', [App\Http\Controllers\EmployeePortalController::class, 'updateTask'])->name('tasks.update');
    });
});
