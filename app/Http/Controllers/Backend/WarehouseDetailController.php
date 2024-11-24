<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WarehouseDetailDataTable;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseDetailController extends Controller
{
    public function index(WarehouseDetailDataTable $dataTable, $id)
    {
        logger("Warehouse ID from route: $id");

        $warehouse = Warehouse::findOrFail($id);

        return $dataTable->with('warehouse_id', $id)
            ->render('backend.admin.warehouse.show', compact('warehouse'));
    }
}
