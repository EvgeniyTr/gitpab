<?php

namespace App\Http\Controllers;

use App\Model\Repository\MilestoneRepositoryEloquent;
use App\Model\Repository\RepositoryAbstractEloquent;
use App\Model\Repository\SpentRepositoryEloquent;
use App\Model\Repository\UserRepositoryEloquent;
use App\Model\Service\Eloquent\EloquentPaymentService;
use App\Model\Service\Eloquent\EloquentUserService;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var RepositoryAbstractEloquent $projectRepo */
        $projectRepo = app(AppServiceProvider::PROJECT_REPOSITORY);

        /** @var MilestoneRepositoryEloquent $milestoneRepo */
        $milestoneRepo = app(AppServiceProvider::MILESTONE_REPOSITORY);

        /** @var RepositoryAbstractEloquent $issueRepo */
        $issueRepo = app(AppServiceProvider::ISSUE_REPOSITORY);

        /** @var RepositoryAbstractEloquent $noteRepo */
        $noteRepo = app(AppServiceProvider::NOTE_REPOSITORY);

        /** @var SpentRepositoryEloquent $spentRepo */
        $spentRepo = app(AppServiceProvider::SPENT_REPOSITORY);

        /** @var UserRepositoryEloquent $userRepo */
        $userRepo = app(AppServiceProvider::USER_REPOSITORY);

        /** @var EloquentUserService $userService */
        $userService = app(AppServiceProvider::ELOQUENT_USER_SERVICE);

        /** @var EloquentPaymentService $paymentService */
        $paymentService = app(AppServiceProvider::ELOQUENT_PAYMENT_SERVICE);

        return view('home', [
            'projects' => $projectRepo->count(),
            'milestones' => $milestoneRepo->count(),
            'issues' => $issueRepo->count(),
            'notes' => $noteRepo->count(),
            'spent' => $spentRepo->sum(),
            'user' => $userRepo->activeCount(),
            'myBalance' => $userService->getBalance(Auth::user()),
            'companyBalance' => $paymentService->getBalance(),
        ]);
    }
}
