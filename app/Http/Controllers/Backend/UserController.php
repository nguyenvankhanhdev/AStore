<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.user-list.index');
    }
    public function admin(AdminDataTable $dataTable){
        return $dataTable->render('backend.admin.admin-list.index');
    }

}
