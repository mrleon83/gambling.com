<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Affiliates;
class FileUpload extends Controller
{
  protected $hq_long = -6.2535495;
  protected $hq_lat  = 53.3340285;

  public function createForm(){
    return view('file_upload');
  }

  public function fileUpload(Request $req){
        $file = $req->file('file');
        $fp = fopen($file, 'rb');
            while ( ($line = fgets($fp)) !== false) {
                $json =  json_decode( $line );

                $distance = $this->greatCircleDistance( $this->hq_lat, $this->hq_long, $json->latitude, $json->longitude );

                Affiliates::firstOrCreate([
                        'affiliate_id' => $json->affiliate_id
                    ],
                    [
                        'name'          => $json->name,
                        'latitude'      => $json->latitude,
                        'longitude'     => $json->longitude,
                        'distance_hq'   => $distance
                ]);
            }
            $allrecords = Affiliates::select('name','affiliate_id' )
                                        ->where('distance_hq' , '<', 100)
                                        ->orderBy('affiliate_id')
                                        ->get();

            return view('file_upload', ['allrecords' => $allrecords]);
   }

   public function greatCircleDistance( $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000 )
        {

            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $lonDelta = $lonTo - $lonFrom;

            $a = pow(cos($latTo) * sin($lonDelta), 2) +
                 pow(cos($latFrom) * sin($latTo) -
                 sin($latFrom) * cos($latTo) * cos($lonDelta), 2);

            $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

            $angle = atan2(sqrt($a), $b);

            return $angle * $earthRadius/1000;
        }
    }
