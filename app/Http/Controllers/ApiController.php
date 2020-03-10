<?php

namespace App\Http\Controllers;

use App\Imports\TransactionsImport;
use Illuminate\Http\Request;
use App\Transactions;
use App\UserDetails;
use App\Users;
use Excel;

class ApiController extends Controller
{
    /**
     * Exercise 1:
     * return all the users which are `active` (users table) and have an Austrian citizenship
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getActiveAustrianUsers() {
        try {
            $activeAustrianUsers = Users::where([
                'users.active' => 1,
                'user_details.citizenship_country_id' => 1
            ])
                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                ->join('countries', 'user_details.citizenship_country_id', '=', 'countries.id')
                ->get();
            return response($activeAustrianUsers, 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }

    }

    /**
     * Exercise 1:
     * edit user details just if the user details are there already
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateUserDetails(Request $request, int $id) {
        try {
            $userDetails = UserDetails::find((int)$id);
            $userDetails->user_id = is_null($request->user_id) ? $userDetails->user_id : $request->user_id;
            $userDetails->citizenship_country_id = is_null($request->citizenship_country_id) ? $userDetails->citizenship_country_id : $request->citizenship_country_id;
            $userDetails->first_name = is_null($request->first_name) ? $userDetails->first_name : $request->first_name;
            $userDetails->last_name = is_null($request->last_name) ? $userDetails->last_name : $request->last_name;
            $userDetails->phone_number = is_null($request->phone_number) ? $userDetails->phone_number : $request->phone_number;
            $userDetails->save();
            return response($userDetails, 200);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Exercise 1:
     * delete a user just if no user details exist yet
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteUser(int $id) {
        try {
            $userDetails = UserDetails::where(['user_id' => (int)$id])->get();
            if(count($userDetails)) {
                return response("Forbidden: User details found", 403);
            } else {
                Users::destroy((int)$id);
                return response("User {$id} deleted", 200);
            }
        }catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Exercise 2:
     * return the transactions combined in a json
     * @param string $origin
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getTransactions($origin) {
        $response = [];
        try {
            switch ($origin) {
                case 'db':
                    $response = Transactions::all()->toArray();
                    break;
                case 'csv':
                    $response = Excel::toArray(new TransactionsImport, base_path() . '/csv/transactions.csv')[0];
                    break;
                case 'all':
                    $dbArray = Transactions::all()->toArray();
                    $csvArray = Excel::toArray(new TransactionsImport, base_path() . '/csv/transactions.csv')[0];
                    $response = array_merge($dbArray, $csvArray);
                    break;
                default:
                    return response('Choose a valid content (db, csv or all)', 200);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
        return response($response, 200);
    }
}
