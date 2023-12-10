<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Midtrans\Config;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];
    protected $uploadsFolder = 'uploads/';

    protected $rajaOngkirApiKey = null;
    protected $rajaOngkirBaseUrl = null;
    protected $rajaOngkirOrigin = null;

    protected $couriers = [
        'dhl' => 'DHL',
        'fedex' => 'FedEx',
        'sundarban' => 'Sundarban Couriers',
        'redex' => 'Redex',
    ];

    protected $provinces = [
        1 => 'Province A',
        2 => 'Province B',
        3 => 'Province C',
        4 => 'Province D',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->rajaOngkirApiKey = config('rajaongkir.api_key');
        $this->rajaOngkirBaseUrl = config('rajaongkir.base_url');
        $this->rajaOngkirOrigin = config('rajaongkir.origin');
    }

    /**
     * Get provinces
     *
     * @return array
     */
    protected function getProvinces()
    {
        return response()->json([
            'status' => 200,
            'provinces' => $this->provinces,
        ]);
    }

    /**
     * Get cities by province ID
     *
     * @param int $provinceId province id
     *
     * @return array
     */
    protected function getCities($provinceId)
    {
        $cities = [];
        
        switch ($provinceId) {
            case 1: // Province A
                $cities = [101 => 'City W', 102 => 'City X'];
                break;
            case 2: // Province B
                $cities = [201 => 'City Y'];
                break;
            case 3: // Province C
                $cities = [301 => 'City Z'];
                break;
            // Add cases for other provinces as needed
        }

        return $cities;
    }

    protected function getShippingCost($destination, $weight)
    {
        $results = [];

        foreach ($this->couriers as $code => $courier) {
            $serviceName = strtoupper($code);
            $costAmount = $weight * 0.1; // Replace with your actual cost calculation logic
            $etd = '2 days'; // Replace with your actual estimated time of delivery logic

            $result = [
                'service' => $serviceName,
                'cost' => $costAmount,
                'etd' => $etd,
                'courier' => $code,
            ];

            $results[] = $result;
        }

        $response = [
            'origin' => 'YourOrigin', // Replace with your actual origin
            'destination' => $destination,
            'weight' => $weight,
            'results' => $results,
        ];

        return $response;
    }

	protected function initPaymentGateway()
	{
		// Set your Merchant Server Key
		Config::$serverKey = config('midtrans.serverKey');
		// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
		Config::$isProduction = config('midtrans.isProduction');
		// Set sanitization on (default)
		Config::$isSanitized = config('midtrans.isSanitized');
		// Set 3DS transaction for credit card to true
		Config::$is3ds = config('midtrans.is3ds');
	}
	/**
     * Raja Ongkir Request (Shipping Cost Calculation)
     *
     * @param string $resource resource url
     * @param array  $params   parameters
     * @param string $method   request method
     *
     * @return json
     */
    protected function rajaOngkirRequest($resource, $params = [], $method = 'GET')
    {
        $client = new \GuzzleHttp\Client();

        $headers = ['key' => $this->rajaOngkirApiKey];
        $requestParams = [
            'headers' => $headers,
        ];

        $url =  $this->rajaOngkirBaseUrl . $resource;
        if ($params && $method == 'POST') {
            $requestParams['form_params'] = $params;
        } else if ($params && $method == 'GET') {
            $query = is_array($params) ? '?'.http_build_query($params) : '';
            $url = $this->rajaOngkirBaseUrl . $resource . $query;
        }
        
        $response = $client->request($method, $url, $requestParams);

        return json_decode($response->getBody(), true);
    }
}
