<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\CBR_table;
use App\MangopayKyc;
use App\User;
use App\Withdrawals;
use App\Deposits;

class CallbackController extends Controller
{
  private $mangopay;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct(\MangoPay\MangoPayApi $mangopay)
     {
        $this->mangopay = $mangopay;
        // $this->middleware('global');
    }
    public function fail(Request $request){
      Log::error($request->all());

      if(isset($request->EventType) && $request->EventType == "KYC_FAILED" ){
        $document_type = '';
        $CBR_table = MangopayKyc::where('kyc_document', $request->RessourceId)->first();
        if($CBR_table){
          // MangopayKyc::where('kyc_document', $request->RessourceId)->update(['kyc_document' => NULL] );
          $document_type = 'kyc_document';
        }else if($CBR_table = MangopayKyc::where('articles_of_association', $request->RessourceId)->first()){
          // MangopayKyc::where('articles_of_association', $request->RessourceId)->update(['articles_of_association' => NULL] );
          $document_type = 'articles_of_association';

        }else if($CBR_table = MangopayKyc::where('registration_proof', $request->RessourceId)->first()){
          // MangopayKyc::where('registration_proof', $request->RessourceId)->update(['registration_proof' => NULL] );
          $document_type = 'registration_proof';

        }else if($CBR_table = MangopayKyc::where('SHAREHOLDER_DECLARATION', $request->RessourceId)->first()){
          // MangopayKyc::where('SHAREHOLDER_DECLARATION', $request->RessourceId)->update(['SHAREHOLDER_DECLARATION' => NULL] );
          $document_type = 'SHAREHOLDER_DECLARATION';

        }

        if(strlen($document_type)>1){
          $user = User::where('id', $CBR_table['id'])->first();
          $mangopay_id = $user['Mangopay_id'];
          $KycDocument = $this->mangopay->Users->GetKycDocument($mangopay_id, $request->RessourceId);
          $reason = $this->reasonToString($KycDocument->RefusedReasonType);
          if(strlen($KycDocument->RefusedReasonMessage)>1)
            $reason = $reason . ' - ' . $KycDocument->RefusedReasonMessage;
          Log::error($reason);

          MangopayKyc::where($document_type, $request->RessourceId)->update([$document_type  => NULL, $document_type.'_reason' => $reason] );
        }
      }
    }
    private function reasonToString($refusedReasonType){
      switch ($refusedReasonType) {
              case 'DOCUMENT_UNREADABLE':
                  return "Document unreadable";
                  break;
              case 'DOCUMENT_NOT_ACCEPTED':
                  return "Document not accepted";
                  break;
              case 'DOCUMENT_HAS_EXPIRED':
                  return "Document has expired";
                  break;
              case 'DOCUMENT_INCOMPLETE':
                  return "Document incomplete";
                  break;
              case 'DOCUMENT_MISSING':
                  return "Document missing";
                  break;
              case 'DOCUMENT_DO_NOT_MATCH_USER_DATA':
                  return "Document does not match user data";
                  break;
              case 'DOCUMENT_DO_NOT_MATCH_ACCOUNT_DATA':
                  return "Document does not match user data";
                  break;
              case 'SPECIFIC_CASE':
                  return "Specific case";
                  break;
              case 'DOCUMENT_FALSIFIED':
                  return "Document falsified";
                  break;
              case 'UNDERAGE_PERSON':
                  return "Underage person";
                  break;
      }
    }
    public function flag(Request $request){
      Log::error($request->all());
      if(isset($request->EventType) && $request->EventType == "KYC_VALIDATION_ASKED" ){
          // $CBR_table = MangopayKyc::where('kyc_document', $request->RessourceId)->first();
          // if($CBR_table){
          //    MangopayKyc::where('kyc_document', $request->RessourceId)->update(['kyc_document' => NULL] );
          // }else {
            $user = User::where('Mangopay_id', $request->RessourceId)->first();
            if($user){
              User::where('Mangopay_id', $request->RessourceId)->update(['kyc_flag' => 1]);
            }
          // }
        }
    }
    public function success(Request $request){
      if(isset($request->EventType) && $request->EventType == "KYC_SUCCEEDED" ){
        $CBR_table = MangopayKyc::where('kyc_document', $request->RessourceId)->first();
        if($CBR_table){
           MangopayKyc::where('kyc_document', $request->RessourceId)->update(['kyc_document_approuved' => 1] );
           $CBR_table = MangopayKyc::where('kyc_document', $request->RessourceId)->first();
        }else if($CBR_table = MangopayKyc::where('articles_of_association', $request->RessourceId)->first()){
          MangopayKyc::where('articles_of_association', $request->RessourceId)->update(['articles_of_association_approuved' => 1] );
          $CBR_table = MangopayKyc::where('articles_of_association', $request->RessourceId)->first();
        }else if($CBR_table = MangopayKyc::where('registration_proof', $request->RessourceId)->first()){
          MangopayKyc::where('registration_proof', $request->RessourceId)->update(['registration_proof_approuved' => 1] );
          $CBR_table = MangopayKyc::where('registration_proof', $request->RessourceId)->first();
        }else if($CBR_table = MangopayKyc::where('SHAREHOLDER_DECLARATION', $request->RessourceId)->first()){
          MangopayKyc::where('SHAREHOLDER_DECLARATION', $request->RessourceId)->update(['SHAREHOLDER_DECLARATION_approuved' => 1] );
          $CBR_table = MangopayKyc::where('SHAREHOLDER_DECLARATION', $request->RessourceId)->first();
        }
        if( $CBR_table->kyc_document_approuved == 1 && $CBR_table->articles_of_association_approuved == 1 && $CBR_table->registration_proof_approuved == 1 && $CBR_table->SHAREHOLDER_DECLARATION_approuved == 1 && is_null($CBR_table->ubo_declaration)){
            $user =   User::whereId($CBR_table->id)->first();
            if($user->business_type == 'company'){
              $profile =  CBR_table::whereId($CBR_table->id)->first();
              $UserId = $user->Mangopay_id;
              $Result = $this->mangopay->UboDeclarations->Create($UserId);
              $UboDeclarationId = $Result->Id;
              $ubo = new \MangoPay\Ubo();
              $ubo->FirstName = $profile->lrd_firstname;
              $ubo->LastName =  $profile->lrd_lastname;
              $ubo->Address = new \MangoPay\Address();
              $ubo->Address->AddressLine1 =   $profile->ma_HBN .', '.$profile->ma_street;
              $ubo->Address->City =  $profile->company_ma_town_or_city;
              $ubo->Address->PostalCode =  $profile->company_ma_postcode;
              $ubo->Address->Country =  $profile->lrd_country;
              $ubo->Nationality =  $profile->lrd_nationality;
              $ubo->Birthday =  strtotime($profile->lrd_DOB);
              $ubo->Birthplace = new \MangoPay\Birthplace();
              $ubo->Birthplace->City =  $profile->lrd_birth_city;
              $ubo->Birthplace->Country =  $profile->lrd_birth_country;
              $this->mangopay->UboDeclarations->CreateUbo($UserId, $UboDeclarationId, $ubo);
              $this->mangopay->UboDeclarations->SubmitForValidation($UserId, $UboDeclarationId);
              MangopayKyc::where('id', $user->id)->update(['ubo_declaration' => $UboDeclarationId] );

           }
        }

      }
    }
    public function success_ubo(Request $request){

      Log::error($request->all());
      if(isset($request->EventType) && $request->EventType == "UBO_DECLARATION_VALIDATED" ){
        $CBR_table = MangopayKyc::where('ubo_declaration', $request->RessourceId)->first();
        if($CBR_table){
           MangopayKyc::where('ubo_declaration', $request->RessourceId)->update(['ubo_declaration_approuved' => 1] );
        }
      }

    }
    public function fail_ubo(Request $request){
      if(isset($request->EventType) && $request->EventType == "UBO_DECLARATION_REFUSED" ){
        $CBR_table = MangopayKyc::where('ubo_declaration', $request->RessourceId)->first();
        if($CBR_table){
          // $KycDocument = $this->mangopay->Users->GetKycDocument($request->RessourceId);
          //$KycDocument
           MangopayKyc::where('ubo_declaration', $request->RessourceId)->update(['ubo_declaration' => NULL] );
        }
      }
    }
    public function verification_ubo(Request $request){
      Log::error($request->all());
      if(isset($request->EventType) && $request->EventType == "UBO_DECLARATION_INCOMPLETE" ){
        $CBR_table = MangopayKyc::where('ubo_declaration', $request->RessourceId)->first();
        if($CBR_table){
          MangopayKyc::where('ubo_declaration', $request->RessourceId)->update(['ubo_declaration_approuved' => 2] );
        }
      }

    }

    public function payout_succeeded(Request $request){
      Log::error($request->all());
      if(isset($request->EventType) && $request->EventType == "PAYOUT_NORMAL_SUCCEEDED" ){
        $withdrawals = Withdrawals::where('withdraw_reference_from_processor', $request->RessourceId)->first();
        if($withdrawals){
          Withdrawals::where('withdraw_reference_from_processor', $request->RessourceId)->update(['status' => 1] );
        }
      }

    }

    public function payout_failed(Request $request){
      Log::error($request->all());
      if(isset($request->EventType) && $request->EventType == "PAYOUT_NORMAL_FAILED" ){
        $withdrawals = Withdrawals::where('withdraw_reference_from_processor', $request->RessourceId)->first();
        if($withdrawals){
          Withdrawals::where('withdraw_reference_from_processor', $request->RessourceId)->update(['status' => 2] );
          Deposits::where('withdraw_id', $withdrawals->id)->update(['withdraw_id'=>null,'status'=>1]);
        }
      }

    }
}
