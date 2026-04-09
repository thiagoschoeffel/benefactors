<?php
namespace App\Http\Controllers;

use App\Models\Benefactor;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class BenefactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $benefactors = Benefactor::when($request->id, function ($query, $id) {
            $query->where('id', $id);
        })
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Benefactors/Index', [
            'benefactors' => $benefactors,
            'filters' => $request->only(['id', 'name'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Benefactors/Create');
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
            'name' => 'required',
        ], [
            'name.required' => 'O campo nome é obrigatório.'
        ]);

        $benefactor = new Benefactor();

        $benefactor->name = $request->name;
        $benefactor->birth_date = ($request->birth_date) ? DateTime::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null;
        $benefactor->primary_phone = $request->primary_phone;
        $benefactor->secondary_phone = $request->secondary_phone;
        $benefactor->email = $request->email;
        $benefactor->civil_state = $request->civil_state;
        $benefactor->note = $request->note;
        $benefactor->spouse_name = $request->spouse_name;
        $benefactor->spouse_birth_date = ($request->spouse_birth_date) ? DateTime::createFromFormat('d/m/Y', $request->spouse_birth_date)->format('Y-m-d') : null;
        $benefactor->wedding_date = ($request->wedding_date) ? DateTime::createFromFormat('d/m/Y', $request->wedding_date)->format('Y-m-d') : null;
        $benefactor->address_zip_code = $request->address_zip_code;
        $benefactor->address_street = $request->address_street;
        $benefactor->address_number = $request->address_number;
        $benefactor->address_complement = $request->address_complement;
        $benefactor->address_neighborhood = $request->address_neighborhood;
        $benefactor->address_city = $request->address_city;
        $benefactor->address_state = $request->address_state;

        $benefactor->save();

        return redirect()->route('benefactor.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Benefactor  $benefactor
     * @return \Illuminate\Http\Response
     */
    public function edit(Benefactor $benefactor)
    {
        return Inertia::render('Benefactors/Edit', [
            'benefactor' => $benefactor,
            'contributions' => $benefactor->contributions()->paginate(10),
            'contributions_amount' => $benefactor->contributions()->sum('amount')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Benefactor  $benefactor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Benefactor $benefactor)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'O campo nome é obrigatório.'
        ]);

        $benefactor->name = $request->name;
        $benefactor->birth_date = ($request->birth_date) ? DateTime::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null;
        $benefactor->primary_phone = $request->primary_phone;
        $benefactor->secondary_phone = $request->secondary_phone;
        $benefactor->email = $request->email;
        $benefactor->civil_state = $request->civil_state;
        $benefactor->note = $request->note;
        $benefactor->spouse_name = $request->spouse_name;
        $benefactor->spouse_birth_date = ($request->spouse_birth_date) ? DateTime::createFromFormat('d/m/Y', $request->spouse_birth_date)->format('Y-m-d') : null;
        $benefactor->wedding_date = ($request->wedding_date) ? DateTime::createFromFormat('d/m/Y', $request->wedding_date)->format('Y-m-d') : null;
        $benefactor->address_zip_code = $request->address_zip_code;
        $benefactor->address_street = $request->address_street;
        $benefactor->address_number = $request->address_number;
        $benefactor->address_complement = $request->address_complement;
        $benefactor->address_neighborhood = $request->address_neighborhood;
        $benefactor->address_city = $request->address_city;
        $benefactor->address_state = $request->address_state;

        $benefactor->save();

        return redirect()->route('benefactor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Benefactor  $benefactor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Benefactor $benefactor)
    {
        $benefactor->delete();

        return redirect()->route('benefactor.index');
    }

    /**
     * Find the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $benefactors = Benefactor::when($request->id, function ($query, $id) {
            $query->where('id', $id);
        })->when($request->name, function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        })->get();

        if (!$benefactors) {
            return response()->json('Nenhum benfeitor encontrado com o código informado.', 404);
        }

        return response()->json($benefactors);
    }

    public function report()
    {
        $pdf = Pdf::loadview('pdf.benefactor');

        return $pdf->download('benefactors.pdf');
    }
}
