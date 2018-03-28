<?php

namespace EONConsulting\Exports\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class FileExport extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file_exports';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Boot the File Export instance.
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

    /*
     * Helper method to check if the model is of PDF filetype
     *
     * @return bool|int
     */
    public function hasPdf()
    {
        return $this->hasFileType('pdf');
    }

    /*
     * Helper method to check if the model is of ZIP filetype
     *
     * @return bool|int
     */
    public function hasZip()
    {
        return $this->hasFileType('zip');
    }

    /*
     * Helper method to check if the model is of Ebook filetype
     *
     * @return bool|int
     */
    public function hasEbook()
    {
        return $this->hasFileType('epub');
    }

    /*
     * Helper method to check if the model has a specific file type
     *
     * @return bool|int
     */
    public function hasFileType($filetype)
    {
        if($this->filetype == $filetype)
        {
            return $this->id;
        }

        return false;
    }




}