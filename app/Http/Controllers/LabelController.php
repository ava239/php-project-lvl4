<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    public function index()
    {
        $labels = Label::paginate(15);

        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        $label = new Label();

        return view('labels.create', compact('label'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(
            $request,
            [
                'name' => 'required|unique:labels',
                'description' => 'max:500',
            ]
        );

        $taskStatus = new Label();
        $taskStatus->fill($data);
        $taskStatus->saveOrFail();

        flash(__('labels.created'))->success();

        return redirect()
            ->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $this->validate(
            $request,
            [
                'name' => 'required|unique:labels,name,' . $label->id,
                'description' => 'max:500',
            ]
        );

        $label->fill($data);
        $label->saveOrFail();

        flash(__('labels.updated'))->success();

        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $label->delete();
        flash(__('labels.deleted'))->success();

        return redirect()
            ->route('labels.index');
    }
}
