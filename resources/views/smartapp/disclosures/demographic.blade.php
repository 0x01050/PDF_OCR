@extends('smartapp.layout', [
    'back_button' => (isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? route('smartapp.disclosures.coborrower', ['id' => $id]) : route('smartapp.disclosures.borrower', ['id' => $id]),
    'next_button' => route('smartapp.finish', ['id' => $id])
])

@section('smartapp-content')
    <div class="item-field">
        <div class="description">
            The purpose of collecting this information is to help ensure that all the applicants are treated fairly and that the housing needs of communities and neighborhoods are being fulfilled. For residential mortgage lending, Federal law requires that we ask applicants for their demographic information (ethnicity, sex, and race) in order to monitor our compliance with equal credit opportunity, fair housing, and home mortgage disclosure laws. You are not required to provide this information, but are encouraged to do so. You may select one or more designations for "Ethnicity" and one or more designations for "Race." The law provides that we may not discriminate on the basis of this information, or on whether you choose to provide it. However, if you choose not to provide the information and you have made this application in person, Federal regulations require us to note your ethnicity, sex, and race on the basis of visual observation or surname. The law also provides that we may not discriminate on the basis of age or marital status information you provide in this application. If you do not wish to provide some or all of this information, please check below.
        </div>
    </div>

    <div>

        <div class="item-field">
            <div class="divider">
                <b>Borrower</b>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>Ethnicity</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_hispanic_or_latino) && $disclosures_demographic_borrower_hispanic_or_latino == 'on' ? "checked" : "") }} class="updatable" name="borrower_hispanic_or_latino" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_hispanic_or_latino"">Hispanic or Latino</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_not_hispanic_or_latino) && $disclosures_demographic_borrower_not_hispanic_or_latino == 'on' ? "checked" : "") }} class="updatable" name="borrower_not_hispanic_or_latino" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_not_hispanic_or_latino"">Not Hispanic or Latino</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_i_do_not_wish_to_provide_ethnicity_information) && $disclosures_demographic_borrower_i_do_not_wish_to_provide_ethnicity_information == 'on' ? "checked" : "") }} class="updatable" name="borrower_i_do_not_wish_to_provide_ethnicity_information" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_i_do_not_wish_to_provide_ethnicity_information"">I do not wish to provide this information</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Ethnicity Origin</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_mexican) && $disclosures_demographic_borrower_mexican == 'on' ? "checked" : "") }} class="updatable" name="borrower_mexican" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_mexican"">Mexican</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_puerto_rican) && $disclosures_demographic_borrower_puerto_rican == 'on' ? "checked" : "") }} class="updatable" name="borrower_puerto_rican" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_puerto_rican"">Puerto Rican</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_cuban) && $disclosures_demographic_borrower_cuban == 'on' ? "checked" : "") }} class="updatable" name="borrower_cuban" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_cuban"">Cuban</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_other) && $disclosures_demographic_borrower_other == 'on' ? "checked" : "") }} class="updatable" name="borrower_other" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_other"">Other</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="item-field">
            <div class="question">
                <b>Other Hispanic or Latino</b>
            </div>
            <div class="answer">
                <div>
                    <input type='text' value="{{ (isset($disclosures_demographic_borrower_ethnicity_text_hdma1) ? $disclosures_demographic_borrower_ethnicity_text_hdma1 : "") }}" class="updatable" name="borrower_ethnicity_text_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(50% - 50px)" >
                </div>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>Race</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_american_indian_or_alaska_native) && $disclosures_demographic_borrower_american_indian_or_alaska_native == 'on' ? "checked" : "") }} class="updatable" name="borrower_american_indian_or_alaska_native" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_american_indian_or_alaska_native"">American Indian or Alaska Native</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_asian) && $disclosures_demographic_borrower_asian == 'on' ? "checked" : "") }} class="updatable" name="borrower_asian" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_asian"">Asian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_black_or_african_american) && $disclosures_demographic_borrower_black_or_african_american == 'on' ? "checked" : "") }} class="updatable" name="borrower_black_or_african_american" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_black_or_african_american"">Black or African American</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_native_hawaiian_or_other_pacific_islander) && $disclosures_demographic_borrower_native_hawaiian_or_other_pacific_islander == 'on' ? "checked" : "") }} class="updatable" name="borrower_native_hawaiian_or_other_pacific_islander" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_native_hawaiian_or_other_pacific_islander"">Native Hawaiian or Other Pacific Islander</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_white) && $disclosures_demographic_borrower_white == 'on' ? "checked" : "") }} class="updatable" name="borrower_white" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_white"">White</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_i_do_not_wish_to_provide_race_information) && $disclosures_demographic_borrower_i_do_not_wish_to_provide_race_information == 'on' ? "checked" : "") }} class="updatable" name="borrower_i_do_not_wish_to_provide_race_information" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_i_do_not_wish_to_provide_race_information"">I do not wish to provide this information</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Race Other</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_asian_indian) && $disclosures_demographic_borrower_asian_indian == 'on' ? "checked" : "") }} class="updatable" name="borrower_asian_indian" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_asian_indian"">Asian Indian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_chinese) && $disclosures_demographic_borrower_chinese == 'on' ? "checked" : "") }} class="updatable" name="borrower_chinese" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_chinese">Chinese</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_filipino) && $disclosures_demographic_borrower_filipino == 'on' ? "checked" : "") }} class="updatable" name="borrower_filipino" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_filipino"">Filipino</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_japanese) && $disclosures_demographic_borrower_japanese == 'on' ? "checked" : "") }} class="updatable" name="borrower_japanese" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_japanese"">Japanese</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_korean) && $disclosures_demographic_borrower_korean == 'on' ? "checked" : "") }} class="updatable" name="borrower_korean" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_korean"">Korean</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_vietnamese) && $disclosures_demographic_borrower_vietnamese == 'on' ? "checked" : "") }} class="updatable" name="borrower_vietnamese" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_vietnamese"">Vietnamese</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_other_asian) && $disclosures_demographic_borrower_other_asian == 'on' ? "checked" : "") }} class="updatable" name="borrower_other_asian" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_other_asian"">Other Asian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_native_hawaiian) && $disclosures_demographic_borrower_native_hawaiian == 'on' ? "checked" : "") }} class="updatable" name="borrower_native_hawaiian" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_native_hawaiian"">Native Hawaiian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_guamanian_or_chamorro) && $disclosures_demographic_borrower_guamanian_or_chamorro == 'on' ? "checked" : "") }} class="updatable" name="borrower_guamanian_or_chamorro" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_guamanian_or_chamorro"">Guamanian or Chamorro</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_samoan) && $disclosures_demographic_borrower_samoan == 'on' ? "checked" : "") }} class="updatable" name="borrower_samoan" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_samoan"">Samoan</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_other_pacific_islander) && $disclosures_demographic_borrower_other_pacific_islander == 'on' ? "checked" : "") }} class="updatable" name="borrower_other_pacific_islander" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_other_pacific_islander"">Other Pacific Islander</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>American Indian or Alaskan Native</b>
                </div>
                <div class="answer">
                    <div>
                        <input type='text' value="{{ (isset($disclosures_demographic_borrower_race_text_hdma1) ? $disclosures_demographic_borrower_race_text_hdma1 : "") }}" class="updatable" name="borrower_race_text_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(100% - 50px)" >
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Other Asian</b>
                </div>
                <div class="answer">
                    <div>
                        <input type='text' value="{{ (isset($disclosures_demographic_borrower_race_text_asian_hdma1) ? $disclosures_demographic_borrower_race_text_asian_hdma1 : "") }}" class="updatable" name="borrower_race_text_asian_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(100% - 50px)" >
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Native Hawaiian or Other Pacific Islander</b>
                </div>
                <div class="answer">
                    <div>
                        <input type='text' value="{{ (isset($disclosures_demographic_borrower_race_text_islander_hdma1) ? $disclosures_demographic_borrower_race_text_islander_hdma1 : "") }}" class="updatable" name="borrower_race_text_islander_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(100% - 50px)" >
                    </div>
                </div>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>Sex</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_m) && $disclosures_demographic_borrower_m == 'on' ? "checked" : "") }} class="updatable" name="borrower_m" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_m"">Male</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_f) && $disclosures_demographic_borrower_f == 'on' ? "checked" : "") }} class="updatable" name="borrower_f" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_f"">Female</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_borrower_i_do_not_wish_to_provide_sex_information) && $disclosures_demographic_borrower_i_do_not_wish_to_provide_sex_information == 'on' ? "checked" : "") }} class="updatable" name="borrower_i_do_not_wish_to_provide_sex_information" data-type="disclosures" data-model="demographic" >
                            <label for="borrower_i_do_not_wish_to_provide_sex_information"">I do not wish to provide this information</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-field">
            </div>
        </div>

    </div>


    <div
        style="display: {{ (isset($start_has_co_borrower) && $start_has_co_borrower == 'yes') ? 'initial' : 'none' }};">

        <div class="item-field">
            <div class="divider">
                <b>Co-Borrower</b>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>Ethnicity</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_hispanic_or_latino) && $disclosures_demographic_coborrower_hispanic_or_latino == 'on' ? "checked" : "") }} class="updatable" name="coborrower_hispanic_or_latino" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_hispanic_or_latino"">Hispanic or Latino</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_not_hispanic_or_latino) && $disclosures_demographic_coborrower_not_hispanic_or_latino == 'on' ? "checked" : "") }} class="updatable" name="coborrower_not_hispanic_or_latino" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_not_hispanic_or_latino"">Not Hispanic or Latino</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_i_do_not_wish_to_provide_ethnicity_information) && $disclosures_demographic_coborrower_i_do_not_wish_to_provide_ethnicity_information == 'on' ? "checked" : "") }} class="updatable" name="coborrower_i_do_not_wish_to_provide_ethnicity_information" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_i_do_not_wish_to_provide_ethnicity_information"">I do not wish to provide this information</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Ethnicity Origin</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_mexican) && $disclosures_demographic_coborrower_mexican == 'on' ? "checked" : "") }} class="updatable" name="coborrower_mexican" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_mexican"">Mexican</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_puerto_rican) && $disclosures_demographic_coborrower_puerto_rican == 'on' ? "checked" : "") }} class="updatable" name="coborrower_puerto_rican" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_puerto_rican"">Puerto Rican</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_cuban) && $disclosures_demographic_coborrower_cuban == 'on' ? "checked" : "") }} class="updatable" name="coborrower_cuban" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_cuban"">Cuban</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_other) && $disclosures_demographic_coborrower_other == 'on' ? "checked" : "") }} class="updatable" name="coborrower_other" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_other"">Other</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="item-field">
            <div class="question">
                <b>Other Hispanic or Latino</b>
            </div>
            <div class="answer">
                <div>
                    <input type='text' value="{{ (isset($disclosures_demographic_coborrower_ethnicity_text_hdma1) ? $disclosures_demographic_coborrower_ethnicity_text_hdma1 : "") }}" class="updatable" name="coborrower_ethnicity_text_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(50% - 50px)" >
                </div>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>Race</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_american_indian_or_alaska_native) && $disclosures_demographic_coborrower_american_indian_or_alaska_native == 'on' ? "checked" : "") }} class="updatable" name="coborrower_american_indian_or_alaska_native" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_american_indian_or_alaska_native"">American Indian or Alaska Native</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_asian) && $disclosures_demographic_coborrower_asian == 'on' ? "checked" : "") }} class="updatable" name="coborrower_asian" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_asian"">Asian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_black_or_african_american) && $disclosures_demographic_coborrower_black_or_african_american == 'on' ? "checked" : "") }} class="updatable" name="coborrower_black_or_african_american" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_black_or_african_american"">Black or African American</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_native_hawaiian_or_other_pacific_islander) && $disclosures_demographic_coborrower_native_hawaiian_or_other_pacific_islander == 'on' ? "checked" : "") }} class="updatable" name="coborrower_native_hawaiian_or_other_pacific_islander" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_native_hawaiian_or_other_pacific_islander"">Native Hawaiian or Other Pacific Islander</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_white) && $disclosures_demographic_coborrower_white == 'on' ? "checked" : "") }} class="updatable" name="coborrower_white" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_white"">White</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_i_do_not_wish_to_provide_race_information) && $disclosures_demographic_coborrower_i_do_not_wish_to_provide_race_information == 'on' ? "checked" : "") }} class="updatable" name="coborrower_i_do_not_wish_to_provide_race_information" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_i_do_not_wish_to_provide_race_information"">I do not wish to provide this information</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Race Other</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_asian_indian) && $disclosures_demographic_coborrower_asian_indian == 'on' ? "checked" : "") }} class="updatable" name="coborrower_asian_indian" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_asian_indian"">Asian Indian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_chinese) && $disclosures_demographic_coborrower_chinese == 'on' ? "checked" : "") }} class="updatable" name="coborrower_chinese" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_chinese"">Chinese</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_filipino) && $disclosures_demographic_coborrower_filipino == 'on' ? "checked" : "") }} class="updatable" name="coborrower_filipino" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_filipino"">Filipino</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_japanese) && $disclosures_demographic_coborrower_japanese == 'on' ? "checked" : "") }} class="updatable" name="coborrower_japanese" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_japanese"">Japanese</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_korean) && $disclosures_demographic_coborrower_korean == 'on' ? "checked" : "") }} class="updatable" name="coborrower_korean" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_korean"">Korean</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_vietnamese) && $disclosures_demographic_coborrower_vietnamese == 'on' ? "checked" : "") }} class="updatable" name="coborrower_vietnamese" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_vietnamese"">Vietnamese</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_other_asian) && $disclosures_demographic_coborrower_other_asian == 'on' ? "checked" : "") }} class="updatable" name="coborrower_other_asian" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_other_asian"">Other Asian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_native_hawaiian) && $disclosures_demographic_coborrower_native_hawaiian == 'on' ? "checked" : "") }} class="updatable" name="coborrower_native_hawaiian" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_native_hawaiian"">Native Hawaiian</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_guamanian_or_chamorro) && $disclosures_demographic_coborrower_guamanian_or_chamorro == 'on' ? "checked" : "") }} class="updatable" name="coborrower_guamanian_or_chamorro" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_guamanian_or_chamorro"">Guamanian or Chamorro</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_samoan) && $disclosures_demographic_coborrower_samoan == 'on' ? "checked" : "") }} class="updatable" name="coborrower_samoan" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_samoan"">Samoan</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_other_pacific_islander) && $disclosures_demographic_coborrower_other_pacific_islander == 'on' ? "checked" : "") }} class="updatable" name="coborrower_other_pacific_islander" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_other_pacific_islander"">Other Pacific Islander</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>American Indian or Alaskan Native</b>
                </div>
                <div class="answer">
                    <div>
                        <input type='text' value="{{ (isset($disclosures_demographic_coborrower_race_text_hdma1) ? $disclosures_demographic_coborrower_race_text_hdma1 : "") }}" class="updatable" name="coborrower_race_text_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(100% - 50px)" >
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Other Asian</b>
                </div>
                <div class="answer">
                    <div>
                        <input type='text' value="{{ (isset($disclosures_demographic_coborrower_race_text_asian_hdma1) ? $disclosures_demographic_coborrower_race_text_asian_hdma1 : "") }}" class="updatable" name="coborrower_race_text_asian_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(100% - 50px)" >
                    </div>
                </div>
            </div>
            <div class="item-field">
                <div class="question">
                    <b>Native Hawaiian or Other Pacific Islander</b>
                </div>
                <div class="answer">
                    <div>
                        <input type='text' value="{{ (isset($disclosures_demographic_coborrower_race_text_islander_hdma1) ? $disclosures_demographic_coborrower_race_text_islander_hdma1 : "") }}" class="updatable" name="coborrower_race_text_islander_hdma1" data-type="disclosures" data-model="demographic" style="width: calc(100% - 50px)" >
                    </div>
                </div>
            </div>
        </div>

        <div class="multiple-items">
            <div class="item-field">
                <div class="question">
                    <b>Sex</b>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_m) && $disclosures_demographic_coborrower_m == 'on' ? "checked" : "") }} class="updatable" name="coborrower_m" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_m"">Male</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_f) && $disclosures_demographic_coborrower_f == 'on' ? "checked" : "") }} class="updatable" name="coborrower_f" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_f"">Female</label>
                        </div>
                    </div>
                </div>
                <div class="item-field">
                    <div class="answer">
                        <div>
                            <input type='checkbox' {{ (isset($disclosures_demographic_coborrower_i_do_not_wish_to_provide_sex_information) && $disclosures_demographic_coborrower_i_do_not_wish_to_provide_sex_information == 'on' ? "checked" : "") }} class="updatable" name="coborrower_i_do_not_wish_to_provide_sex_information" data-type="disclosures" data-model="demographic" >
                            <label for="coborrower_i_do_not_wish_to_provide_sex_information"">I do not wish to provide this information</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-field">
            </div>
        </div>

    </div>
@endsection
