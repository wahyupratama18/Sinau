<?php
namespace App\Traits;

use App\Models\Student;

/**
 * Create User
 */
trait StudentTraits
{

    /**
     * Finder
    */
    public function finder($search = null) {
        return Student::where('active', 1)
        ->whereHas('user', function($q) use ($search) {
            if ($search) return $q->where('name', 'like', "%$search%'");
        });
    }
}
