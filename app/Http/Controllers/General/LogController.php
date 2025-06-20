<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\General\LogService;
use App\Models\General\User;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class LogController extends Controller
{
    public function activity_logs(Request $request)
    {
        $files          = LogService::all_files();
        $selected_file  = ($request->has('selected_file') && $request->selected_file != null) ? $request->selected_file : substr(end($files), 5);

        // cached for 60 mins
        $users = cache()->remember('log-users', 3600, function () {
            return User::pluck('name', 'id')->toArray();
        });

        // cached for 15 mins
        $logs = cache()->remember('log-logs-'.$selected_file, 900, function () use($selected_file) {
            return LogService::get($selected_file);
        });

        if ($logs) {
            // cached for 15 mins
            $types = cache()->remember('log-types-'.$selected_file, 900, function () use ($logs) {
                return array_unique(array_column($logs, 1));
            });

            $logs = $this->search(
                $logs, 
                $request->search_date, 
                $request->search_type, 
                $request->search_activity, 
                $request->search_user, 
                $request->page
            );

            $selected_date = substr($selected_file, 0, 7). '-01';
            $start_date = date("m/d/Y", strtotime($selected_date));
            $end_date   = date("m/d/Y", strtotime($start_date));
        }
        else {
            $types = null;
            $start_date = null;
            $end_date   = null;
        }

        return view('modules.general.log.activity-log', compact('files', 'logs', 'users', 'types', 'start_date', 'end_date'));
    }

    public function my_logs(Request $request)
    {
        $files          = LogService::all_files();
        $selected_file  = ($request->has('selected_file') && $request->selected_file != null) ? $request->selected_file : substr(end($files), 5);

        // cached for 15 mins
        $logs = cache()->remember('log-logs-'.$selected_file, 900, function () use($selected_file) {
            return LogService::get($selected_file);
        });

        if ($logs) {
            // cached for 15 mins
            $types = cache()->remember('log-types-'.$selected_file, 900, function () use ($logs) {
                return array_unique(array_column($logs, 1));
            });

            $logs = $this->search(
                $logs, 
                $request->search_date, 
                $request->search_type, 
                $request->search_activity, 
                auth()->user()->id, 
                $request->page
            );

            $selected_date = substr($selected_file, 0, 7). '-01';
            $start_date = date("m/d/Y", strtotime($selected_date));
            $end_date   = date("m/d/Y", strtotime($start_date));
        }
        else {
            $types = null;
            $start_date = null;
            $end_date   = null;
        }

        return view('modules.general.log.my-log', compact('files', 'logs', 'types', 'start_date', 'end_date'));
    }

    private function search($logs, $search_date, $search_type, $search_activity, $search_user, $page)
    {
        $filtered_logs = $logs;

        if ($search_date != '') {
            $filtered_logs = array_filter($filtered_logs, function ($var) use($search_date) {
                return (date('Y-m-d', strtotime($var[0])) == date('Y-m-d', strtotime($search_date)));
            });
        }

        if ($search_type != '') {
            $filtered_logs = array_filter($filtered_logs, function ($var) use($search_type) {
                return ($var[1] == $search_type);
            });
        }

        if ($search_activity != '') {
            $filtered_logs = array_filter($filtered_logs, function ($var) use($search_activity) {
                return (strpos($var[2], $search_activity) !== false);
            });
        }

        if ($search_user != '') {
            $filtered_logs = array_filter($filtered_logs, function ($var) use($search_user) {
                return ($var[3] == $search_user);
            });
        }

        return $this->paginate($filtered_logs, $page);
    }

    private function paginate($items, $page)
    {
        $pageStart = $page ?? 1;
        $offSet = ($pageStart * 20) - 20; 
        $itemsForCurrentPage = array_slice($items, $offSet, 20, true);
        
        return new LengthAwarePaginator(
            $itemsForCurrentPage, 
            count($items), 
            20,
            Paginator::resolveCurrentPage(), 
            array('path' => Paginator::resolveCurrentPath())
        );
    }
}
