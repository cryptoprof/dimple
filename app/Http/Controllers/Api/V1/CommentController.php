<?php
namespace App\Http\Controllers\Api\V1;

use App\Models\Comment;
use App\Models\Task;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'commentable_type' => 'required|in:Task,Customer,Project',
            'commentable_id' => 'required|integer',
            'comment' => 'required|string',
        ]);

        // Get the user ID of the authenticated user
        $userId = auth()->user()->id;

        // Create a new comment instance
        $comment = new Comment([
            'user_id' => $userId,
            'commentable_id' => $request->input('commentable_id'),
            'commentable_type' => $request->input('commentable_type'),
            'comment' => $request->input('comment'),
        ]);


        // Find the commentable record
        switch ($request->input('commentable_type')) {
            case 'Task':
                $commentable = Task::find($request->input('commentable_id'));
                break;
            case 'Customer':
                $commentable = Customer::find($request->input('commentable_id'));
                break;
            case 'Project':
                $commentable = Project::find($request->input('commentable_id'));
                break;
            default:
                return response()->json([
                    'error' => 'Invalid commentable type.',
                ], 400);
        }

        // Save the comment
        $comment->save();
        $commentable->comments()->save($comment);
        // Handle the file upload and attachment synchronization
        if ($request->hasFile('attachment')) {
            // Get the file from the request
            $file = $request->file('attachment');

            // Generate a unique filename
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            // Store the file on the server
            $path = $file->storeAs('attachments', $filename);

            // Save the path to the database
            $attachment = new Attachment([
                'path' => $path,
                'filename' => $file->getClientOriginalName(),
                'comment_id' => $comment->id
            ]);
            $attachment->save();

            // Associate the attachment with the comment
            $comment->attachments()->save($attachment);
        }
        return response()->json([
            'comment' => $comment,
        ]);
    }
}
