<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportToView implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    private $data, $view;

    public function __construct(array $data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function view(): View
    {
       return view($this->view, $this->data);
    }
}
