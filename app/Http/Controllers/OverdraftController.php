<?php

namespace App\Http\Controllers;

use App\Application;
use App\filters\OverDraftFilter;
use App\filters\RejectedApplicationFilter;
use App\Overdraft;
use App\RejectedApplication;
use App\ShortListed_Applications;
use App\Vacancy;
use Illuminate\Http\Request;

class OverdraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(OverDraftFilter $filter)
    {
        $applications = Overdraft::filter($filter)->paginate(10);
        return api()->data('applications', $applications)->build();
    }


    public function viewOverdraftApplication(Overdraft $model){
        $application = Overdraft::findorfail($model->id)->first();
        return api()->data('application', $application)->build();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyOverdraft(Request $request)
    {
        $request->validate([
            'last_name'=> ['required'],
            'first_name' => ['required'],
            'overdraft_tenure' => ['required'],
            'account_number' => ['min:12', 'required'],
            'amount' => ['required'],
        ]);

        $application = Overdraft::create([
            'last_name' => $request->get('last_name'),
            'first_name' => $request->get('first_name'),
            'overdraft_tenure' => $request->get('overdraft_tenure'),
            'account_number' => $request->get('account_number'),
            'amount' => $request->get('amount'),
            'status' => 'Applied',
            'checker' => 'Not Checked',
        ]);
        return api()->data('application', $application)->build('application submitted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Application $model)
    {

        $application = Overdraft::create([
            'status' => 'Approved',
            'approver' => auth()->user()->name,
            'applicantName' => $model->applicantName,
            'applicantSurname' => $model->applicantSurname,
            'amount' => $model->vacancy,
            'comment' => $request->get('comment'),

        ]);
        return api()->data('application', $application)->build('application approved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokedApplications(RejectedApplicationFilter $filter)
    {
        $applications = RejectedApplication::filter($filter)->paginate(10);
        return api()->data('applications', $applications)->build();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvedApplications(OverDraftFilter $filter)
    {
        $applications = Overdraft::filter($filter)->paginate(10);
        return api()->data('applications', $applications)->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokeApplication(Request $request, Application $model)
    {
        $application = RejectedApplication::create([
            'status' => 'Rejected',
            'approver' => auth()->user()->name,
            'applicantName' => $model->applicantName,
            'applicantSurname' => $model->applicantSurname,
            'amount' => $model->vacancy,
            'comment' => $request->get('comment'),

        ]);
        return api()->data('application', $application)->build('application rejected');
    }
}
