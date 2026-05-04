<?php

namespace Modules\User\App\Models;

use App\Models\User;
use Modules\Sms\Sms;
use Modules\Core\Classes\CoreSettings;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Log;
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
        'status_payment',
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

    public function isPayable(): bool
    {
        return $this->status_payment == 0;
    }

    public function getPayableAmount(): int
    {
        return (int)$this->amount;
    }

    public function onSuccessPayment(\Modules\Invoice\App\Models\Invoice $invoice)
    {
        $this->update([
            'status_payment' => 1,
        ]);
        $pattern = app(CoreSettings::class)->get('sms.patterns.new_help_user');
        $output = Sms::pattern($pattern)
            ->data([
                'token' => '',
            ])->to([$this->helpUser->mobile])->send();
        if ($output['status'] != 200) {
            Log::debug('', [$output]);
        }
        return $this->callBackViewPayment($invoice);
    }

    public function callBackViewPayment($invoice): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view(
            'core::invoice.callback',
            [
                'invoice' => $invoice,
                'type' => 'order'
            ]
        );
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
