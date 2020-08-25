<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository;

class LoanSimulationController extends Controller
{
    protected $institutionsFees = [];

    public function __construct(Repository\InstitutionFeeRepository $institutionsFees) {
        $this->institutionsFees = $institutionsFees;
    }

    public function index(Request $request) {
        $input = $request->only(['valor_emprestimo', 'instituicoes', 'convenios', 'parcela']);

        if (!isset($input['valor_emprestimo'])) 
            return response(400)->json(["error" => "Campo valor_emprestimo ausente ou incorreto."]);

        $valor_emprestimo = floatval($input['valor_emprestimo']);
        $filters = $this->institutionsFees->all();

        if(isset($input['instituicoes'])) {
            $institutionsFilter = $input['instituicoes'];
            $filters = array_filter($filters, function ($institutionFee) use ($institutionsFilter) {
                return in_array($institutionFee['instituicao'], $institutionsFilter);
            });
        }

        if(isset($input['convenios'])) {
            $insuranceCompaniesFilter = $input['convenios'];
            $filters = array_filter($filters, function ($institutionFee) use ($insuranceCompaniesFilter) {
                return in_array($institutionFee['convenio'], $insuranceCompaniesFilter);
            });
        }

        if(isset($input['parcela'])) {
            $portionFilter = $input['parcela'];
            $filters = array_filter($filters, function ($institutionFee) use ($portionFilter) {
                return $institutionFee['parcelas'] == $portionFilter;
            });
        }

        $result = [];
        
        foreach ($filters as $filter) {
            $fee = [
                "valor_parcela" => $valor_emprestimo * $filter["coeficiente"],
                "parcelas" => $filter["parcelas"],
                "taxa" => $filter["taxaJuros"],
                "convenio" => $filter["convenio"]
            ];

            if (array_key_exists($filter['instituicao'], $result)) {
                array_push($result[$filter['instituicao']], $fee);
            } else {
                $result[$filter['instituicao']] = [ $fee ];
            }
        }

        return response()->json($result);
    }
}
