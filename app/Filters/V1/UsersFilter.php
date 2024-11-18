<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class UsersFilter extends ApiFilter {
    protected $safeParms = [
        'name' => ['eq'],
        'role' => ['eq', 'ne'],
        'email' => ['eq'],
        'id' => ['eq'],
    ];

    protected $operatorMap = [
        'ne' => "!=",
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];


}
