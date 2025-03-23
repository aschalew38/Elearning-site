<?php

namespace App;

use Illuminate\Support\Facades\App;

class Constants
{
    public const SUPER_ADMIN_ROLE = 'Super Admin';
    const STUDENT_ROLE = 'Student';
    const ADMIN_ROLE = 'Admin';
    const TRAINER_ROLE = 'Trainer';
    const USER_ROLE = 'User';
    const TF_CODE = 'True or False';
    const ASSESSMENT_TYPE_EXERCISE = 'Exercise';
    const ASSESSMENT_TYPE_TEST = 'TEST';
    const ASSESSMENT_TYPE_EXAM = 'EXAM';
    const MC_CODE = 'Multiple Choice';
    const BS_CODE = 'Fill Blank Space';
    const STATIC_ALL_ROLES = [
        Constants::SUPER_ADMIN_ROLE,
        Constants::STUDENT_ROLE,
        Constants::TRAINER_ROLE,
        Constants::ADMIN_ROLE,
        Constants::USER_ROLE,
    ];
    const ORG_TYPE=[
        "Government",
        "NGO",
        "Private",
    ];
}
