<?php

namespace App\Http\Controllers;
use App\Application;
use App\filters\ApplicationFilter;
use App\filters\ShortListed_ApplicationsFilter;
use App\ShortListed_Applications;
use App\Vacancy;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Vacancy $model){

        $check = Application::query()->where(['applicantSurname' => auth()->user()->last_name, 'vacancy' => $model->title])->first();
        if ($check == true){
            return api()->success(false)->build('You Already Applied');
        }
        else{

            $application = Application::query()->create([
                'applicantName' => auth()->user()->name,
                'applicantSurname' => auth()->user()->last_name,
                'vacancy' => $model->title,
                'status' => 'Applied',
            ]);
            return api()->data('application', $application)->build('Application Successfully Submitted');
        }
    }

    public function appliedVacancies(ApplicationFilter $filter){
        $appliedVacancies = Application::filter($filter)->where(['applicantSurname' => auth()->user()->last_name])->paginate(10);
        return api()->data('appliedVacancies', $appliedVacancies)->build('applied vacancies list');
    }

    public function selectApplication(Application $model){
        $application = Application::findorfail($model->id)->first();
        return api()->data('application', $application)->build();
    }

    public function revokeApplication(Application $model){
        $application = Application::findorfail($model->id)->delete();
        return api()->data('application', $application)->build('application revoked');
    }

    public function receivedApplications(ApplicationFilter $filter){
        $applications = Application::filter($filter)->paginate(10);
        return api()->data('applications', $applications)->build();
    }

    public function viewApplication(Application $model){
        $application = Application::findorfail($model->id)->first();
        return api()->data('application', $application)->build();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function shortlist(Request $request,Application $model){
        $model->update([
            'decision' => 'Shortlisted',
            'interviewDate' => $request->get('interviewDate'),
            'interviewTime' => $request->get('interviewTime'),
        ]);

        $request->validate([
            'interviewDate' => ['required', 'after:yesterday'],
            'interviewTime' => ['required'],
        ]);

        $application = ShortListed_Applications::query()->create([
            'decision' => 'Shortlisted',
            'interviewDate' => $request->get('interviewDate'),
            'interviewTime' => $request->get('interviewTime'),
            'applicantName' => $model->applicantName,
            'applicantSurname' => $model->applicantSurname,

        ]);
        return api()->data('application', $application)->build('applicant shortlisted');
    }

    public function shortListed(ShortListed_ApplicationsFilter $filter){

        $applications = ShortListed_Applications::filter($filter)->paginate(10);
        return api()->data('applications', $applications)->build();
    }

    public function viewShortList(ShortListed_Applications $model){
        $applicant = ShortListed_Applications::where(['id' => $model->id])->first();
        return api()->data('applicant', $applicant)->build();
    }

    public function revokeShortListing(ShortListed_Applications $model){

        $application = ShortListed_Applications::where(['id' => $model->id])->delete();
        return api()->data('application', $application)->build('revoked successfully');
    }

}
