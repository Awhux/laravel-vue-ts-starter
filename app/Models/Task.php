<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  /**
   * Add id, title and description
   */
  protected $fillable = [
    'id',
    'title',
    'description',
  ];
}
