<?php

namespace App\Entity\Enum;

enum StatusEnum: string
{
  case DRAFT = 'draft';
  case SUBMITTED = 'submitted';
  case APPROVED = 'approved';
  case REJECTED = 'rejected';
}
