<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Standard;
use App\Models\Sub;
use App\Services\SubService;
use Auth;
use Inertia\Inertia;

class DocumentsSubsController extends Controller
{
    protected SubService $subService;

    public function __construct(SubService $subService)
    {
        $this->subService = $subService;
    }

    public function index(Standard $standard)
    {
        if (Auth::user()->major) {
            $subs = Sub::query()
                ->with('documents')
                ->byStandard($standard->id)
                ->byMajor(Auth::user()->major_id)
                ->hasDocument()
                ->get();
        } else {
            $subs = Sub::query()
                ->with('documents')
                ->byStandard($standard->id)
                ->hasDocument()
                ->get();
        }

        return Inertia::render('Documents/Subs/Index', compact('standard', 'subs'));
    }

    public function show(Standard $standard, Sub $sub)
    {
        if (Auth::user()->major) {
            $documents = Document::with(['user'])
                ->byMajorId(Auth::user()->major_id)
                ->byStandardId($standard->id)
                ->bySubId($sub->id)
                ->latest()
                ->get();
        } else {
            $documents = Document::with(['user'])
                ->byStandardId($standard->id)
                ->bySubId($sub->id)
                ->latest()
                ->get();
        }

        return Inertia::render('Documents/Subs/Show', compact('standard', 'sub', 'documents'));
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', Auth::user(), $document);

        dd($document);
    }
}
