<?php

if (!function_exists('beginTransaction')) {
    /**
     * Begin db transaction
     */
    function beginTransaction()
    {
        Illuminate\Support\Facades\DB::beginTransaction();
    }
}

if (!function_exists('commitTransaction')) {
    /**
     * Begin db transaction
     */
    function commitTransaction()
    {
        Illuminate\Support\Facades\DB::commit();
    }
}

if (!function_exists('rollbackTransaction')) {
    /**
     * Begin db transaction
     */
    function rollbackTransaction()
    {
        Illuminate\Support\Facades\DB::rollBack();
    }
}
