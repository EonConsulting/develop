<?php

namespace EONConsulting\Exports\Models\Traits;

use EONConsulting\Exports\Models\FileExport;
use EONConsulting\Exports\Models\FaultyFileExport;

trait Exportable
{

    /**
     * Fetch the exported file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */
    public function exported_file()
    {
        return $this->morphOne(FileExport::class, 'exportable');
    }

    /**
     * Fetch the faulty exported file.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphOne
     */
    public function faulty_file()
    {
        return $this->morphOne(FaultyFileExport::class, 'exportable');
    }

    public function zip_exported_file()
    {
        return $this->exported_file()->where('filetype', 'zip');
    }

    public function pdf_exported_file()
    {
        return $this->exported_file()->where('filetype', 'pdf');
    }

    public function epub_exported_file()
    {
        return $this->exported_file()->where('filetype', 'epub');
    }

    /*
     * Helper method to add a file to the model, delete the file first before adding it.
     *
     * @return $this
     */
    public function attach_exported_file($model)
    {
        $filetype = $model->filetype ?? 'pdf';

        if($model instanceof FileExport)
        {
            $this->faulty_file()->where('filetype', $filetype)->delete();

            $this->exported_file()->where('filetype', $filetype)->delete();

            return $this->exported_file()->save($model);
        }

        if($model instanceof FaultyFileExport)
        {
            $this->faulty_file()->where('filetype', $filetype)->delete();

            return $this->faulty_file()->save($model);
        }
    }




}