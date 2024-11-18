<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class EmployeeService
{
    public static function getStudentForId($id){
//        TODO: O'qituvchilarni HEMIS dan olish
        $client = new Client(['verify' => false]);
        $params = "search={$id}";
        $headers = [
            'Authorization' => 'Bearer '.env('EMPLOYEE_TOKEN'),
        ];
        $request = new Request('GET', "https://student.ubtuit.uz/rest/v1/data/student-list?{$params}", $headers);
        $res = $client->sendAsync($request)->wait();
        $employees = json_decode($res->getBody());
        return $employees;
    }

    public static function getEmployee($page = 1){
//        TODO: O'qituvchilarni HEMIS dan olish
        $client = new Client(['verify' => false]);
        $params = "type=all&limit=200&page={$page}";
        $headers = [
            'Authorization' => 'Bearer '.env('EMPLOYEE_TOKEN'),
        ];
        $request = new Request('GET', "https://student.ubtuit.uz/rest/v1/data/employee-list?{$params}", $headers);
        $res = $client->sendAsync($request)->wait();
        $employees = json_decode($res->getBody());
        return $employees;
    }

    public static function getEmployeeAll(){
//        TODO: Hamma o'qituvchilarni olish
        $employees = session('employees');
        if (!isset($employees)){
            $employees = self::getEmployee();
            $all_employee = [];
            if ($employees->code == 200){
                $pageCount = $employees->data->pagination->pageCount;
                for ($page = 1; $page <= $pageCount; $page ++){
                    $new_employee = self::getEmployee($page);
                    foreach ($new_employee->data->items as $item)
                        array_push($all_employee, $item);
                }
            }
            session()->put('employees', $all_employee);
        }
    }

    public static function getEmployeeForId($id, $department = null){
//        TODO: O'qituvchi ma'lumotini olish uchun
        $teachers = session('employees');
        if (!isset($teachers)){
            EmployeeService::getEmployeeAll();
            $teachers = session('employees');
        }
        $new_teachers_for_index = [];
        foreach ($teachers as $teacher){
            if ($department == null){
                if ($teacher->employee_id_number == $id)
                    $new_teachers_for_index = $teacher;
            } else {
                if ($teacher->employee_id_number == $id && $teacher->department->id == $department)
                    $new_teachers_for_index = $teacher;
            }
        }
        return $new_teachers_for_index;
    }

    public static function getTeacherEmployeeForId($employee_id)
    {
//        TODO: NAVBAR dagi kafedra almashuvi uchun
        $client = new Client(['verify' => false]);
        $params = [
            "type" => "teacher",
            "search" => $employee_id,
        ];
        $params = http_build_query($params);
        $headers = [
            'Authorization' => 'Bearer '.env('EMPLOYEE_TOKEN'),
        ];
        $request = new Request('GET', "https://student.ubtuit.uz/rest/v1/data/employee-list?{$params}", $headers);
        $res = $client->sendAsync($request)->wait();
        return json_decode($res->getBody())->data;
    }

    public static function getEmployeeIdForDepartment($id){
//        TODO: O'qituvchi ma'lumotini olish uchun
        $teachers = session('employees');
        if (!isset($teachers)){
            EmployeeService::getEmployeeAll();
            $teachers = session('employees');
        }
        $new_teachers_for_index = [];
        foreach ($teachers as $teacher){
            if ($teacher->employee_id_number == $id)
                $new_teachers_for_index[] = $teacher;
        }
        return $new_teachers_for_index;
    }


    public static function getEmployeesWithKafedra(){
//        TODO: Barcha kafedralarni o'qituvchilarni aniqlash
        $teachers = session('employees');
        if (!isset($teachers)){
            EmployeeService::getEmployeeAll();
            $teachers = session('employees');
        }
        $new_teachers = [];
        foreach ($teachers as $teacher){
            if ($teacher->employeeStatus->code == 11)
            $new_teachers[$teacher->department->id][] = $teacher;
        }
        $teachers = $new_teachers;
        return $teachers;
    }

    public static function getEmployeesInKafedra($kafedra){
//        TODO: Kafedra ichidagi o'qituvchini aniqlash (1)
        $teachers = self::getEmployeesWithKafedra();
        foreach ($teachers as $key => $teacher) {
            if ($key != $kafedra) {
                unset($teachers[$key]);
            }
        }
        return $teachers;
    }
}
