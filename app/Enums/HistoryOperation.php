<?php

namespace App\Enums;

enum HistoryOperation: string
{
  case Create = 'create';
  case Update = 'update';
  case Delete = 'delete';
}
