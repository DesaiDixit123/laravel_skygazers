<?php

namespace App\Exports;

use App\Models\ContactMessage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactMessagesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Message',
            'Status',
            'Received On'
        ];
    }

    public function map($msg): array
    {
        return [
            $msg->id,
            $msg->first_name . ' ' . $msg->last_name,
            $msg->email,
            $msg->phone ?? 'N/A',
            $msg->message,
            $msg->is_read ? 'Read' : 'Unread',
            $msg->created_at->format('Y-m-d H:i:s')
        ];
    }
}
