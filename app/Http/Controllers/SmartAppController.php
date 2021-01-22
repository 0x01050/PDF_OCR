<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Application;
use App\Models\Field;

class SmartAppController extends Controller
{
    public function extractFields($id, &$ret_arr) {
        $fields = Field::where('app_id', $id)->get();
        foreach($fields as $field) {
            $key = $field->type;
            if($field->model)
                $key .= '_' . $field->model;
            if($field->sub) {
                $sub = $field->sub;
                if(!isset($ret_arr[$key])) {
                    $ret_arr[$key] = array();
                }
                if(!isset($ret_arr[$key][$sub])) {
                    $ret_arr[$key][$sub] = array();
                }
                $ret_arr[$key][$sub][$field->name] = $field->value;
            }
            else {
                $key .= '_' . $field->name;
                $ret_arr[$key] = $field->value;
            }
        }
    }

    public function createApp($name) {
        $app = Application::create(['name' => $name]);
        return Redirect::to(route('smartapp.edit', ['id' => $app->id]));
    }

    public function editApp($id) {
        return Redirect::to(route('smartapp.start', ['id' => $id]));
    }
    public function exportPDF($id) {
        $fields = array();
        $this->extractFields($id, $fields);
        $ret_file = writeToPDF($fields);

        $down_file = $id;
        $app = Application::where('id', $id)->first();
        if($app) {
            $down_file = $app->name;
        }
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Storage::download($ret_file, $down_file.'.pdf', $headers);
    }
    public function exportFNM($id) {
        $fields = array();
        $this->extractFields($id, $fields);
        $ret_file = writeToFNM($fields);

        $down_file = $id;
        $app = Application::where('id', $id)->first();
        if($app) {
            $down_file = $app->name;
        }
        $headers = array(
            'Content-Type: application/octet-stream',
        );
        return Storage::download($ret_file, $down_file.'.fnm', $headers);
    }

    public function getApps() {
        $apps = Application::all();
        return Response::json(array(
            'data' => $apps
        ));
    }
    public function updateField(Request $request, $id) {
        $formdata = $request->all();
        $value = $formdata['value'];
        unset($formdata['value']);
        $formdata['app_id'] = $id;
        $field = Field::firstOrNew($formdata);
        $field->value = $value;
        $field->save();
    }

    private function baseView($name, $parameters) {
        $this->extractFields($parameters['id'], $parameters);
        return view($name, $parameters);
    }

    public function startApp($id) {
        return $this->baseView('smartapp.start',
            ['id' => $id, 'top'=>'start', 'subtitle' => 'Start']
        );
    }

    private $borrowerSubMenu = [
        array(
            'name' => 'info', 'title' => 'Borrower Info', 'link' => 'smartapp.borrower.info'
        ),
        array(
            'name' => 'address', 'title' => 'Address', 'link' => 'smartapp.borrower.address'
        ),
        array(
            'name' => 'employment', 'title' => 'Employment', 'link' => 'smartapp.borrower.employment'
        ),
        array(
            'name' => 'income', 'title' => 'Income', 'link' => 'smartapp.borrower.income'
        )
    ];
    public function borrowerInfo($id) {
        return $this->baseView('smartapp.borrower.info',
            ['id' => $id, 'top'=>'borrower', 'bottom' => 'info', 'menu' => $this->borrowerSubMenu, 'subtitle' => 'Borrower\'s Information']
        );
    }
    public function borrowerAddress($id) {
        return $this->baseView('smartapp.borrower.address',
            ['id' => $id, 'top'=>'borrower', 'bottom' => 'address', 'menu' => $this->borrowerSubMenu, 'subtitle' => 'Borrower\'s Address']
        );
    }
    public function borrowerEmployment($id) {
        $maxEmp = Field::where(array(
            'app_id' => $id,
            'type' => 'borrower',
            'model' => 'employment'
        ))->max('sub');
        if(!$maxEmp) {
            $maxEmp = 0;
        }
        return $this->baseView('smartapp.borrower.employment',
            ['id' => $id, 'new_emp' => $maxEmp + 1, 'top'=>'borrower', 'bottom' => 'employment', 'menu' => $this->borrowerSubMenu, 'subtitle' => 'Borrower\'s Employment History (List 2 Years of Employment)']
        );
    }
    public function borrowerEmploymentEdit($id, $emp_id) {
        return $this->baseView('smartapp.borrower.employment-edit',
            ['id' => $id, 'emp_id' => $emp_id, 'top'=>'borrower', 'remove' => route('smartapp.borrower.employment.remove', ['id' => $id, 'emp_id' => $emp_id]), 'subtitle' => 'Borrower\'s Employment History (List 2 Years of Employment)']
        );
    }
    public function borrowerEmploymentRemove($id, $emp_id) {
        Field::where(array(
            'app_id' => $id,
            'type' => 'borrower',
            'model' => 'employment',
            'sub' => $emp_id
        ))->delete();
        return Redirect::to(route('smartapp.borrower.employment', ['id' => $id]));
    }
    public function borrowerIncome($id) {
        return $this->baseView('smartapp.borrower.income',
            ['id' => $id, 'top'=>'borrower', 'bottom' => 'income', 'menu' => $this->borrowerSubMenu, 'subtitle' => 'Borrower Monthly Income']
        );
    }

    private $coborrowerSubMenu = [
        array(
            'name' => 'info', 'title' => 'Borrower Info', 'link' => 'smartapp.coborrower.info'
        ),
        array(
            'name' => 'address', 'title' => 'Address', 'link' => 'smartapp.coborrower.address'
        ),
        array(
            'name' => 'employment', 'title' => 'Employment', 'link' => 'smartapp.coborrower.employment'
        ),
        array(
            'name' => 'income', 'title' => 'Income', 'link' => 'smartapp.coborrower.income'
        )
    ];
    public function coborrowerInfo($id) {
        return $this->baseView('smartapp.coborrower.info',
            ['id' => $id, 'top'=>'coborrower', 'bottom' => 'info', 'menu' => $this->coborrowerSubMenu, 'subtitle' => 'Co-Borrower\'s Information']
        );
    }
    public function coborrowerAddress($id) {
        return $this->baseView('smartapp.coborrower.address',
            ['id' => $id, 'top'=>'coborrower', 'bottom' => 'address', 'menu' => $this->coborrowerSubMenu, 'subtitle' => 'Co-Borrower\'s Address']
        );
    }
    public function coborrowerEmployment($id) {
        $maxEmp = Field::where(array(
            'app_id' => $id,
            'type' => 'coborrower',
            'model' => 'employment'
        ))->max('sub');
        if(!$maxEmp) {
            $maxEmp = 0;
        }
        return $this->baseView('smartapp.coborrower.employment',
            ['id' => $id, 'new_emp' => $maxEmp + 1, 'top'=>'coborrower', 'bottom' => 'employment', 'menu' => $this->coborrowerSubMenu, 'subtitle' => 'Co-Borrower\'s Employment History (List 2 Years of Employment)']
        );
    }
    public function coborrowerEmploymentEdit($id, $emp_id) {
        return $this->baseView('smartapp.coborrower.employment-edit',
            ['id' => $id, 'emp_id' => $emp_id, 'top'=>'coborrower', 'remove' => route('smartapp.borrower.employment.remove', ['id' => $id, 'emp_id' => $emp_id]), 'subtitle' => 'Co-Borrower\'s Employment History (List 2 Years of Employment)']
        );
    }
    public function coborrowerEmploymentRemove($id, $emp_id) {
        Field::where(array(
            'app_id' => $id,
            'type' => 'coborrower',
            'model' => 'employment',
            'sub' => $emp_id
        ))->delete();
        return Redirect::to(route('smartapp.coborrower.employment', ['id' => $id]));
    }
    public function coborrowerIncome($id) {
        return $this->baseView('smartapp.coborrower.income',
            ['id' => $id, 'top'=>'coborrower', 'bottom' => 'income', 'menu' => $this->coborrowerSubMenu, 'subtitle' => 'Co-Borrower Monthly Income']
        );
    }

    private $propertySubMenu = [
        array(
            'name' => 'loan', 'title' => 'Loan Info', 'link' => 'smartapp.property.loan'
        ),
        array(
            'name' => 'purpose', 'title' => 'Purpose', 'link' => 'smartapp.property.purpose'
        )
    ];
    public function propertyLoan($id) {
        return $this->baseView('smartapp.property.loan',
            ['id' => $id, 'top'=>'property', 'bottom' => 'loan', 'menu' => $this->propertySubMenu, 'subtitle' => 'Loan Information']
        );
    }
    public function propertyPurpose($id) {
        return $this->baseView('smartapp.property.purpose',
            ['id' => $id, 'top'=>'property', 'bottom' => 'purpose', 'menu' => $this->propertySubMenu, 'subtitle' => 'Loan Purpose']
        );
    }

    private $financialSubMenu = [
        array(
            'name' => 'liquid', 'title' => 'Liquid Assets', 'link' => 'smartapp.financial.liquid'
        ),
        array(
            'name' => 'combined', 'title' => 'Combined Housing Expense', 'link' => 'smartapp.financial.combined'
        ),
        array(
            'name' => 'autos', 'title' => 'Autos', 'link' => 'smartapp.financial.autos'
        ),
        array(
            'name' => 'estate', 'title' => 'Real Estate Owned', 'link' => 'smartapp.financial.estate'
        ),
        array(
            'name' => 'other', 'title' => 'Other Assets', 'link' => 'smartapp.financial.other'
        )
    ];
    public function financialLiquid($id) {
        $maxLiq = Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'liquid'
        ))->max('sub');
        if(!$maxLiq) {
            $maxLiq = 0;
        }
        return $this->baseView('smartapp.financial.liquid',
            ['id' => $id, 'new_liq' => $maxLiq + 1, 'top'=>'financial', 'bottom' => 'liquid', 'menu' => $this->financialSubMenu, 'subtitle' => 'Liquid Assets']
        );
    }
    public function financialLiquidEdit($id, $liq_id) {
        return $this->baseView('smartapp.financial.liquid-edit',
            ['id' => $id, 'liq_id' => $liq_id, 'top'=>'financial', 'remove' => route('smartapp.financial.liquid.remove', ['id' => $id, 'liq_id' => $liq_id]), 'subtitle' => 'List checking and savings accounts below']
        );
    }
    public function financialLiquidRemove($id, $liq_id) {
        Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'liquid',
            'sub' => $liq_id
        ))->delete();
        return Redirect::to(route('smartapp.financial.liquid', ['id' => $id]));
    }
    public function financialCombined($id) {
        return $this->baseView('smartapp.financial.combined',
            ['id' => $id, 'top'=>'financial', 'bottom' => 'combined', 'menu' => $this->financialSubMenu, 'subtitle' => 'Combined Housing Expense']
        );
    }
    public function financialAutos($id) {
        $maxAut = Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'autos'
        ))->max('sub');
        if(!$maxAut) {
            $maxAut = 0;
        }
        return $this->baseView('smartapp.financial.autos',
            ['id' => $id, 'new_aut' => $maxAut + 1, 'top'=>'financial', 'bottom' => 'autos', 'menu' => $this->financialSubMenu, 'subtitle' => 'Automobiles']
        );
    }
    public function financialAutosEdit($id, $aut_id) {
        return $this->baseView('smartapp.financial.autos-edit',
            ['id' => $id, 'aut_id' => $aut_id, 'top'=>'financial', 'remove' => route('smartapp.financial.autos.remove', ['id' => $id, 'aut_id' => $aut_id]), 'subtitle' => 'Add Automobile']
        );
    }
    public function financialAutosRemove($id, $aut_id) {
        Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'autos',
            'sub' => $aut_id
        ))->delete();
        return Redirect::to(route('smartapp.financial.autos', ['id' => $id]));
    }
    public function financialEstate($id) {
        $maxEst = Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'estate'
        ))->max('sub');
        if(!$maxEst) {
            $maxEst = 0;
        }
        return $this->baseView('smartapp.financial.estate',
            ['id' => $id, 'new_est' => $maxEst + 1, 'top'=>'financial', 'bottom' => 'estate', 'menu' => $this->financialSubMenu, 'subtitle' => 'Real Estate Owned']
        );
    }
    public function financialEstateEdit($id, $est_id) {
        return $this->baseView('smartapp.financial.estate-edit',
            ['id' => $id, 'est_id' => $est_id, 'top'=>'financial', 'remove' => route('smartapp.financial.estate.remove', ['id' => $id, 'est_id' => $est_id]), 'subtitle' => 'Real Estate Schedule']
        );
    }
    public function financialEstateRemove($id, $est_id) {
        Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'estate',
            'sub' => $est_id
        ))->delete();
        return Redirect::to(route('smartapp.financial.estate', ['id' => $id]));
    }
    public function financialOther($id) {
        $maxOth = Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'other'
        ))->max('sub');
        if(!$maxOth) {
            $maxOth = 0;
        }
        return $this->baseView('smartapp.financial.other',
            ['id' => $id, 'new_oth' => $maxOth + 1, 'top'=>'financial', 'bottom' => 'other', 'menu' => $this->financialSubMenu, 'subtitle' => 'Other Assets']
        );
    }
    public function financialOtherEdit($id, $oth_id) {
        return $this->baseView('smartapp.financial.other-edit',
            ['id' => $id, 'oth_id' => $oth_id, 'top'=>'financial', 'remove' => route('smartapp.financial.other.remove', ['id' => $id, 'oth_id' => $oth_id]), 'subtitle' => 'Other Assets (itemize)']
        );
    }
    public function financialOtherRemove($id, $oth_id) {
        Field::where(array(
            'app_id' => $id,
            'type' => 'financial',
            'model' => 'other',
            'sub' => $oth_id
        ))->delete();
        return Redirect::to(route('smartapp.financial.other', ['id' => $id]));
    }

    private $disclosuresSubMenu = [
        array(
            'name' => 'borrower', 'title' => 'Borrower', 'link' => 'smartapp.disclosures.borrower'
        ),
        array(
            'name' => 'coborrower', 'title' => 'Co-Borrower', 'link' => 'smartapp.disclosures.coborrower'
        ),
        array(
            'name' => 'demographic', 'title' => 'Demographic', 'link' => 'smartapp.disclosures.demographic'
        )
    ];
    public function disclosuresBorrower($id) {
        return $this->baseView('smartapp.disclosures.borrower',
            ['id' => $id, 'top'=>'disclosures', 'bottom' => 'borrower', 'menu' => $this->disclosuresSubMenu, 'subtitle' => 'Borrower\'s Declarations']
        );
    }
    public function disclosuresCoborrower($id) {
        return $this->baseView('smartapp.disclosures.coborrower',
            ['id' => $id, 'top'=>'disclosures', 'bottom' => 'coborrower', 'menu' => $this->disclosuresSubMenu, 'subtitle' => 'Co-Borrower\'s Declarations']
        );
    }
    public function disclosuresDemographic($id) {
        return $this->baseView('smartapp.disclosures.demographic',
            ['id' => $id, 'top'=>'disclosures', 'bottom' => 'demographic', 'menu' => $this->disclosuresSubMenu, 'subtitle' => 'Demographic Information']
        );
    }

    public function finishApp($id) {
        $app = Application::where('id', $id)->first();
        if($app) {
            $app->submitted_at = date('Y-m-d H:i:s');
            $app->save();
        }
        return $this->baseView('smartapp.finish',
            ['id' => $id, 'top'=>'finish', 'subtitle' => 'Finish']
        );
    }
}
