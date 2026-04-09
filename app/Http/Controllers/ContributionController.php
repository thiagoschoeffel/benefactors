<?php
namespace App\Http\Controllers;

use App\Models\Contribution;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contributions = Contribution::when($request->benefactor_name, function ($query, $benefactor_name) {
            $query->whereRelation('benefactor', 'name', 'like', '%' . $benefactor_name . '%');
        })->when($request->record_number, function ($query, $record_number) {
            $query->where('record_number', $record_number);
        })->when($request->year_month_reference, function ($query, $year_month_reference) {
            $query->where('year_month_reference', DateTime::createFromFormat('d/m/Y', '01/' . $year_month_reference)->format('Y-m-d'));
        })
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Contributions/Index', [
            'contributions' => $contributions,
            'filters' => $request->only(['record_number', 'name'])
        ]);

        return Inertia::render('Contributions/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Contributions/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'benefactor_id' => 'required',
            'record_number' => 'required',
            'year_month_reference' => 'required',
            'amount' => 'required'
        ], [
            'benefactor_id.required' => 'O campo código do benfeitor é obrigatório.',
            'record_number.required' => 'O campo número carnê é obrigatório.',
            'year_month_reference.required' => 'O campo mês/ano referência é obrigatório.',
            'amount.required' => 'O campo valor é obrigatório.'
        ]);

        $contribution = new Contribution();

        $contribution->benefactor_id = $request->benefactor_id;
        $contribution->record_number = $request->record_number;
        $contribution->year_month_reference = ($request->year_month_reference) ? DateTime::createFromFormat('d/m/Y', '01/' . $request->year_month_reference)->format('Y-m-d') : null;
        $contribution->amount = str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $request->amount)));
        $contribution->note = $request->note;

        $contribution->save();

        return redirect()->route('contribution.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribution $contribution)
    {
        return Inertia::render('Contributions/Edit', [
            'contribution' => $contribution
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribution $contribution)
    {
        $request->validate([
            'benefactor_id' => 'required',
            'record_number' => 'required',
            'year_month_reference' => 'required',
            'amount' => 'required'
        ], [
            'benefactor_id.required' => 'O campo código do benfeitor é obrigatório.',
            'record_number.required' => 'O campo número carnê é obrigatório.',
            'year_month_reference.required' => 'O campo mês/ano referência é obrigatório.',
            'amount.required' => 'O campo valor é obrigatório.'
        ]);

        $contribution->benefactor_id = $request->benefactor_id;
        $contribution->record_number = $request->record_number;
        $contribution->year_month_reference = ($request->year_month_reference) ? DateTime::createFromFormat('d/m/Y', '01/' . $request->year_month_reference)->format('Y-m-d') : null;
        $contribution->amount = str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $request->amount)));
        $contribution->note = $request->note;

        $contribution->save();

        return redirect()->route('contribution.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribution $contribution)
    {
        $contribution->delete();

        return redirect()->route('contribution.index');
    }

    public function report(Request $request)
    {
        $contributions = Contribution::when($request->contribution_benefactor_name, function ($query, $benefactor_name) {
            $query->whereRelation('benefactor', 'name', 'like', '%' . $benefactor_name . '%');
        })->when($request->contribution_start_date, function ($query, $start_date) {
            $query->where('year_month_reference', '>=', DateTime::createFromFormat('d/m/Y', '01/' . $start_date)->format('Y-m-d'));
        })->when($request->contribution_finish_date, function ($query, $finish_date) {
            $query->where('year_month_reference', '<=', DateTime::createFromFormat('d/m/Y', '01/' . $finish_date)->format('Y-m-d'));
        })
        ->orderBy('year_month_reference')
        ->get();

        $pdf = Pdf::loadview('pdf.contribution', [
            'contributions' => $contributions
        ]);

        return $pdf->download('contributions.pdf');
    }
}
