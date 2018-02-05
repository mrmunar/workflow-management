<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\WorkflowHeader;
use App\Models\WorkflowProcess;
use App\Models\WorkflowProcessActivities;
use App\Models\ParamsActivities;

class WorkflowManagementController extends Controller
{
    public function createUpdateWorkflowHeader(Request $request){
        $this->validate($request, [
            'workflow_header_desc' => 'required',
        ]);

        $workflowHeader = WorkflowHeader::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'workflow_header_desc' => $request->input('workflow_header_desc'),
                'workflow_process_id' => $request->input('workflow_process_id')
            ]
        );

        $workflowHeader->save();

        return response()->json([
            'message' => 'Successfully saved workflow header!',
            'id' => $workflowHeader->id
        ], 201);
    }

    public function getWorkflowProcessForDropdown() {
        $workflowProcess = WorkflowProcess::select('id', 'workflow_process_desc')->get();
        return response()->json([
            'result' => $workflowProcess
        ], 201);
    }

    public function createUpdateWorkflowProcess(Request $request){
        $this->validate($request, [
            'workflow_process_desc' => 'required',
        ]);

        $workflowProcess = WorkflowProcess::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'workflow_process_desc' => $request->input('workflow_process_desc')
            ]
        );

        $workflowProcess->save();

        return response()->json([
            'message' => 'Successfully saved workflow process!',
            'id' => $workflowProcess->id
        ], 201);
    }

    public function createUpdateWorkflowProcessActivities(Request $request){
        $this->validate($request, [
            'process_id' => 'required',
            'activity_id' => 'required',
            'processor' => 'required',
        ]);

        $workflowProcessActivities = WorkflowProcessActivities::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'process_id' => $request->input('process_id'),
                'activity_id' => $request->input('activity_id'),
                'processor' => $request->input('processor'),
            ]
        );

        $workflowProcessActivities->save();

        return response()->json([
            'message' => 'Successfully saved workflow process!',
            'id' => $workflowProcessActivities->id
        ], 201);
    }

    public function getParamsActivitiesForDropdown() {
        $paramsActivities = ParamsActivities::select('id', 'activity_desc')->get();
        return response()->json([
            'result' => $paramsActivities
        ], 201);
    }

    public function checkIfProcessAndActivityExists(Request $request){
        $result = DB::table('workflow_headers AS wh')
                        ->select('workflow_process_id', 'activity_id')
                        ->leftJoin('workflow_processes AS wp', 'wh.workflow_process_id', '=', 'wp.id')
                        ->leftJoin('workflow_process_activities AS wpa', 'wp.id', '=', 'wpa.process_id')
                        ->where('wh.id', $request->input('id'))->first();
        return response()->json([
            'result' => $result
        ], 201);
    }

    public function getWorkflows(){
        $result = DB::table('workflow_headers AS wh')
                        ->select(DB::raw('wh.id, wh.workflow_header_desc, count(wpa.id) as activity_count'))
                        ->leftJoin('workflow_processes AS wp', 'wp.id', '=', 'wh.workflow_process_id')
                        ->leftJoin('workflow_process_activities AS wpa', 'wpa.process_id', '=', 'wp.id')
                        ->groupby('wh.id', 'wh.workflow_header_desc')
                        ->get();
        return response()->json([
            'result' => $result
        ], 201);
    }
}
