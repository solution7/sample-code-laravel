<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Models\OrderRow;
use App\Models\AgreementType;
use Carbon\Carbon;
use Auth;

class AgreementRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Agreement";
    }

    public function createForOrderRows($orderRows)
    {
        $type = AgreementType::find(AgreementType::SENT_STATUS);
        $agreements = [];

        foreach ($orderRows as $orderRow) {
            $agreements[] = $this->createSingle($type, $orderRow);
        }

        return $agreements;
    }

    private function createSingle($type, $orderRow)
    {
        $profile = $orderRow->profile;

        $agreement = parent::create([
            'name' => $type->name,
            'profile_id' => $profile->id,
            'order_row_id' => $orderRow->id,
            'agreement_type_id' => $type->id,
            'content' => $type->content_key,
            'valid_from' => Carbon::now(),
        ]);

        return $agreement;
    }

    public function createForContract($request, $agreementType, $profileId, $file)
    {
        $agreement = parent::create([
            'profile_id' => $profileId,
            'name' => $request->name,
            'agreement_type_id' => $agreementType->id,
            'content' => $agreementType->content_key,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to ?? '',
            'file_id' => $file->id ?? '',
        ]);

        return $agreement;
    }

    public function deleteForContract($id)
    {
        $user = Auth::user();
        $agreement = $this->model->findOrFail($id);

        if ($user->isAdmin() || $user->profile->id == $agreement->profile_id) {
            if ($agreement->file) {
                $agreement->file->delete();
            }
            $agreement->delete();
            return 204;
        }
        return 'failed';
    }

    public function byColumn($attribute, $value)
    {
        return $this->model->where($attribute, $value);
    }
}
