<?php

namespace App\Services;

use App\Models\TransactionModel;
use App\Models\User;
use App\Repositories\Transaction\TransactionInterface;
use Carbon\Carbon;

class TransactionService
{

    protected $transactionRepo;

    protected $walletService;
    public function __construct(TransactionInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    public function getTotalRevenueRefer($from, $to, $user_id)
    {
        return $this->transactionRepo->getTotalRevenueRefer($from, $to, $user_id);
    }

    public function depositTransactionReferral($userCode, $revenue, $oldChangeRevenue, $reportInfo)
    {
        $walletService = app(WalletService::class);

        // Kiểm tra người đó có được ai giới thiệu hay không và chỉ được tính trong vòng 1 năm
        $userInfo = User::where('code', $userCode)->where('created_at', '>=', Carbon::now()->subYear())->first();
        if (empty($userInfo))
            return true;

        // Tính 5% doanh thu mới cho người được giới thiệu
        $revenueReferral = $revenue * 0.05;
        $transactionDeposit = [
            'report_id' => $reportInfo->id,
            'user_id' => $userInfo->id,
            'type' => TransactionModel::TYPE_REFERRAL,
            'title' => 'Referral for report ' . $reportInfo->id,
            'status' => TransactionModel::STATUS_SUCCESS,
            'description' => 'Referral for report ' . $reportInfo->id,
            'amount' => $revenueReferral,
            'payment_at' => $reportInfo->date
        ];

        $this->transactionRepo->create($transactionDeposit);
        // Cộng tiền vào cho refer
        $walletService->depositWallet($userInfo->id, $revenueReferral);

        // Nếu refund tiền thì - refer
        if ($oldChangeRevenue > 0)
        {
            $revenueOldReferral = $oldChangeRevenue * 0.05;
            $transactionRefundDeposit = [
                'report_id' => $reportInfo->id,
                'user_id' => $userInfo->id,
                'type' => TransactionModel::TYPE_REFUND,
                'title' => 'Refund for report ' . $reportInfo->id,
                'status' => TransactionModel::STATUS_SUCCESS,
                'description' => 'Refund for report ' . $reportInfo->id,
                'amount' => - $revenueOldReferral,
                'payment_at' => $reportInfo->date
            ];

            $this->transactionRepo->create($transactionRefundDeposit);
            // Trừ tiền vào cho refer
            $walletService->depositWallet($userInfo->id, $revenueOldReferral);
        }
        return true;
    }
}
