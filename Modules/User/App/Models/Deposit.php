<?php

namespace Modules\User\App\Models;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Modules\Invoice\Classes\Payable;

class Deposit extends Payable implements HasMedia
{
    use InteractsWithMedia;
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_CONFIRMED = 'confirmed';

    protected $fillable = [
        'amount',
        'type',
        'user_id',
        'status'
    ];
    public static function getAvailableStatus(): array
    {
        return [static::STATUS_NEW, static::STATUS_IN_PROGRESS, static::STATUS_CONFIRMED];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('receipts')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if ($media) {
            $this->addMediaConversion('thumb')
                ->width(150)
                ->height(150);
        }
    }

    // public static function storeModel($amount)
    // {
    //     $user = Auth::user();
    //     $deposit = new static;

    //     $deposit->fill([
    //         'amount' =>  $amount,
    //         'status' => static::STATUS_WAIT_FOR_PAYMENT
    //     ]);
    //     $deposit->companion()->associate($user->id);
    //     $deposit->save();

    //     return $deposit;
    // }

    public function isPayable(): bool
    {
        return $this->status === static::STATUS_CONFIRMED;
    }

    public function getPayableAmount(): int
    {
        return (int)$this->amount;
    }

    //     public function onSuccessPayment(Invoice|\Modules\Invoice\App\Models\Invoice $invoice): View|Factory|JsonResponse|Application
    //     {
    //         $companion = $invoice->payable->companion()->first();
    //         $transaction = $companion->deposit($invoice->amount);
    //         $this->transaction()->associate($transaction);
    //         $this->status = static::STATUS_SUCCESS;
    //         $this->save();
    //         $type = 'wallet';
    //         $this->notify(new DepositWalletSuccessfulNotification($this->companion, $invoice->amount));

    //         return view('core::invoice.callback', ['invoice' => $invoice, 'type' => $type]);
    //     }

    //     public function onFailedPayment(Invoice|\Modules\Invoice\App\Models\Invoice $invoice): View|Factory|JsonResponse|Application
    //     {
    //         $this->status = static::STATUS_CANCELED;
    //         $this->save();

    //         $type = 'wallet';
    // //        $this->notify(new DepositWalletFailedNotification($this->customer, $invoice->amount));

    //         return view('core::invoice.callback', ['invoice' => $invoice, 'type' => $type]);
    // }
}
