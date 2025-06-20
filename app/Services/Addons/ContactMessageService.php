<?php

namespace App\Services\Addons;

use App\Models\Addons\ContactMessage;

class ContactMessageService
{
    public static function _get()
    {
        return ContactMessage::orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = ContactMessage::orderBy('id', 'DESC');
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%')
                    ->orWhere('phone', 'LIKE', '%'.$search.'%')
                    ->orWhere('subject', 'LIKE', '%'.$search.'%')
                    ->orWhere('message', 'LIKE', '%'.$search.'%')
                    ->orWhereDate('created_at', 'LIKE', '%'.$search.'%');
            });
        }
        return $data->paginate($per_page);
    }

    public static function _format_for_csv($data)
    {
        $array_column_heading_names = [
            'A1' => 'Date',
            'B1' => 'Name', 
            'C1' => 'Email', 
            'D1' => 'Phone', 
            'E1' => 'Subject', 
            'F1' => 'Message'
        ];
        
        $array = [];
        if ($data) {
            $i=1; // always start this from 1
            foreach($data as $key => $row) {
                $i++;
                $array[$key]['A'.$i] = date('Y-m-d H:i:s', strtotime($row->created_at));
                $array[$key]['B'.$i] = $row->name;
                $array[$key]['C'.$i] = $row->email;
                $array[$key]['D'.$i] = $row->phone;
                $array[$key]['E'.$i] = $row->subject;
                $array[$key]['F'.$i] = $row->message;
            }
        }
        
        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }
}