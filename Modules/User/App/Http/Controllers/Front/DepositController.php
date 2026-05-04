<?php

namespace Modules\User\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\User\App\Http\Requests\Front\StoreDepositRequest;
use Modules\User\App\Http\Resources\DepositResource;
use Modules\User\App\Models\Deposit;
use Modules\User\App\Models\User;

class DepositController extends Controller
{
    public function store(StoreDepositRequest $request): JsonResponse
    {
        try {
            return DB::transaction(function () use ($request) {

                $validated = $request->validated();
                $mobile = $validated['mobile'];

                $user = User::updateOrCreate(
                    ['mobile' => $mobile],
                    [
                        'name' => $validated['name']
                    ]
                );

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
                } else {
                    $file = $request->file('image');

                    $deposit->addMedia($file)->toMediaCollection('receipts');
                }

                return response()->json([
                    'message' => 'اطلاعات با موفقیت ثبت شد ✅',
                    'data' => new DepositResource($deposit),
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'خطا در پردازش درخواست: ' . $e->getMessage()
            ], 500);
        }
    }
}
