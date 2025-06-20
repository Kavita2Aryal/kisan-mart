<?php

namespace App\Services\Addons;

use App\Models\Addons\NewsletterClient;

class NewsletterClientService
{
    public static function _get()
    {
        return NewsletterClient::orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = NewsletterClient::orderBy('id', 'DESC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('email', 'LIKE', '%'.$search.'%')
                    ->orWhereDate('created_at', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _format_for_csv($data)
    {
        $array_column_heading_names = [
            'A1' => 'Email', 
            'B1' => 'Created Date'
        ];
        
        $array = [];
        if ($data) {
            $i=1; // always start this from 1
            foreach($data as $key => $row) {
                $i++;
                $array[$key]['A'.$i] = $row->email;
                $array[$key]['B'.$i] = date('Y-m-d H:i:s', strtotime($row->created_at));
            }
        }
        
        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }
}