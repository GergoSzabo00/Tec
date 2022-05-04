<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckExistenceOrOther implements Rule
{
    protected $table;
    protected $column;
    protected $otherValue;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $column, $otherValue)
    {
        $this->table = $table;
        $this->column = $column;
        $this->otherValue = $otherValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exists = DB::table($this->table)->where($this->column, $value)->exists();

        if($exists || $value == $this->otherValue)
        {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.exists');
    }
}
