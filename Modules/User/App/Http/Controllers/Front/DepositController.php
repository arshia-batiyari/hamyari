<?php

namespace Modules\User\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepositResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\User\App\Http\Requests\Front\StoreDepositRequest;
use Modules\User\App\Models\Deposit;
use Modules\User\App\Models\User;

class DepositController extends Controller
{
    public function store(StoreDepositRequest $request): JsonResponse
    {
        try {
            return DB::transaction(function () use ($request) {

                $validated = $request->validated();

                $user = User::create([
                    'name' => $validated['name'],
                    'mobile' => $validated['mobile'],
                ]);

                $hasImage = $request->hasFile('image');
                $depositType = $hasImage ? 'receipt' : 'online';

                $deposit = Deposit::create([
                    'user_id' => $user->id,
                    'amount' => $validated['amount'],
                    'type' => $depositType,
                    'status' => 'pending',
                ]);

                if ($depositType == 'online') {
                    $deposit->pay();
                }else{
                    $file = $request->file('image');
                
                    $deposit->addMedia($file)->toMediaCollection('receipts'); 
                }

                return redirect()->back()->with('success', 'اطلاعات با موفقیت ثبت شد ✅');
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'خطا در پردازش درخواست: ' . $e->getMessage()
            ], 500);
        }
    }
}
