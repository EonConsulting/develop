<?php

namespace EONConsulting\Exports\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class FaultyFileExport extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faulty_file_exports';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Boot the Faulty File Export instance.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($file)
        {
            if(Storage::disk($file->filesystem)->exists($file->filename))
            {
                Storage::disk($file->filesystem)->delete($file->filename);
            }
        });
    }

    /**
     * Get all of the owning exportable models.
     */
    public function exportable()
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to only include pdf files.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyPdfFile($query)
    {
        return $query->where('filetype','pdf');
    }

    /**
     * Scope a query to only include zip files.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopebyZipFile($query)
    {
        return $query->where('filetype', 'zip');
    }

}