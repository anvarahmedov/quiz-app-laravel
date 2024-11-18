<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ResultsFilter extends ApiFilter {
   // $table->integer('customer_id');
  //          $table->integer('amount');
  //          $table->string('status');
  //          $table->dateTime('billed_date');
 //   $table->dateTime('paid_date')->nullable();
    protected $safeParms = [
        'id' => ['eq', 'ne'],
        'userId' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'result' => ['eq', 'ne', 'lt', 'lte', 'gt', 'gte'],
        'quizId' => ['eq', 'ne','lt', 'lte', 'gt', 'gte'],
    ];

    protected $columnMap = [
        'userId' => 'user_id',
        'quizId' => 'quiz_id',
    ];

    protected $operatorMap = [
        'ne' => "!=",
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}
