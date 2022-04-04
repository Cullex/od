<?php

namespace App\Http\Controllers;
use App\filters\VacancyFilter;
use App\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(VacancyFilter $filter)
    {
        $vacancies = Vacancy::filter($filter)->paginate(10);
        return api()->data('vacancies', $vacancies)->build();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'department' => ['required'],
            'description' => ['required'],
            'category' => ['required'],
        ]);

        $vacancy = Vacancy::create([
            'title' => $request->get('title'),
            'department' => $request->get('department'),
            'description' => $request->get('description'),
            'category' => $request->get('category'),
        ]);
        return api()->data('vacancy', $vacancy)->build('vacancy successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $vacancy = Vacancy::findorfail($id);
        return api()->data('vacancy', $vacancy)->build();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
