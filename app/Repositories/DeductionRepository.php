<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use App\Helpers\FileHelper;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\User;
use App\Models\DeductionFile;

class DeductionRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\DeductionFile";
    }

    public function createForInvoice(Request $request, User $user, Invoice $invoice)
    {
        $this->deleteForInvoice($invoice->id);
        $deductions = [];

        if ($request->deduction_files) {
            foreach ($request->deduction_files as $file) {
                $savedFile = FileHelper::uploadBase64File($file, 0, null, $user->id);
                if ($savedFile) {
                    $deductions[] = DeductionFile::store($invoice->id, $savedFile->id);
                }
            }
        }

        return $deductions;
    }

    private function deleteForInvoice($invoiceId)
    {
        $rows = $this->model->where('invoice_id', $invoiceId);
        return $rows->delete();
    }
}
