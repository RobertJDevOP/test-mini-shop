<?php

namespace App\Console\Commands;

use App\Http\Controllers\PaymentController;
use App\Models\PurchasePayment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PaymentPendingPlacetopay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta los pagos pendientes de la pasarela de pagos placetopay';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(PaymentController $paymentController): void
    {
        $purchasePayments = PurchasePayment::select('id_purchase_order')
                                ->whereRaw('id_purchase_payment IN (SELECT MAX(id_purchase_payment) FROM purchase_payment GROUP BY id_purchase_order)')
                                ->where('status', 'PENDING')
                                ->orderBy('id_purchase_order', 'DESC')
                                ->limit(1)
                                ->get();

        if($purchasePayments->count() > 0) {
            foreach ($purchasePayments as $purchasePayment) {
                $response = $paymentController->getRequestInformation($purchasePayment->id_purchase_order);
                Log::info('se actualiza la transaccion en estado pendiente.',['response' => $response]);
            }
        }else {
            Log::info('No se proceso ninguna transaccion en pendiente.',[]);
            exit;
        }
    }
}
