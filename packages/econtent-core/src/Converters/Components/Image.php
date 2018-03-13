<?php

namespace EONConsulting\Core\Converters\Components;

class Image
{
    /*
     * Image Height
     *
     * @var string
     */
    protected $height;

    /*
     * Image Width
     *
     * @var string
     */
    protected $width;

    /*
     * Image Type
     *
     * @var string
     */
    protected $type;

    /*
     * Image attributes
     *
     * @var string
     */
    protected $attributes;

    /**
     * @param $filepath
     * @return Image
     */
    static public function load($filepath)
    {
        $image = new self();

        list($width, $height, $type, $attr) = getimagesize($filepath);

        return $image->setWidth($width)
                    ->setHeight($height)
                    ->setType($type)
                    ->setAttributes($attr);
    }

    /**
     * Set the image height
     *
     * @param mixed $height
     * @return Image
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Set the image width
     *
     * @param mixed $width
     * @return Image
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Set the image type
     *
     * @param mixed $type
     * @return Image
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Set image attributes
     *
     * @param mixed $attributes
     * @return Image
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Get the image height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the image width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get the image type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * get image attributes
     *
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}