<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\WorkflowHeader;

class WorkflowManagementController extends Controller
{
    public function createWorkflowHeader(Request $request){
        $this->validate($request, [
            'workflow_header_desc' => 'required',
        ]);

        $workflowHeader = new WorkflowHeader([
            'workflow_header_desc' => $request->input('workflow_header_desc'),
            'workflow_process_id' => $request->input('workflow_process_id')
        ]);

        $workflowHeader = WorkflowHeader::updateOrCreate(
            ['id' => $request->input('workflow_header_id')],
            [
                'workflow_header_desc' => $request->input('workflow_header_desc'),
                'workflow_process_id' => $request->input('workflow_process_id')
            ]
        );

        $workflowHeader->save();

        return response()->json([
            'message' => 'Successfully created workflow header!'
        ], 201);
    }
}
