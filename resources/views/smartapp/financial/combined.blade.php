@extends('smartapp.layout', [
    'back_button' => route('smartapp.financial.liquid', ['id' => $id]),
    'next_button' => route('smartapp.financial.autos', ['id' => $id])
])

@section('smartapp-content')
    <table class="answer">
        <tbody>
            <tr>
                <th></th>
                <th>Present</th>
                <th>Proposed (optional)</th>
            </tr>
            <tr>
                <td>Rent</td>
                <td><input type='text' value="{{ (isset($financial_combined_rent) ? $financial_combined_rent : "") }}" class="updatable left-column" name="rent" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td></td>
            </tr>
            <tr>
                <td>First Mortgage P&I</td>
                <td><input type='text' value="{{ (isset($financial_combined_first_mortgage) ? $financial_combined_first_mortgage : "") }}" class="updatable left-column" name="first_mortgage" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_first_mortgage) ? $financial_combined_proposed_first_mortgage : "") }}" class="updatable right-column" name="proposed_first_mortgage" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Other Financing</td>
                <td><input type='text' value="{{ (isset($financial_combined_other_financing) ? $financial_combined_other_financing : "") }}" class="updatable left-column" name="other_financing" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_other_financing) ? $financial_combined_proposed_other_financing : "") }}" class="updatable right-column" name="proposed_other_financing" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Hazard Insurance</td>
                <td><input type='text' value="{{ (isset($financial_combined_hazard_insurance) ? $financial_combined_hazard_insurance : "") }}" class="updatable left-column" name="hazard_insurance" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_hazard_insurance) ? $financial_combined_proposed_hazard_insurance : "") }}" class="updatable right-column" name="proposed_hazard_insurance" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Real Estate Taxes</td>
                <td><input type='text' value="{{ (isset($financial_combined_real_estate_taxes) ? $financial_combined_real_estate_taxes : "") }}" class="updatable left-column" name="real_estate_taxes" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_real_estate_taxes) ? $financial_combined_proposed_real_estate_taxes : "") }}" class="updatable right-column" name="proposed_real_estate_taxes" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Mortgage Insurance</td>
                <td><input type='text' value="{{ (isset($financial_combined_mortgage_insurance) ? $financial_combined_mortgage_insurance : "") }}" class="updatable left-column" name="mortgage_insurance" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_mortgage_insurance) ? $financial_combined_proposed_mortgage_insurance : "") }}" class="updatable right-column" name="proposed_mortgage_insurance" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Homeowner Assn. Dues</td>
                <td><input type='text' value="{{ (isset($financial_combined_hoa_dues) ? $financial_combined_hoa_dues : "") }}" class="updatable left-column" name="hoa_dues" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_hoa_dues) ? $financial_combined_proposed_hoa_dues : "") }}" class="updatable right-column" name="proposed_hoa_dues" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Other</td>
                <td><input type='text' value="{{ (isset($financial_combined_other) ? $financial_combined_other : "") }}" class="updatable left-column" name="other" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_other) ? $financial_combined_proposed_other : "") }}" class="updatable right-column" name="proposed_other" data-type="financial" data-model="combined" style="width: calc(100% - 25px)"></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><input type='text' value="{{ (isset($financial_combined_total) ? $financial_combined_total : "") }}" class="updatable left-sum" name="total" data-type="financial" data-model="combined" style="width: calc(100% - 25px)" readonly></td>
                <td><input type='text' value="{{ (isset($financial_combined_proposed_total) ? $financial_combined_proposed_total : "") }}" class="updatable right-sum" name="proposed_total" data-type="financial" data-model="combined" style="width: calc(100% - 25px)" readonly></td>
            </tr>
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(".left-column").change(function() {
                var left_sum = 0;
                $(".left-column").each(function(i){
                    var val = parseFloat($(this).val());
                    if(!isNaN(val))
                        left_sum += val;
                });
                $(".left-sum").val(left_sum);
                $('.left-sum').change();
            });
            $(".right-column").change(function() {
                var right_sum = 0;
                $(".right-column").each(function(i){
                    var val = parseFloat($(this).val());
                    if(!isNaN(val))
                    right_sum += val;
                });
                $(".right-sum").val(right_sum);
                $('.right-sum').change();
            });
        });
    </script>
@endpush
