<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public static function save($model,$model_id, $event, $message, $req, $ip, $user_id)
    {

        $log = new ActivityLog();
        $log->model     = $model;
        $log->model_id  = $model_id;
        $log->event     = $event;
        $log->message   = $message;
        $log->request   = $req;
        $log->ip        = $ip;
        $log->user_id   = $user_id;
        $logsave        = $log->save();

        if ($logsave) {
            return true;
        } else {
            return false;
        }
    }

    public function list()
    {
        $data = (object)[];

        $data->data = ActivityLog::select(['event', 'message', 'users.name as username', 'logs.created_at as created'])
            ->leftJoin('users', 'users.id', 'logs.user_id')
            ->get();

        $data->total = $data->data->count();

        return $data;
    }
}
