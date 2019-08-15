<?php 

    class Ministrantes {

        private $id;
        private $codUsuario;
        private $codMinicurso;

    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodUsuario()
    {
        return $this->codUsuario;
    }

    /**
     * @param mixed $codUsuario
     *
     * @return self
     */
    public function setCodUsuario($codUsuario)
    {
        $this->codUsuario = $codUsuario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodMinicurso()
    {
        return $this->codMinicurso;
    }

    /**
     * @param mixed $codMinicurso
     *
     * @return self
     */
    public function setCodMinicurso($codMinicurso)
    {
        $this->codMinicurso = $codMinicurso;

        return $this;
    }
}

?>
