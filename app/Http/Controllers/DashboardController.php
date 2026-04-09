<?php

namespace App\Http\Controllers;

use App\Models\Benefactor;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = Contribution::select(
            DB::raw("(sum(amount)) as total_amount"),
            DB::raw("(DATE_FORMAT(year_month_reference, '%m/%Y')) as year_month_reference")
        )->where(DB::raw("(DATE_FORMAT(year_month_reference, '%Y'))"), DB::raw("(DATE_FORMAT(CURDATE(), '%Y'))"))
            ->orderBy('year_month_reference')
            ->groupBy(DB::raw("DATE_FORMAT(year_month_reference, '%m/%Y')"))
            ->get();

        $chartArray = [];

        for ($i = 0; $i < count($chart); $i++) {
            $chartArray[$chart[$i]->year_month_reference] = $chart[$i]->total_amount;
        }

        return Inertia::render('Dashboard/Index', [
            'total_benefactors' => Benefactor::count(),
            'total_contributions' => Contribution::sum('amount'),
            'chart_contributions' => $chartArray
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
