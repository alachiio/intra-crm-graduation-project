<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Omarashi\LaravelDatatables\Column;
use Omarashi\LaravelDatatables\LaravelDatatables;

class PaymentController extends BaseController
{
    protected $model = Payment::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $select = [
                'payments.id',
                'contacts.name',
                'payments.amount',
                'payments.receipt',
                'payments.note',
                'payments.status',
                'payments.created_at'
            ];
            $columns = [
                Column::name('name')
                    ->title(__('Name'))
                    ->add(),
                Column::name('amount')
                    ->title(__('Amount'))
                    ->add(),
                Column::name('receipt')
                    ->title(__('Receipt'))
                    ->html('<a href="/{val}"><i class="fa-solid fa-file"></i> ' . __('View Receipt') . '</a>')
                    ->add(),
                Column::name('note')
                    ->title(__('Note'))
                    ->add(),
                Column::name('status as confirmed')
                    ->title(__('Confirmed'))
                    ->add(),
                Column::name('created_at as created')
                    ->title(__('Created at'))
                    ->add()
            ];

            $query = $this->model::query()
                ->leftJoin('contacts', 'payments.contact_id', '=', 'contacts.id')
                ->select($select);
            if (request()->has('trashed'))
                $query = $query->onlyTrashed();
            return LaravelDatatables::eloquent($query)->columns($columns)->json();
        }
        return parent::index();
    }
}
