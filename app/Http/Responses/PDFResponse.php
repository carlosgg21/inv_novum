<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use PDF;

class PDFResponse implements Responsable
{
    protected $view;
    protected $data;
    protected $filename;

    public function __construct($view, $data, $filename = 'document.pdf')
    {
        $this->view = $view;
        $this->data = $data;
        $this->filename = $filename;
    }

    public function toResponse($request)
    {
        $pdf = PDF::loadView($this->view, $this->data);        

        return $pdf->stream($this->filename);
    }
}
