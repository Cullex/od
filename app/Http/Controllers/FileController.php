<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function upload(Request $request)
    {
        $request->validate([
            'vacancy' => ['required', 'mimes:pdf,doc,word,jpg,png'],
            'oLevel' => ['required', 'mimes:pdf,doc,word,jpg,png'],
            'aLevel' => ['required', 'mimes:pdf,doc,word,jpg,png'],
            'diploma' => ['mimes:pdf,doc,word,jpg,png'],
            'degree' => ['mimes:pdf,doc,word,jpg,png'],
            'masters' => ['mimes:pdf,doc,word,jpg,png'],
            'certifications' => ['mimes:pdf,doc,word,jpg,png'],
        ]);

        $files = File::query()->create([
            'oLevel' => '/storage/' .$request->file('oLevel')->store('ApplicantFiles', 'public'),
            'oLevelName' => $request->file('oLevelName')->getClientOriginalName(),
            'aLevel' => '/storage/' .$request->file('aLevel')->store('ApplicantFiles', 'public'),
            'aLevelName' => $request->file('aLevelName')->getClientOriginalName(),
            'diploma' => '/storage/' .$request->file('diploma')->store('ApplicantFiles', 'public'),
            'diplomaName' => $request->file('diplomaName')->getClientOriginalName(),
            'masters' => '/storage/' .$request->file('masters')->store('ApplicantFiles', 'public'),
            'mastersName' => $request->file('mastersName')->getClientOriginalName(),
            'degree' => '/storage/' .$request->file('degree')->store('ApplicantFiles', 'public'),
            'degreeName' => $request->file('degreeName')->getClientOriginalName(),
            'certifications' => '/storage/' .$request->file('certifications')->store('ApplicantFiles', 'public'),
            'certificationsName' => $request->file('certificationsName')->getClientOriginalName(),
            'vacancy' => '/storage/' .$request->file('vacancy')->store('VacancyFiles', 'public'),
            'vacancyName' => $request->file('certificationsName')->getClientOriginalName(),
            'userId' => auth()->user()->id,
        ]);
        return api()->data('files', $files)->build('Your Attachments Have Been Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
