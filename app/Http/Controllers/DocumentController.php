<?php

namespace App\Http\Controllers;

use App\Application;
use App\filters\DocumentFilter;
use App\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    protected  $helper = [
        'application' => Application::class,
    ];

    public function index(DocumentFilter $filter , int $id , string $type ) :  JsonResponse {

        $files = Document::filter($filter , [
            'document_type' => $this->helper[$type],
            'document_id' => $id,
        ])->paginate(\request('size') ?? 100);

        return api()
            ->data('documents' , $files)
            ->build();

    }

    public function upload(Request $request , int $id , string $type ) : JsonResponse {

        $request->validate([
            'file' => ['required']
        ]);

        if (isset($this->helper[$type]))
        {
            // Create Document

            $file = $request->file('file');
            $path = '/storage/' . $file->store($type , 'public');

            $load = [
                'doc'  => '/img/doc.png',
                'docx'  => '/img/doc.png',
                'csv'  => '/img/excel.png',
                'xls'  => '/img/excel.png',
                'xlsx'  => '/img/excel.png',
                'pdf'  => '/img/pdf.png',
            ];

            if (isset($load[$file->getClientOriginalExtension()])){
                $thumbnail  = $load[$file->getClientOriginalExtension()];
            } else {
                $thumbnail = "/img/unkown.png";
            }

            /** @var Document $item */
            $item = Document::query()->create([
                'document_id' => $id,
                'document_type' => $this->helper[$type],
                'name' => $file->getClientOriginalName(),
                'ext' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'path' => $path,
                'thumbnail' => $thumbnail,
                'user_id' => auth()->id(),
            ]);

            // Optimize Image

            return api()->success()->data('file' , $item)->message('Document was successfully uploaded')->build();
        }

        return api()->fail()->build();
    }

    public function terms()
    {
        return response()->download(public_path('files/TERMS AND CONDITIONS CORPORATE ONLINE BANKING.docx'));
    }

    public function manuals()
    {
        return response()->download(public_path('files/INTERNET BANKING CORPORATE.pdf'));
    }

    public function faqs()
    {
        return response()->download(public_path('files/online banking FAQS-01.pdf'));
    }

    public function reg_amendment()
    {
        return response()->download(public_path('files/ONLINE BANKING USER DETAILS AMENDMENT FORM.pdf'));
    }


    public function download(Document $document) : BinaryFileResponse
    {
        return response()->download(public_path($document->path) , $document->name );
    }


    /**
     * @param Document $document
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Document $document)
    {

        $types = [
            'path',
        ];

        foreach ($types as $type)
        {
            $path = public_path($document->$type);
            if (file_exists($path))
            {
                File::delete($path);
            }
        }

        $document->delete();
        return api()->build('Document was successfully deleted');
    }
}

