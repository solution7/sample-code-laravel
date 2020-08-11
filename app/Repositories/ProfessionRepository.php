<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use Illuminate\Http\Request;

use App\Models\Profession;
use App\Models\Language;

class ProfessionRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Profession";
    }

    public function getFromName(Request $request)
    {
        $name = $request['name'];

        $results = Profession::where('name', 'LIKE', '%'.$name.'%')->get();

        $mappedResults = array_map(array($this, 'mapToLegacyFormat'), $results->toArray());

        return response()->json(['data' => $mappedResults]);
    }

    protected function mapToLegacyFormat($profession)
    {
        return [
            'id' => $profession['id'],
            'value' => $profession['name'],
            'lang_id' => $profession['language_id']
        ];
    }
}
