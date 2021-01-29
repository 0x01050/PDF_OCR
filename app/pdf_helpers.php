<?php

if (! function_exists('writeToPDF')) {
    function writeToPDF($fields, $date_submitted) {
        $pdf_file = time() . random_string();
        $pdf_file = $pdf_file . '.pdf';

        $reader = new SetaPDF_Core_Reader_File(resource_path() . '/binary/1003_template.pdf');
        $writer = new SetaPDF_Core_Writer_File(storage_path('app/' . $pdf_file));
        $document = SetaPDF_Core_Document::load($reader, $writer);
        $formFiller = new SetaPDF_FormFiller($document);
        $formFiller->setNeedAppearances(true);
        $pdfFields = $formFiller->getFields();
        $pdfFields['Date Stamp']->setValue($date_submitted);
        writeSection1ToPDF($pdfFields, $fields);
        writeSection2ToPDF($pdfFields, $fields);
        writeSection3ToPDF($pdfFields, $fields);
        writeSection4ToPDF($pdfFields, $fields);
        writeSection5ToPDF($pdfFields, $fields);
        writeSection6ToPDF($pdfFields, $fields);
        writeSection7ToPDF($pdfFields, $fields);
        writeSection8ToPDF($pdfFields, $fields);
        writeSection9ToPDF($pdfFields, $fields);
        writeSection10ToPDF($pdfFields, $fields);
        $javaScript = new SetaPDF_Core_Document_Action_JavaScript('this.calculateNow();');
        $document->getCatalog()->setOpenAction($javaScript);
        $document->save()->finish();

        return $pdf_file;
    }
}
if (! function_exists('writeSection1ToPDF')) {
    function writeSection1ToPDF(&$pdfFields, $fields) {
        if(isset($fields['property_loan_mortgage_applied_for'])) {
            $mortgageAppliedFor = '';
            switch($fields['property_loan_mortgage_applied_for']) {
                case 'conventional':                $mortgageAppliedFor = 'Conventional'; break;
                case 'va':                          $mortgageAppliedFor = 'VA'; break;
                case 'fha':                         $mortgageAppliedFor = 'FHA'; break;
                case 'usda-rural-housing-service':  $mortgageAppliedFor = 'USDA/Rural Housing Service'; break;
                case 'other':                       $mortgageAppliedFor = 'Other'; break;
            }
            $pdfFields['Mortgage Applied For']->setValue($mortgageAppliedFor);
        }
        if(isset($fields['property_loan_loan_amount'])) {
            $loanAmount = parseFloat($fields['property_loan_loan_amount']);
            $pdfFields['Amount']->setValue($loanAmount);
        }
        if(isset($fields['property_loan_number_of_months'])) {
            $noMonth = $fields['property_loan_number_of_months'];
            $pdfFields['No of Months']->setValue($noMonth);
        }
        if(isset($fields['property_loan_amortization_type'])) {
            $amortizationType = '';
            switch($fields['property_loan_amortization_type']) {
                case 'fixed-rate':                  $amortizationType = 'Fixed Rate'; break;
                case 'gpm':                         $amortizationType = 'GPM'; break;
                case 'arm':                         $amortizationType = 'ARM (type)'; break;
            }
            $pdfFields['Amortization Type']->setValue($amortizationType);
        }
    }
}
if (! function_exists('writeSection2ToPDF')) {
    function writeSection2ToPDF(&$pdfFields, $fields) {
        $address = '';
        if(isset($fields['property_subject_address_1'])) {
            $address = $fields['property_subject_address_1'];
        }
        if(isset($fields['property_subject_address_2'])) {
            $address .= ', ' . $fields['property_subject_address_2'];
        }
        if(isset($fields['property_subject_city'])) {
            $address .= ', ' . $fields['property_subject_city'];
        }
        if(isset($fields['property_subject_state'])) {
            $address .= ', ' . $fields['property_subject_state'];
        }
        if(isset($fields['property_subject_zip_code'])) {
            $address .= ', ' . $fields['property_subject_zip_code'];
        }
        $address = trim($address, ', ');
        $pdfFields['Subject Property Address']->setValue($address);
        $noUnits = '';
        if(isset($fields['property_subject_no_units'])) {
            $noUnits = $fields['property_subject_no_units'];
        }
        $pdfFields['No of Units']->setValue($noUnits);
        $yearBuilt = '';
        if(isset($fields['property_subject_year_built'])) {
            $yearBuilt = $fields['property_subject_year_built'];
        }
        $pdfFields['Year Built']->setValue($yearBuilt);

        $loanPurpose = '';
        $amountExistingLiensKey = '';
        if(isset($fields['property_purpose_purpose_of_loan'])) {
            switch($fields['property_purpose_purpose_of_loan']) {
                case 'construction':                $loanPurpose = 'Construction'; $amountExistingLiensKey = 'Amount Existing Liens'; break;
                case 'construction-permanent':      $loanPurpose = 'Construction-Permanent'; $amountExistingLiensKey = 'Amount Existing Liens'; break;
                case 'refinance':                   $loanPurpose = 'Refinance'; $amountExistingLiensKey = 'Amount Existing Liens 2'; break;
                case 'other':                       $loanPurpose = 'Other'; break;
                case 'purchase':                    $loanPurpose = 'Purchase'; break;
            }
            $pdfFields['Purpose of Loan']->setValue($loanPurpose);
        }
        if(isset($fields['property_purpose_property_will_be'])) {
            switch($fields['property_purpose_property_will_be']) {
                case 'primary-residence':           $propertyWillBe = 'Primary Residence'; break;
                case 'secondary-residence':         $propertyWillBe = 'Secondary Residence'; break;
                case 'investment':                  $propertyWillBe = 'Investment'; break;
            }
            $pdfFields['Property will be']->setValue($propertyWillBe);
        }
        if($amountExistingLiensKey != '' && isset($fields['property_purpose_amount_existing_liens'])) {
            $amountExistingLiens = parseFloat($fields['property_purpose_amount_existing_liens']);
            $pdfFields[$amountExistingLiensKey]->setValue($amountExistingLiens);
        }
        if($loanPurpose == 'Refinance' && isset($fields['property_purpose_year_acquired'])) {
            $yearAcquired = $fields['property_purpose_year_acquired'];
            $pdfFields['Year Lot Acquired 2']->setValue($yearAcquired);
        }
        if($loanPurpose == 'Refinance' && isset($fields['property_purpose_original_cost'])) {
            $originalCost = parseFloat($fields['property_purpose_original_cost']);
            $pdfFields['Original Cost 2']->setValue($originalCost);
        }
        if($loanPurpose == 'Refinance' && isset($fields['property_purpose_purpose_of_refinance'])) {
            $refinancePurpose = '';
            switch($fields['property_purpose_purpose_of_refinance']) {
                case 'no_cash_out':                 $refinancePurpose = 'No-Cash-Out'; break;
                case 'cash_out_other':              $refinancePurpose = 'Cash-Out/Other'; break;
                case 'cash_out_home_improvement':   $refinancePurpose = 'Cash-Out/Home Improvement'; break;
                case 'cash_out_debt_consolidation': $refinancePurpose = 'Cash-Out/Debt Consolidation'; break;
                case 'limited_cash_out':            $refinancePurpose = 'Limited-Cash-Out'; break;
            }
            $pdfFields['Purpose of Refinance']->setValue($refinancePurpose);
        }
        if(isset($fields['property_purpose_manner_in_which_title_will_be_held'])) {
            $mannerTitle = $fields['property_purpose_manner_in_which_title_will_be_held'];
            $pdfFields['Manner in which Title will be held']->setValue($mannerTitle);
        }
        if(isset($fields['property_purpose_financing_source'])) {
            $financingSource  = '';
            switch($fields['property_purpose_financing_source']) {
                case 'checking_saving':             $financingSource = 'Checking Saving'; break;
                case 'deposit_on_sales_contract':   $financingSource = 'Deposit on Sales Contract'; break;
                case 'equity_on_sold_property':     $financingSource = 'Equity on Sold Property'; break;
                case 'equity_from_ending_sale':     $financingSource = 'Equity from Ending Sale'; break;
                case 'equity_from_subject_property':$financingSource = 'Equity from Subject Property'; break;
                case 'Gift Funds':
                    $financingSource = '04';
                    if(isset($fields['property_purpose_financing_source_amount'])) {
                        $financingSource .= ' (' . $fields['property_purpose_financing_source_amount'] . ')';
                    }
                    break;
                case 'stocks_and_bonds':            $financingSource = 'Stocks and Bonds'; break;
                case 'lot_equity':                  $financingSource = 'Lot Equity'; break;
                case 'bridge_loan':                 $financingSource = 'Bridge Loan'; break;
                case 'unsecured_borrowed_funds':    $financingSource = 'Unsecured Borrowed Funds'; break;
                case 'trust_funds':                 $financingSource = 'Trust Funds'; break;
                case 'retirement_funds':            $financingSource = 'Retirement Funds'; break;
                case 'rent_with_option_to_purchase':$financingSource = 'Rent with Option to Purchase'; break;
                case 'life_insurance_cash_value':   $financingSource = 'Life Insurance Cash Value'; break;
                case 'sale_of_chattel':             $financingSource = 'Sale of Chattel'; break;
                case 'trade_equity':                $financingSource = 'Trade Equity'; break;
                case 'sweat_equity':                $financingSource = 'Sweat Equity'; break;
                case 'cash_on_hand':                $financingSource = 'Cash on Hand'; break;
                case 'other_type_of_down_payment':  $financingSource = 'Other Type of Down Payment'; break;
                case 'secured_borrowed_funds':      $financingSource = 'Secured Borrowed Funds'; break;
            }
            $pdfFields['Describe Improvements Text']->setValue($financingSource);
        }
    }
}
if (! function_exists('writeSection3ToPDF')) {
    function writeSection3ToPDF(&$pdfFields, $fields) {
        writeSection3SubToPDF($pdfFields, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeSection3SubToPDF($pdfFields, $fields, 'co');
        }
    }
}
if (! function_exists('writeSection3SubToPDF')) {
    function writeSection3SubToPDF(&$pdfFields, $fields, $applicant = '') {
        $paramKeyPrefix = '';
        $pdfKeyPrefix = '';
        $dependentPrefix = 'Co-';
        if($applicant == 'co') {
            $paramKeyPrefix = 'co';
            $pdfKeyPrefix = 'Co-';
            $dependentPrefix = '';
        }
        $borrowerName = '';
        if(isset($fields[$paramKeyPrefix . 'borrower_info_first_name'])) {
            $borrowerName = $fields[$paramKeyPrefix . 'borrower_info_first_name'];
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_info_middle_name'])) {
            $borrowerName .= ' ' . $fields[$paramKeyPrefix . 'borrower_info_middle_name'];
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_info_last_name'])) {
            $borrowerName .= ' ' . $fields[$paramKeyPrefix . 'borrower_info_last_name'];
        }
        $borrowerName = trim($borrowerName);
        $pdfFields[$pdfKeyPrefix . 'Borrower Name']->setValue($borrowerName);
        if(isset($fields[$paramKeyPrefix . 'borrower_info_social_security_number'])) {
            $borrowerSSN = $fields[$paramKeyPrefix . 'borrower_info_social_security_number'];
            $pdfFields[$pdfKeyPrefix . 'Borrower SSN']->setValue($borrowerSSN);
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_info_home_phone'])) {
            $borrowerPhone = $fields[$paramKeyPrefix . 'borrower_info_home_phone'];
            $pdfFields[$pdfKeyPrefix . 'Borrower Home Phone']->setValue($borrowerPhone);
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_info_date_of_birth'])) {
            $borrowerDOB = $fields[$paramKeyPrefix . 'borrower_info_date_of_birth'];
            $pdfFields[$pdfKeyPrefix . 'Borrower DOB']->setValue($borrowerDOB);
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_info_years_in_school'])) {
            $borrowerYrsOfSchool = $fields[$paramKeyPrefix . 'borrower_info_years_in_school'];
            $pdfFields[$pdfKeyPrefix . 'Borrower Yrs School']->setValue($borrowerYrsOfSchool);
        }
        $borrowerMarried = 'Unmarried';
        if(isset($fields[$paramKeyPrefix . 'borrower_info_marital_status'])) {
            switch($fields[$paramKeyPrefix . 'borrower_info_marital_status']) {
                case 'married':                     $borrowerMarried = 'Married'; break;
                case 'unmarried':                   $borrowerMarried = 'Unmarried'; break;
                case 'separated':                   $borrowerMarried = 'Separated'; break;
            }
        }
        $pdfFields[$pdfKeyPrefix . 'Borrower Marital Status']->setValue($borrowerMarried);
        if(isset($fields[$paramKeyPrefix . 'borrower_info_number_of_dependents'])) {
            $borrowerDependents = $fields[$paramKeyPrefix . 'borrower_info_number_of_dependents'];
            $pdfFields['Dependents not listed by ' . $dependentPrefix . 'Borrower no']->setValue($borrowerDependents);
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_info_dependent_ages'])) {
            $borrowerDependentAges = $fields[$paramKeyPrefix . 'borrower_info_dependent_ages'];
            $pdfFields['Dependents not listed by ' . $dependentPrefix . 'Borrower ages']->setValue($borrowerDependentAges);
        }
        writeSection3AddressToPDF($pdfFields, $fields, $paramKeyPrefix, $pdfKeyPrefix);
        if(isset($fields[$paramKeyPrefix . 'borrower_address_address_is_mailing_address']) && $fields[$paramKeyPrefix . 'borrower_address_address_is_mailing_address'] == 'false') {
            writeSection3AddressToPDF($pdfFields, $fields, $paramKeyPrefix, $pdfKeyPrefix, 'present_mailing', 'Mailing');
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_address_address_lived_less_than_2_years']) && $fields[$paramKeyPrefix . 'borrower_address_address_lived_less_than_2_years'] == 'true') {
            writeSection3AddressToPDF($pdfFields, $fields, $paramKeyPrefix, $pdfKeyPrefix, 'former', 'Former');
        }
    }
}
if (! function_exists('writeSection3AddressToPDF')) {
    function writeSection3AddressToPDF(&$pdfFields, $fields, $paramKeyPrefix, $pdfKeyPrefix, $paramTime = 'present', $pdfTime = 'Present') {
        $borrowerAddress = '';
        if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_1'])) {
            $borrowerAddress = $fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_1'];
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_2'])) {
            $borrowerAddress .= ', ' . $fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_2'];
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_city'])) {
            $borrowerAddress .= ', ' . $fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_city'];
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_state'])) {
            $borrowerAddress .= ', ' . $fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_state'];
        }
        if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_zip_code'])) {
            $borrowerAddress .= ', ' . $fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_zip_code'];
        }
        $borrowerAddress = trim($borrowerAddress, ', ');
        $pdfFields[$pdfKeyPrefix . 'Borrower ' . $pdfTime . ' Address']->setValue($borrowerAddress);
        if($paramTime != 'present_mailing') {
            if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_own_rent'])) {
                $borrowerRent = 'Rent';
                if($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_own_rent'] == 'own') {
                    $borrowerRent = 'Own';
                }
                $pdfFields[$pdfKeyPrefix . 'Borrower ' . $pdfTime . ' Own or Rent']->setValue($borrowerRent);
            }
            if(isset($fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_own_rent_number_of_years'])) {
                $borrowerRentYears = $fields[$paramKeyPrefix . 'borrower_address_' . $paramTime . '_address_own_rent_number_of_years'];
                $pdfFields[$pdfKeyPrefix . 'Borrower ' . $pdfTime . ' No of Years']->setValue($borrowerRentYears);
            }
        }
    }
}
if (! function_exists('writeSection4ToPDF')) {
    function writeSection4ToPDF(&$pdfFields, $fields) {
        writeSection4MainToPDF($pdfFields, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeSection4MainToPDF($pdfFields, $fields, 'co', 'Co-');
        }
        writeSection4SubToPDF($pdfFields, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeSection4SubToPDF($pdfFields, $fields, 'co', 'Co-');
        }
    }
}
if (! function_exists('writeSection4MainToPDF')) {
    function writeSection4MainToPDF(&$pdfFields, $fields, $paramKeyPrefix = '', $pdfKeyPrefix = '') {
        if(isset($fields[$paramKeyPrefix . 'borrower_employment'])) {
            foreach($fields[$paramKeyPrefix . 'borrower_employment'] as $employment) {
                if(isset($employment['currently_employed']) && $employment['currently_employed'] == 'true') {
                    writeSection4EmploymentToPDF($pdfFields, $employment, $pdfKeyPrefix);
                }
            }
        }
    }
}
if (! function_exists('writeSection4SubToPDF')) {
    function writeSection4SubToPDF(&$pdfFields, $fields, $paramKeyPrefix = '', $pdfKeyPrefix = '') {
        if(isset($fields[$paramKeyPrefix . 'borrower_employment'])) {
            $index = 1;
            foreach($fields[$paramKeyPrefix . 'borrower_employment'] as $employment) {
                if(!isset($employment['currently_employed']) || $employment['currently_employed'] != 'true') {
                    if($index < 3) {
                        writeSection4EmploymentToPDF($pdfFields, $employment, $pdfKeyPrefix, ' ' . $index);
                        $index ++;
                    }
                }
            }
        }
    }
}
if (! function_exists('writeSection4EmploymentToPDF')) {
    function writeSection4EmploymentToPDF(&$pdfFields, $fields, $prefix, $index = '') {
        $nameAddress = [];
        if(isset($fields['name'])) {
            array_push($nameAddress, $fields['name']);
        }
        $address = '';
        if(isset($fields['address_1'])) {
            $address = $fields['address_1'];
        }
        if(isset($fields['address_2'])) {
            $address .= ', ' . $fields['address_2'];
        }
        $address = trim($address, ', ');
        if(!empty($address)) {
            array_push($nameAddress, $address);
        }
        $city = '';
        if(isset($fields['city'])) {
            $city = $fields['city'];
        }
        if(isset($fields['state'])) {
            $city .= ', ' . $fields['state'];
        }
        if(isset($fields['zip_code'])) {
            $city .= ' ' . $fields['zip_code'];
        }
        $city = trim($city, ', ');
        if(!empty($city)) {
            array_push($nameAddress, $city);
        }
        $nameAddress = implode(PHP_EOL, $nameAddress);
        $pdfFields[$prefix . 'Borrower Name and Address of Employer' . $index]->setValue($nameAddress);
        if(isset($fields['self_employed'])) {
            $selfEmployed = '';
            switch($fields['self_employed']) {
                case 'yes':             $selfEmployed = 'Yes'; break;
                case 'no':              $selfEmployed = 'No'; break;
            }
            $pdfFields[$prefix . 'Borrower Self Employed' . $index]->setValue($selfEmployed);
        }
        if(empty($index)) {
            if(isset($fields['start_date'])) {
                $yearsOnThisJob = calcAge($fields['start_date']);
                $pdfFields[$prefix . 'Borrower Years on the job' . $index]->setValue($yearsOnThisJob);
            }
            if(isset($fields['years_in_profession'])) {
                $yearsInProfession = $fields['years_in_profession'];
                $pdfFields[$prefix . 'Borrower Years employed in this Profession' . $index]->setValue($yearsInProfession);
            }
        } else {
            $employDate = '';
            if(isset($fields['start_date'])) {
                $employDate = formatShortDate($fields['start_date']);
            }
            if(isset($fields['end_date'])) {
                if(!empty($employDate)) {
                    $employDate .= ' - ';
                }
                $employDate .= formatShortDate($fields['end_date']);
            }
            $pdfFields[$prefix . 'Borrower Employed Dates' . $index]->setValue($employDate);
        }
        if(isset($fields['position_title_type_of_business'])) {
            $positionTitle = $fields['position_title_type_of_business'];
            $pdfFields[$prefix . 'Borrower Position/Title/Type of Business' . $index]->setValue($positionTitle);
        }
        if(isset($fields['phone_number'])) {
            $phoneNumber = $fields['phone_number'];
            $pdfFields[$prefix . 'Borrower Business phone' . $index]->setValue($phoneNumber);
        }
    }
}
if (! function_exists('writeSection5ToPDF')) {
    function writeSection5ToPDF(&$pdfFields, $fields) {
        writePage2Section5SubToPDF($pdfFields, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writePage2Section5SubToPDF($pdfFields, $fields, 'co', 'Co-');
        }
        writeSection5Sub2ToPDF($pdfFields, $fields);
        writeSection5Sub2ToPDF($pdfFields, $fields, 'proposed_', ' Proposed');
    }
}
if (! function_exists('writeSection5SubToPDF')) {
    function writePage2Section5SubToPDF(&$pdfFields, $fields, $paramKeyPrefix = '', $pdfKeyPrefix = '') {
        $paramSubKeys = ['base_income', 'overtime', 'bonuses', 'commissions', 'dividends_interest', 'net_rental_income', 'other'];
        $pdfSubKeys = ['Base', 'Overtime', 'Bonuses', 'Commissions', 'Dividends/Interest', 'Net Rental Income', 'Other'];
        for($i = 0; $i < 7; $i ++) {
            if(isset($fields[$paramKeyPrefix . 'borrower_income_' . $paramSubKeys[$i]])) {
                $income = parseFloat($fields[$paramKeyPrefix . 'borrower_income_' . $paramSubKeys[$i]]);
                $pdfFields['Monthly Income ' . $pdfKeyPrefix . 'Borrower ' . $pdfSubKeys[$i]]->setValue($income);
            }
        }
    }
}
if (! function_exists('writeSection5Sub2ToPDF')) {
    function writeSection5Sub2ToPDF(&$pdfFields, $fields, $paramKeyPrefix = '', $pdfKeyPrefix = '') {
        $paramKeys = ['rent', 'first_mortgage', 'other_financing', 'hazard_insurance', 'real_estate_taxes', 'mortgage_insurance', 'hoa_dues', 'other'];
        $pdfKeys = ['Rent', 'First M', 'Other Financing', 'Hazard Ins', 'Real Estate Taxes', 'Mortgage Insurance', 'Homeowner Assn Dues', 'Other'];
        for($i = 0; $i < 8; $i ++) {
            if(isset($fields['financial_combined_' . $paramKeyPrefix . $paramKeys[$i]])) {
                $expense = $fields['financial_combined_' . $paramKeyPrefix . $paramKeys[$i]];
                $pdfFields['Combined Monthly Housing Expense ' . $pdfKeys[$i] . $pdfKeyPrefix]->setValue($expense);
            }
        }
    }
}
if (! function_exists('writeSection6ToPDF')) {
    function writeSection6ToPDF(&$pdfFields, $fields) {
        if(isset($fields['financial_liquid'])) {
            $index = 1;
            foreach($fields['financial_liquid'] as $asset) {
                writeSection6LiquidAssetToPDF($pdfFields, $asset, $index);
                $index ++;
            }
        }
        if(isset($fields['financial_autos'])) {
            foreach($fields['financial_autos'] as $auto) {
                $name = '';
                if(isset($auto['make'])) {
                    $name = $auto['make'];
                }
                if(isset($auto['model'])) {
                    $name .= ' ' . $auto['model'];
                }
                if(isset($auto['year'])) {
                    $name .= ' ' . $auto['year'];
                }
                $name = trim($name);
                $pdfFields['Automobiles Owned Make and Year']->setValue($name);
                if(isset($auto['value'])) {
                    $value = parseFloat($auto['value']);
                    $pdfFields['Automobiles Owned Price']->setValue($value);
                }
            }
        }
        if(isset($fields['financial_other'])) {
            foreach($fields['financial_other'] as $asset) {
                if(isset($asset['name'])) {
                    $name = $asset['name'];
                    $pdfFields['Other Assets Itemized']->setValue($name);
                }
                if(isset($asset['value'])) {
                    $value = parseFloat($asset['value']);
                    $pdfFields['Other Assets Itemized Price']->setValue($value);
                }
            }
        }
        if(isset($fields['financial_estate'])) {
            $index = 1;
            $totalValue = 0;
            foreach($fields['financial_estate'] as $estate) {
                if($index > 3) {
                    break;
                }
                $address = '';
                if(isset($estate['address_1'])) {
                    $address = $estate['address_1'];
                }
                if(isset($estate['address_2'])) {
                    $address .= ', ' . $estate['address_2'];
                }
                if(isset($estate['city'])) {
                    $address .= ', ' . $estate['city'];
                }
                if(isset($estate['state'])) {
                    $address .= ', ' . $estate['state'];
                }
                if(isset($estate['zip_code'])) {
                    $address .= ' ' . $estate['zip_code'];
                }
                $address = trim($address, ', ');
                $pdfFields['Owned Real Estate Address ' . $index]->setValue($address);
                if(isset($estate['status'])) {
                    $status = '';
                    switch($estate['status']) {
                        case 'sold':                        $status = 'S'; break;
                        case 'pending-sale':                $status = 'P'; break;
                        case 'rental':                      $status = 'R'; break;
                        case 'retained':                    $status = 'H'; break;
                    }
                    $pdfFields['S,PS or R ' . $index]->setValue($status);
                }
                if(isset($estate['type_of_property'])) {
                    $type = '';
                    switch($estate['type_of_property']) {
                        case 'single-family-residence':     $type = 'Single Family Residence'; break;
                        case 'two-to-fourplex':             $type = 'Two to Fourplex'; break;
                        case 'commercial-non-residential':  $type = 'Commercial Non-residential'; break;
                        case 'commercial-residential':      $type = 'Commercial Residential'; break;
                        case 'condominium':                 $type = 'Condominium'; break;
                        case 'co-op':                       $type = 'Co-Op'; break;
                        case 'farm':                        $type = 'Farm'; break;
                        case 'land':                        $type = 'Land'; break;
                        case 'mixed-use-property':          $type = 'Mixed Use Property'; break;
                        case 'mobile-home':                 $type = 'Mobile Home'; break;
                        case 'multi-family-property':       $type = 'Multi-Family Property'; break;
                        case 'townhouse':                   $type = 'Townhouse'; break;
                    }
                    $pdfFields['Type of Property ' . $index]->setValue($type);
                }
                if(isset($estate['present_market_value'])) {
                    $value = parseFloat($estate['present_market_value']);
                    $totalValue += $value;
                    $pdfFields['Owned Real Estate Address ' . $index . ' Market Value']->setValue($value);
                }
                if(isset($estate['amount_of_mortgages_and_liens'])) {
                    $value = parseFloat($estate['amount_of_mortgages_and_liens']);
                    $pdfFields['Owned Real Estate Address ' . $index . ' Amount of Mortgages Liens']->setValue($value);
                }
                if(isset($estate['gross_rental_income'])) {
                    $value = parseFloat($estate['gross_rental_income']);
                    $pdfFields['Owned Real Estate Address ' . $index . ' Gross Rental Income']->setValue($value);
                }
                if(isset($estate['mortgage_payments'])) {
                    $value = parseFloat($estate['mortgage_payments']);
                    $pdfFields['Owned Real Estate Address ' . $index . ' Mortage Payments']->setValue($value);
                }
                if(isset($estate['insurance_maintenance_taxes_misc'])) {
                    $value = parseFloat($estate['insurance_maintenance_taxes_misc']);
                    $pdfFields['Owned Real Estate Address ' . $index . ' Insurance Maintenance Taxes']->setValue($value);
                }
                if(isset($estate['net_rental_income'])) {
                    $value = parseFloat($estate['net_rental_income']);
                    $pdfFields['Owned Real Estate Address ' . $index . ' Net Rental Income']->setValue($value);
                }
                $index ++;
            }
            $pdfFields['Real Estate Market Value']->setValue($totalValue);
        }
    }
}
if (! function_exists('writeSection6LiquidAssetToPDF')) {
    function writeSection6LiquidAssetToPDF(&$pdfFields, $asset, $index) {
        if(!(isset($asset['type']) && $asset['type'] == 'other')) {
            if(isset($asset['name'])) {
                $name = $asset['name'];
                $pdfFields['Assets Name and Adress of Bank, S&L, Or Credit Union ' . $index]->setValue($name);
            }
            if(isset($asset['account_number'])) {
                $accNo = $asset['account_number'];
                $pdfFields['Assets Acct no ' . $index]->setValue($accNo);
            }
        }
        if(isset($asset['account_balance'])) {
            $accBalance = parseFloat($asset['account_balance']);
            $pdfFields['Assets Acct no ' . $index . ' Balance']->setValue($accBalance);
        }
    }
}
if (! function_exists('writeSection7ToPDF')) {
    function writeSection7ToPDF(&$pdfFields, $fields) {
        if(isset($fields['property_purpose_purchase_price'])) {
            $purchasePrice = parseFloat($fields['property_purpose_purchase_price']);
            $pdfFields['Purchase Price']->setValue($purchasePrice);
        }
    }
}
if (! function_exists('writeSection8ToPDF')) {
    function writeSection8ToPDF(&$pdfFields, $fields) {
        writeSection8SubToPDF($pdfFields, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeSection8SubToPDF($pdfFields, $fields, 'co', 'Co-');
        }
    }
}
if (! function_exists('writeSection8SubToPDF')) {
    function writeSection8SubToPDF(&$pdfFields, $fields, $paramKeyPrefix = '', $pdfKeyPrefix = '') {
        $paramSubKeys = ['outstanding_judgement', 'bankrupt_last_seven_years', 'property_foreclosure_last_seven_years', 'party_to_a_lawsuit', 'obligated_on_loan',
                    'delinquent_default_loan', 'alimony_child_support_separate_maintenance', 'down_payment_borrowed', 'co_maker_endorser_on_a_note', 'us_citizen',
                    'permanent_resident_alien', 'primary_residence', 'ownership_interest'];
        $pdfSubKeys = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm'];
        for($i = 0; $i < 13; $i ++) {
            if(isset($fields['disclosures_' . $paramKeyPrefix . 'borrower_' . $paramSubKeys[$i]])) {
                $value = $fields['disclosures_' . $paramKeyPrefix . 'borrower_' . $paramSubKeys[$i]];
                $pdfFields[$pdfKeyPrefix . 'Borrower ' . $pdfSubKeys[$i]]->setValue($value);
            }
        }
        if(isset($fields['disclosures_' . $paramKeyPrefix . 'borrower_ownership_interest']) && $fields['disclosures_' . $paramKeyPrefix . 'borrower_ownership_interest'] == 'yes') {
            if(isset($fields['disclosures_' . $paramKeyPrefix . 'borrower_hold_title'])) {
                $value = '';
                switch($fields['disclosures_' . $paramKeyPrefix . 'borrower_hold_title']) {
                    case 'sole':                            $value = 'S'; break;
                    case 'joint':                           $value = 'SP'; break;
                    case 'joint_with_other_than_spouse':    $value = 'O'; break;
                }
                $pdfFields['m2 ' . $paramKeyPrefix . 'borrower']->setValue($value);
            }
        }
    }
}
if (! function_exists('writeSection9ToPDF')) {
    function writeSection9ToPDF(&$pdfFields, $fields) {

    }
}
if (! function_exists('writeSection10ToPDF')) {
    function writeSection10ToPDF(&$pdfFields, $fields) {
        writeSection10SubToPDF($pdfFields, $fields);
        if(isset($fields['start_has_co_borrower']) && $fields['start_has_co_borrower'] == 'yes') {
            writeSection10SubToPDF($pdfFields, $fields, 'co', 'Co-');
        }
    }
}
if (! function_exists('writeSection10SubToPDF')) {
    function writeSection10SubToPDF(&$pdfFields, $fields, $paramKeyPrefix = '', $pdfKeyPrefix = '') {
        $ethnicity = '';
        if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_hispanic_or_latino']) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_hispanic_or_latino'] == 'true') {
            $ethnicity = 'Yes';
        }
        if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_not_hispanic_or_latino']) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_not_hispanic_or_latino'] == 'true') {
            $ethnicity = 'Not';
        }
        if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_i_do_not_wish_to_provide_ethnicity_information']) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_i_do_not_wish_to_provide_ethnicity_information'] == 'true') {
            $ethnicity = 'NotProvide';
        }
        if($ethnicity == 'NotProvide') {
            $pdfFields[$pdfKeyPrefix . 'Borrower Do Not Wish']->setValue('Yes');
        } else if($ethnicity != '') {
            $pdfFields[$pdfKeyPrefix . 'Borrower Ethnicity']->setValue($ethnicity);
        }

        $paramSubKeys = ['american_indian_or_alaska_native', 'asian', 'black_or_african_american', 'native_hawaiian_or_other_pacific_islander', 'white'];
        $pdfSubKeys = ['American', 'Asian', 'Black', 'Hawaiian', 'White'];
        for($i = 0; $i < 5; $i ++) {
            if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_' . $paramSubKeys[$i]]) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_' . $paramSubKeys[$i]] == 'true') {
                $pdfFields[$pdfKeyPrefix . 'Borrower ' . $pdfSubKeys[$i]]->setValue('Yes');
            }
        }

        $sex = '';
        if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_m']) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_m'] == 'true') {
            $sex = 'M';
        }
        if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_f']) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_f'] == 'true') {
            $sex = 'F';
        }
        if(isset($fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_i_do_not_wish_to_provide_sex_information']) && $fields['disclosures_demographic_' . $paramKeyPrefix . 'borrower_i_do_not_wish_to_provide_sex_information'] == 'true') {
            $sex = 'N';
        }
        if($sex == 'M' || $sex == 'F') {
            $pdfFields[$pdfKeyPrefix . 'Borrower Sex']->setValue($sex);
        }
    }
}

?>
