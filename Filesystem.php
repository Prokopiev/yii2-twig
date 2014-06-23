<?php
namespace yii\twig;

class Filesystem extends \Twig_Loader_Filesystem
{
    /**
     * @var string Path to directory
     */
    private $_dir;

    /**
     * @param string $dir path to directory
     */
    public function __construct($dir)
    {
        $this->_dir = $dir;
    }

    protected function normalizeName($name)
    {
        return parent::normalizeName(strtr($name, PATH_SEPARATOR, DIRECTORY_SEPARATOR));
    }

    public function getSource($name)
    {
        if(is_file($this->getFilePath($name)))
            return file_get_contents($this->getFilePath($name));

        return parent::getSource($name);
    }

    public function getCacheKey($name)
    {
        return $this->getFilePath($name);
    }

    protected function getFilePath($name)
    {
        return $this->_dir . '/' . $name;
    }
}
