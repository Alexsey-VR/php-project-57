<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Http\Requests\LabelFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $labels = Label::all();

        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $label = new Label();
        $locale = app()->getLocale();

        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LabelFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Label::create($data);
        flash(__('flash.label.created'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label): View
    {
        return view('labels.show', compact('label'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LabelFormRequest $request, Label $label): RedirectResponse
    {
        $data = $request->validated();
        $label->update($data);
        flash(__('flash.label.updated'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks->count() === 0) {
            $label->delete();
            flash(__('flash.label.deleted'))->success();
        } else {
            flash(__('flash.label.restricted_delete'))->error();
        }

        return redirect()->route('labels.index');
    }
}
