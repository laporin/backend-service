<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportRequest;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ReportCollection
     */
    public function index(): ReportCollection
    {
        return new ReportCollection(Report::where(['private' => false])->paginate());
    }

    public function me(): ReportCollection
    {
        $userId = Auth::user()->id;
        return new ReportCollection(Report::where(['user_id' => $userId])->paginate());
    }

    public function all(): ReportCollection
    {
        return new ReportCollection(Report::all());
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
     * @param  \Illuminate\Http\CreateReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReportRequest $request)
    {
        $report = Report::create([
            'serial' => Report::generateSerial(),
            'user_id' => $request->user()->id,
            'category_id' => $request->category_id,
            'detail' => $request->detail,
            'address' => $request->address,
            'city' => $request->city,
            'subdistrict' => $request->subdistrict,
            'latitude' => floatval($request->latitude),
            'longitude' => floatval($request->longitude),
            'private' => filter_var($request->private, FILTER_VALIDATE_BOOLEAN),
        ]);

        if ($request->hasFile('images')) {
            $report->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('reports', 'gcs');
                });
        }

        return new ReportResource($report);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ReportResource(Report::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
