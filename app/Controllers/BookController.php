<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use CodeIgniter\API\ResponseTrait;
use App\Models\User;
use App\Models\Package;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Controllers\Authorization;

class BookController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        try {
            helper('cookie');
            $jwt = get_cookie('token');

            // If no token found, redirect to login page
            if(!$jwt) {
                return redirect()->to('/login');
            }

            $key = "d2ff7174120474a55903c47ec1b44ccb672ef3d889ea24be72650eba1ae40d57";
            
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        } catch (\Exception $e) {

            // If token is invalid, redirect to login page
            return redirect()->to('/login');
        }

        
        return view('book');
    }

    public function checkSeat()
    {
        try {

            $date = $this->request->getVar('date');
            $time = $this->request->getVar('time');
            $packageId = $this->request->getVar('packageId');

            $model = new Book();

            // Check in the Book Table where date = $date, and time = $time
            $bookings = $model
            ->where(["date" => $date, "time" => $time, "packageId" => $packageId])
            ->findAll(); // Retrieve all matching records

            if (empty($bookings)) {
                return $this->respond([
                    'status' => 404,
                    'data' => [],
                ]); // If no matching records, return an empty array
            }

            // Collect seat numbers from matching bookings
            $allSeatsArray = [];
            foreach ($bookings as $booking) {
                $seatData = $booking['seat']; // Assuming the seat data is stored in a 'seat' column
                $seats = explode(',', $seatData); // Split the seat data into an array
                $allSeatsArray = array_merge($allSeatsArray, $seats); // Merge seat numbers into the result array
            }

            return $this->respond([
                'status' => 200,
                'data' => $allSeatsArray
            ]);

            
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function create() {
        try {
            $rule = [
                'userId' => 'required',
                'name' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'date' => 'required',
                'time' => 'required',
                'packageId' => 'required',
                'seat' => 'required',
                'ticket' => 'required',
                'total' => 'required',
            ];

            if(!$this->validate($rule)) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Bad Request',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $userId = $this->request->getVar('userId');
            $name = $this->request->getVar('name');
            $email = $this->request->getVar('email');
            $telephone = $this->request->getVar('telephone');
            $date = $this->request->getVar('date');
            $time = $this->request->getVar('time');
            $packageId = $this->request->getVar('packageId');
            $seat = $this->request->getVar('seat');
            $ticket = $this->request->getVar('ticket');
            $total = $this->request->getVar('total');

            $user = new User(); 
            
            if(!($user->checkUserIdExistence($userId))) {
                return $this->respond([
                    'status' => 404,
                    'message' => 'UserId not found'
                ]);
            }
            
            $package = new Package();

            if(!($package->checkPackageIdExistence($packageId))) {
                return $this->respond([
                    'status' => 404,
                    'message' => 'PackageId not found'
                ]);
            }

            $model = new Book();

            $data = [
                'userId' => $userId,
                'name' => $name,
                'email' => $email,
                'telephone' => $telephone,
                'date' => $date,
                'time' => $time,
                'packageId' => $packageId,
                'seat' => $seat,
                'ticket' => $ticket,
                'total' => $total
            ];

            $model->insert($data);

            return $this->respond([
                'status' => 201,
                'message' => 'Booking order created successfully'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'message' => $e->getMessage()
            ],200);
        }
    }

    public function getAllBooks() {
        try {
            $authHeader = $this->request->getHeaderLine('Authorization');
            if(!$authHeader) {
                return $this->respond([
                    'status' => 401,
                    'message' => 'No Authorization header found'
                ]);
            }
            $headerValue = explode(' ', $authHeader); // Bearer <token>
            
            if(count($headerValue)==1) {
                return $this->respond([
                    'status' => 401,
                    'message' => 'No token provided in the authorization header'
                ]);
            }

            $jwt = $headerValue[1]; // Get the token

            $key = "d2ff7174120474a55903c47ec1b44ccb672ef3d889ea24be72650eba1ae40d57";
            
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

            if($decoded->data->role !== 'admin') {
                return $this->respond([
                    'status' => 401,
                    'message' => 'Unauthorized'
                ]);
            }

            $model = new Book();
            $data = $model->getBookTable();

            return $this->respond([
                'status' => 200,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getBookAnalytics() {

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if($email !== 'admin@gmail.com' || $password !== 'admin') {
            return $this->respond([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }
        
        $package = new Package();
        $data = $package->getAllDestination();

        $dataLength = count($data);

        $books = new Book();
        $bookData = $books->getOrderQuantityPerDestination($dataLength);

        // Combine data and bookData into an associative array
        $result = [];
        foreach ($data as $index => $value) {
            if (!array_key_exists($value, $result)) {
                $result[$value] = 0;
            }
            $result[$value] += $bookData[$index];
        }

        // Separate merged data and bookData
        $newData = array_keys($result);
        $newBookData = array_values($result);

        return $this->respond([
            'status' => 200,
            'label' => $newData,
            'data' => $newBookData
        ]);
    }

    public function getHighestBooked() {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if($email !== 'admin@gmail.com' || $password !== 'admin') {
            return $this->respond([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }
        
        $package = new Package();
        $data = $package->getAllDestination();

        $dataLength = count($data);

        $books = new Book();
        $bookData = $books->getOrderQuantityPerDestination($dataLength);

        // Combine data and bookData into an associative array
        $result = [];
        foreach ($data as $index => $value) {
            if (!array_key_exists($value, $result)) {
                $result[$value] = 0;
            }
            $result[$value] += $bookData[$index];
        }

        // Separate merged data and bookData
        $newData = array_keys($result);
        $newBookData = array_values($result);

        // Check the Highest Booked Package
        $quantity = max($newBookData);
        $city = $newData[array_search($quantity, $newBookData)];

        return $this->respond([
            'status' => 200,
            'city' => $city,
            'quantity' => $quantity
        ]);
    }

    public function getBookingHistory($id) {
        try {
            $authHeader = $this->request->getHeaderLine('Authorization');
            if(!$authHeader) {
                return $this->respond([
                    'status' => 401,
                    'message' => 'No Authorization header found',
                    'data' => []
                ]);
            }
            $headerValue = explode(' ', $authHeader); // Bearer <token>
            
            if(count($headerValue)==1) {
                return $this->respond([
                    'status' => 401,
                    'message' => 'No token provided in the authorization header',
                    'data' => []
                ]);
            }

            $jwt = $headerValue[1]; // Get the token

            $key = "d2ff7174120474a55903c47ec1b44ccb672ef3d889ea24be72650eba1ae40d57";
            
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

            if($decoded->data->id !== $id) {
                return $this->respond([
                    'status' => 401,
                    'message' => 'Unauthorized',
                    'data' => []
                ]);
            }

            $model = new Book();
            $data = $model->orderHistory($id);
            // $data = $model->where('userId', $id)->findAll();
            return $this->respond([
                'status' => 200,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

}