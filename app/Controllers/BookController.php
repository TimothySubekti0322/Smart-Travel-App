<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use CodeIgniter\API\ResponseTrait;
use App\Models\User;
use App\Models\Package;
use PhpParser\Node\Expr\Empty_;

use function PHPUnit\Framework\isEmpty;

class BookController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
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
            $model = new Book();
            $data = $model->findAll();

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
            // 'label' => $data,
            // 'data' => $bookData,
            'label' => $newData,
            'data' => $newBookData
        ]);
    }
}
