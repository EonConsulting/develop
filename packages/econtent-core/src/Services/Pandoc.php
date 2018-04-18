<?php

namespace EONConsulting\Core\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Storage;
use Exception;

class Pandoc
{
    /**
     * All the flags that gets passed to pandoc
     *
     * @var array
     */
    protected $flags = [
        '-s' => '',
    ];

    /**
     * Input file that will be converted
     *
     * @var string
     */
    protected $input_file = '';

    /**
     * Base path to be used
     *
     * @var string
     */
    protected $basepath = '';

    /**
     * Path to pandoc program
     *
     * @var string
     */
    protected $pandoc_bin = '/usr/bin/pandoc';

    /**
     * Error file path
     *
     * @var string
     */
    protected $error_file = '';

    /*
     * Write to a file on disk to read from
     *
     * @param string $content
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function fromContent(string $content) : Pandoc
    {
        Storage::disk('storage')->put($this->getBasepath() . '/item.html', $content);
        return $this;
    }

    public function singlePdf()
    {
        $template = Storage::disk('storage')->path('exports/pandoc/templates/default.latex');

        return $this->from('html+tex_math_single_backslash+tex_math_dollars+tex_math_double_backslash')
                    ->mathjax()
                    ->template($template)
                    ->pdfEngine('xelatex')
                    ->inputFile($this->getFullBasepath() . '/item.html')
                    ->outputFile($this->getFullBasepath() . '/item.pdf')
                    ->setErrorFile($this->getBasepath() . '/error.text');
    }

    public function multiplePages()
    {
        $template = Storage::disk('storage')->path('exports/pandoc/templates/default.latex');

        return $this->toc(2)
            ->from('html+tex_math_single_backslash+tex_math_dollars+tex_math_double_backslash')
            ->mathjax()
            ->template($template)
            ->pdfEngine('xelatex')
            ->inputFile($this->getFullBasepath() . '/item.html')
            ->outputFile($this->getFullBasepath() . '/item.pdf')
            ->setErrorFile($this->getBasepath() . '/error.text');
    }

    /*
     * Set the engine to use to generate the output file
     *
     * @param string $engine
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function pdfEngine($engine = 'xelatex')
    {
        return $this->setFlags('--pdf-engine=', $engine);
    }

    /**
     * Set the input filename
     *
     * @param string $filename
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function inputFile(string $filename) : Pandoc
    {
        return $this->setInputFile($filename);
    }

    /*
     * Set the output filename
     *
     * @param string $filename
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function outputFile(string $filename) : Pandoc
    {
        return $this->setFlags('--output=', $filename);
    }

    /*
     * Set the css filename
     *
     * @param string $filename
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function css(string $file) : Pandoc
    {
        return $this->setFlags('--css=', $file);
    }

    /*
     * Set the filter filename
     *
     * @param string $filename
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function filter(string $filter) : Pandoc
    {
        return $this->setFlags('--filter=', $file);
    }

    /*
     * Set the data directory
     *
     * @param string $folder
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function dataDir(string $folder) : Pandoc
    {
        return $this->setFlags('--data-dir=', $folder);
    }

    /*
     * Enable Mathjax
     *
     * @param string $package
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function mathjax($package = null) : Pandoc
    {
        if(is_null($package))
        {
            return $this->setFlags('--mathjax');
        }

        return $this->setFlags('--mathjax=', $package);
    }

    /*
     * Set the from extensions
     *
     * @param string $extensions
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function from(string $extensions) : Pandoc
    {
        return $this->setFlags('--from=', $extensions);
    }

    /*
     * Set the template filename
     *
     * @param string $filename
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function template(string $filename) : Pandoc
    {
        return $this->setFlags('--template=', $filename);
    }

    /*
     * Set the amount of levels for the toc
     *
     * @param int $level
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function toc(int $level = 2) : Pandoc
    {
        return $this->setFlags('--table-of-contents')
             ->setFlags('--toc-depth=', $level);
    }

    /**
     * Generate the File
     *
     * @return bool|void
     * @throws \Exception
     */
    public function generate()
    {
        $command = $this->buildCommand();

        $process = new Process($command);

        $process->setTimeout(360000);

        try {

            $process->mustRun();

            $this->cleanTmpFiles();

            $this->fixPermission();

            return true;

        } catch (ProcessFailedException $e) {

            Storage::disk('storage')->put($this->getErrorFile(), $e->getMessage());

            throw new Exception($e->getMessage());

            return false;
        }

        return;
    }

    /*
     * Fix permission on the generated zip file
     */
    public function fixPermission()
    {
        $command = "/bin/chown -R www-data:www-data " . $this->getFullBasepath();

        $process = new Process($command);

        try {

            $process->mustRun();

        } catch (ProcessFailedException $e) {

            \Log::debug($e->getMessage());
        }
    }

    public function buildCommand()
    {
        $options = '';

        foreach($this->getFlags() as $key => $value)
        {
            $options.= $key . $value . ' ';
        }

        $command = $this->getPandocBin() . ' ' . $options . $this->getInputFile();

        $this->clearFlags();

        return $command;
    }

    protected function cleanTmpFiles()
    {
        Storage::disk('storage')->delete($this->getBasepath() . '/item.html');
    }

    /*
     * Clean all flags
     */
    protected function clearFlags()
    {
        $this->flags = ['-s' => ''];
    }

    /**
     * Get all flags that's currently set
     *
     * @return array
     */
    public function getFlags(): array
    {
        return $this->flags;
    }

    /**
     * Add a extra flag to the command string
     *
     * @param array $flags
     */
    protected function setFlags(string $key, string $value = ''): Pandoc
    {
        $this->flags = array_add($this->flags, $key, $value);
        return $this;
    }

    /**
     * Get the input filename
     *
     * @return string
     */
    public function getInputFile(): string
    {
        return $this->input_file;
    }

    /**
     * Set the input filename
     *
     * @param string $input_file
     */
    public function setInputFile(string $input_file): Pandoc
    {
        $this->input_file = $input_file;
        return $this;
    }

    /**
     * Get the location of Pandoc binary
     *
     * @return string
     */
    public function getPandocBin(): string
    {
        return $this->pandoc_bin;
    }

    /**
     * Set the location of Pandoc binary
     *
     * @param string $pandoc_bin
     */
    public function setPandocBin(string $pandoc_bin): Pandoc
    {
        $this->pandoc_bin = $pandoc_bin;
        return $this;
    }

    /**
     * Get the error filename
     *
     * @return string
     */
    public function getErrorFile(): string
    {
        return $this->error_file;
    }

    /**
     * Set the error filename
     *
     * @param string $error_file
     */
    public function setErrorFile(string $error_file): Pandoc
    {
        $this->error_file = $error_file;
        return $this;
    }

    /**
     * Get the output filename
     *
     * @return string
     */
    public function getOutputFile(): string
    {
        return $this->output_file;
    }

    /**
     * Set the output filename
     *
     * @param string $output_file
     */
    public function setOutputFile(string $output_file): Pandoc
    {
        $this->output_file = $output_file;
        return $this;
    }

    /**
     * Get the base path
     *
     * @return string
     */
    public function getBasepath(): string
    {
        return $this->basepath;
    }

    /**
     * Get the full filesystem base path
     *
     * @return string
     */
    public function getFullBasepath(): string
    {
        return Storage::disk('storage')->path($this->basepath);
    }

    /**
     * Delete folder if exist and create new one
     *
     * @param string $basepath
     * @return \EONConsulting\Core\Services\Pandoc
     */
    public function setBasepath(string $basepath): Pandoc
    {
        if(Storage::disk('storage')->exists($basepath))
        {
            Storage::disk('storage')->deleteDirectory($basepath);
        }

        Storage::disk('storage')->makeDirectory($basepath);

        $this->basepath = $basepath;
        return $this;
    }
}
