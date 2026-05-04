<?php

namespace Modules\Dashboard\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Companion\App\Models\Help;
use Modules\Partner\App\Models\PartnerGroup;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard::admin.index');
    }

}
