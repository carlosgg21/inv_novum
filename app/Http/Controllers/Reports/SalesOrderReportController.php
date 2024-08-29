<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use App\Repositories\SalesOrderRepository;
use Illuminate\Http\Request;

class SalesOrderReportController extends Controller
{

    protected $salesOrderRepository;

    public function __construct(SalesOrderRepository $salesOrderRepository)
    {
        $this->salesOrderRepository = $salesOrderRepository;
    }

    public function salesOrder($id)
    {
        $salesOrder = $this->salesOrderRepository->findSalesOrder($id);

        // si esta invoice

        // $salesOrder->is_invoiced
        if($salesOrder->is_invoiced){
            $title = 'Invoice';
            
        }
        //si no etsa invoice imprimer la sales order o proforma invoice
        else{
            $title = 'Sales Order';
            
            // $title = 'Proforma Invoice';

        }



        $data = [
                'title'    => $title,
                'date'     => date('m/d/Y'),
                'salesOrder' => $salesOrder,

            ];

        // return view('reports.sales-order-invoice', compact('data', 'salesOrder'));


        // if ($request->has('view')) {
        //     return view('reports.sales-order-invoice', $data);
        // }
            // dd($data);
        
        return generatePDF('reports.sales-order-invoice', $data, 'sales_order.pdf');
    }
}
