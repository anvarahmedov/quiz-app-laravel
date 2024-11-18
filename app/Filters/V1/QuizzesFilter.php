<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class QuizzesFilter extends ApiFilter {
   // $table->integer('customer_id');
  //          $table->integer('amount');
  //          $table->string('status');
  //          $table->dateTime('billed_date');
 //   $table->dateTime('paid_date')->nullable();
    protected $safeParms = [
        'id' => ['eq', 'ne'],
        'userId' => ['eq', 'ne'],
        'slug' => ['eq', 'ne'],
        'category' => ['eq', 'ne'],
        'createdDate' => ['eq', 'ne'],
        'featured' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'userId' => 'user_id',
        'createdDate' => 'created_date',
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
